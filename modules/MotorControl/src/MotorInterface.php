<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

interface MotorInterface
{
    public function setSpeed(int $direction, int $speed): void;
    public function stop(): void;
    public function getDirection(): int;
    public function getSpeed(): int;
}
