<?php declare(strict_types=1);

namespace IainFogg\MotorControl\BumperSensor;

use IainFogg\MotorControl\BumperSensorInterface;

class SimulatedBumperSensor implements BumperSensorInterface
{
    public function isPressed(): bool
    {
        $randomNumber = mt_rand(1, 100);
        return $randomNumber >= 95;
    }
}
