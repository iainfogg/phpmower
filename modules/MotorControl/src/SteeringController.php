<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Calcinai\PHPi\Board;
use Calcinai\PHPi\External\Generic\Motor\HBridge;
use Calcinai\PHPi\Pin;
use IainFogg\MotorControl\Event\FrontBumperHitEvent;
use IainFogg\MotorControl\Motor\Motor;
use IainFogg\MotorControl\Motor\SimulatedMotor;

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

    public function stop()
    {
        $this->rightMotor->stop();
        $this->leftMotor->stop();
    }

    public function toggleDirection()
    {
        echo 'toggleDirection';

        // TODO work out where this should go, currently just test code to try button
        if ($this->rightMotor->getDirection() === MotorDirectionConsts::FORWARD) {
            $this->rightMotor->setSpeed(MotorDirectionConsts::BACKWARD, 1);
        } else {
            $this->rightMotor->setSpeed(MotorDirectionConsts::FORWARD, 1);
        }

        if ($this->leftMotor->getDirection() === MotorDirectionConsts::FORWARD) {
            $this->leftMotor->setSpeed(MotorDirectionConsts::BACKWARD, 1);
        } else {
            $this->leftMotor->setSpeed(MotorDirectionConsts::FORWARD, 1);
        }

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

    public static function factory(bool $useRealMotor, Board $board = null)
    {
        if ($useRealMotor) {
            $leftMotor = new Motor(new HBridge($board->getPin(13), $board->getPin(26)));
            $rightMotor = new SimulatedMotor();
            return new self($leftMotor, $rightMotor);
        } else {
            return new self(new SimulatedMotor(), new SimulatedMotor());
        }
    }
}
