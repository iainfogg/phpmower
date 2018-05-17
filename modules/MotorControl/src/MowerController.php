<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Calcinai\PHPi\Board;
use Calcinai\PHPi\External\Generic\Button;
use Calcinai\PHPi\External\Generic\LED;
use Calcinai\PHPi\External\Generic\Motor\HBridge;
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

        $this->steeringController->moveForward(1);
        sleep(3);
        $this->steeringController->moveBackward(1);
        sleep(3);
        $this->steeringController->stop();

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
