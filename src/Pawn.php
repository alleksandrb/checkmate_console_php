<?php

class Pawn extends Figure
{

    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }


    public function isValidMove(array $move, $boardStamp)
    {
        $xCurrent = $this->currentPosition['x'];
        $yCurrent = $this->currentPosition['y'];
        $fieldMove = $move['x'] . $move['y'];

        $fieldsForStep = $this->getAllFieldsForStep($xCurrent, $yCurrent);

        $allowedStep = [];
        foreach ($fieldsForStep as $field) {
            if ($boardStamp[$field]) {
                if ($field[0] == $xCurrent) {
                    continue;
                } else {
                    $allowedStep[] = $field;
                }
            }
            if (!$boardStamp[$field] && $field[0] == $xCurrent) {
                $allowedStep[] = $field;
            }
        }

        if (array_search($fieldMove, $allowedStep) === false) {
            return false;
        }

        $this->currentPosition['x'] = $move['x'];
        $this->currentPosition['y'] = $move['y'];

        return true;
    }

    public function getAllFieldsForStep($x, $y)
    {
        $moves = [];

        $direction = $this->isBlack ? -1 : 1;

        $moves[] = $x . ($y + $direction);

        if ((!$this->isBlack && $y == 2) || ($this->isBlack && $y == 7)) {
            $moves[] = $x . ($y + 2 * $direction);
        }

        $moves[] = chr(ord($x) + 1) . ($y + $direction);
        $moves[] = chr(ord($x) - 1) . ($y + $direction);

        $moves = array_filter($moves, function ($move) {
            return ord('a') <= (ord($move[0]) <= ord('h'))
                && ctype_alpha($move[0])
                && is_numeric($move[1])
                && 8 >= ($move[1] >= 1);
        });

        return $moves;
    }
}
