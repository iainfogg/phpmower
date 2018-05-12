<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

class SteeringState
{
    private $leftMotorDirection;
    private $leftMotorSpeed;
    private $rightMotorDirection;
    private $rightMotorSpeed;
    private $mode;

    public function __construct(MotorInterface $leftMotor, MotorInterface $rightMotor, string $mode)
    {
        $this->leftMotorDirection = $leftMotor->getDirection();
        $this->leftMotorSpeed = $leftMotor->getSpeed();
        $this->rightMotorDirection = $rightMotor->getDirection();
        $this->rightMotorSpeed = $rightMotor->getSpeed();
        $this->mode = $mode;
    }

    /**
     * @return int
     */
    public function getLeftMotorDirection(): int
    {
        return $this->leftMotorDirection;
    }

    /**
     * @return int
     */
    public function getLeftMotorSpeed(): int
    {
        return $this->leftMotorSpeed;
    }

    /**
     * @return int
     */
    public function getRightMotorDirection(): int
    {
        return $this->rightMotorDirection;
    }

    /**
     * @return int
     */
    public function getRightMotorSpeed(): int
    {
        return $this->rightMotorSpeed;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }
}
