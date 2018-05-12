<?php declare(strict_types=1);

namespace IainFogg\MotorControl\Motor;

use IainFogg\MotorControl\MotorInterface;

class Motor implements MotorInterface
{
    protected $direction;
    protected $speed;

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
