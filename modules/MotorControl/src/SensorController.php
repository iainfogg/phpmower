<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Calcinai\PHPi\Board;
use Calcinai\PHPi\External\Generic\Button;
use IainFogg\MotorControl\BumperSensor\BumperSensor;
use IainFogg\MotorControl\BumperSensor\SimulatedBumperSensor;
use IainFogg\MotorControl\Event\FrontBumperHitEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SensorController
{
    /**
     * @var BumperSensorInterface
     */
    private $frontBumperSensor;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(BumperSensorInterface $frontBumperSensor, EventDispatcherInterface $dispatcher)
    {
        $this->frontBumperSensor = $frontBumperSensor;
        $this->dispatcher = $dispatcher;
    }

    public function checkSensors()
    {
        if ($this->frontBumperSensor->isPressed()) {
            $this->dispatcher->dispatch(FrontBumperHitEvent::NAME, new FrontBumperHitEvent());
        }
    }

    public function initiateBumperSensor()
    {

    }

    public static function factory(bool $useRealSensor, EventDispatcherInterface $dispatcher, Board $board = null)
    {
        if ($useRealSensor) {
            $button = new Button($board->getPin(16));
            $frontSensor = new BumperSensor($button);
            return new self($frontSensor, $dispatcher);
        } else {
            return new self(new SimulatedBumperSensor(), $dispatcher);
        }
    }
}
