<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use IainFogg\MotorControl\Event\FrontBumperHitEvent;

class SteeringController
{
    protected $leftMotor;
    protected $rightMotor;
    protected $mode;

    public function __construct(MotorInterface $leftMotor, MotorInterface $rightMotor)
    {
        $this->leftMotor = $leftMotor;
        $this->rightMotor = $rightMotor;
        $this->mode = SteeringModeConsts::STOPPED;
    }

    public function moveForward($speed)
    {
        $this->move(MotorDirectionConsts::FORWARD, $speed);
        $this->mode = SteeringModeConsts::MOVING_FORWARD;
    }

    public function moveBackward($speed)
    {
        $this->move(MotorDirectionConsts::BACKWARD, $speed);
        $this->mode = SteeringModeConsts::MOVING_BACKWARD;
    }

    public function rotateAnticlockwise($speed)
    {
        $this->rotate(ControllerRotationConsts::ANTICLOCKWISE, $speed);
        $this->mode = SteeringModeConsts::ROTATING_ANTICLOCKWISE;
    }

    public function rotateClockwise($speed)
    {
        $this->rotate(ControllerRotationConsts::CLOCKWISE, $speed);
        $this->mode = SteeringModeConsts::ROTATING_CLOCKWISE;
    }

    public function getState()
    {
        return new SteeringState($this->leftMotor, $this->rightMotor, $this->mode);
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
