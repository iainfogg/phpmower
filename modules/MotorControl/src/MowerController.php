<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use React\EventLoop\LoopInterface;

class MowerController
{
    /**
     * @var SteeringController
     */
    private $steeringController;

    /**
     * @var SensorController
     */
    private $sensorController;

    /**
     * @var LoopInterface
     */
    private $loop;

    public function __construct(SteeringController $steeringController, SensorController $sensorController)
    {
        $this->steeringController = $steeringController;
        $this->sensorController = $sensorController;
        $this->loop = \React\EventLoop\Factory::create();
    }

    public function executeLoop()
    {
        $this->initialiseMower();

        $this->loop->addPeriodicTimer(3, function () {
            print_r($this->steeringController->getState());
            $this->sensorController->checkSensors();
        });

        $this->loop->run();
    }

    public function initialiseMower()
    {
        echo "Mower initialised\r\n";
    }

    public function turnAfterBumperHit()
    {

    }
}
