<?php
namespace IainFogg\MotorControl;

interface MotorInterface
{
    public function setSpeed($direction, $speed);
    public function stop();
    public function getDirection();
    public function getSpeed();
}
