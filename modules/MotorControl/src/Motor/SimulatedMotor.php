<?php declare(strict_types=1);

namespace IainFogg\MotorControl\Motor;

use IainFogg\MotorControl\MotorDirectionConsts;
use IainFogg\MotorControl\MotorInterface;

class SimulatedMotor implements MotorInterface
{
    protected $direction = MotorDirectionConsts::FORWARD;
    protected $speed = 0;

    public function setSpeed(int $direction, int $speed): void
    {
        $this->direction = $direction;
        $this->speed = $speed;
    }

    public function stop(): void
    {
        $this->speed = 0;
    }

    public function getDirection(): int
    {
        return $this->direction;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

}
