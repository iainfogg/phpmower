<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Calcinai\PHPi\Board;
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
    /**
     * @var Calcinai\PHPi\Board
     */
    private $board;

    public function __construct(
        SteeringController $steeringController,
        SensorController $sensorController,
        LoopInterface $loop,
        Board $board
    ) {
        $this->steeringController = $steeringController;
        $this->sensorController = $sensorController;
        $this->loop = $loop;
        $this->board = $board;
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
