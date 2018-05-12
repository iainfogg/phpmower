<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use IainFogg\MotorControl\Event\FrontBumperHitEvent;

class SteeringController
{
    protected $leftMotor;
    protected $rightMotor;

    public function __construct(MotorInterface $leftMotor, MotorInterface $rightMotor)
    {
        $this->leftMotor = $leftMotor;
        $this->rightMotor = $rightMotor;
    }

    public function moveForward($speed)
    {
        $this->move(MotorDirectionConsts::FORWARD, $speed);
    }

    public function moveBackward($speed)
    {
        $this->move(MotorDirectionConsts::BACKWARD, $speed);
    }

    public function rotateAnticlockwise($speed)
    {
        $this->rotate(ControllerRotationConsts::ANTICLOCKWISE, $speed);
    }

    public function rotateClockwise($speed)
    {
        $this->rotate(ControllerRotationConsts::CLOCKWISE, $speed);
    }

    private function move($direction, $speed)
    {
        $this->leftMotor->setSpeed($direction, $speed);
        $this->rightMotor->setSpeed($direction, $speed);
    }

    private function rotate($direction, $speed)
    {
        $leftMotorDirection = $direction == ControllerRotationConsts::ANTICLOCKWISE ? MotorDirectionConsts::BACKWARD : MotorDirectionConsts::FORWARD;
        $rightMotorDirection = $direction == ControllerRotationConsts::ANTICLOCKWISE ? MotorDirectionConsts::FORWARD : MotorDirectionConsts::BACKWARD;
        $this->leftMotor->setSpeed($leftMotorDirection, $speed);
        $this->rightMotor->setSpeed($rightMotorDirection, $speed);
    }
}
