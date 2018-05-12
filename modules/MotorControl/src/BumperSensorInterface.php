<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

interface BumperSensorInterface
{
    public function isPressed(): bool;
}
