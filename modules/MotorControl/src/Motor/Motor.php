<?php
namespace IainFogg\MotorControl\Motor;

use IainFogg\MotorControl\MotorInterface;

class Motor implements MotorInterface
{
    protected $direction;
    protected $speed;
    
    public function setSpeed($direction, $speed)
    {
        $this->direction = $direction;
        $this->speed = $speed;
    }
    
    public function stop()
    {
        $this->speed = 0;
    }
    
    public function getDirection()
    {
        return $this->direction;
    }
    public function getSpeed()
    {
        return $this->speed;
    }
}
