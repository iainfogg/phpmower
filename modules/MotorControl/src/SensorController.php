<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

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
}
