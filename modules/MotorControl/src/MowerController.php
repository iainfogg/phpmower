<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

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

    public function __construct(SteeringController $steeringController, SensorController $sensorController)
    {
        $this->steeringController = $steeringController;
        $this->sensorController = $sensorController;
    }

    public function executeLoop()
    {
        $loop = \React\EventLoop\Factory::create();

        $loop->addPeriodicTimer(0.1, function () {
            $this->sensorController->checkSensors();
        });

        $loop->run();
    }
}
