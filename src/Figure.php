<?php

class Figure
{
    protected $isBlack;
    protected array $currentPosition;

    public function __construct($isBlack, array $basePosition)
    {
        $this->isBlack = $isBlack;
        $this->currentPosition['x'] = $basePosition[0];
        $this->currentPosition['y'] = $basePosition[1];
    }

    public function __toString()
    {
        throw new \Exception("Not implemented");
    }

    public function __get($var)
    {
        return $this->$var;
    }

    public function isValidMove(array $data, $boardStamp)
    {
        return true;
    }
}
