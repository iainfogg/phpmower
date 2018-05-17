<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Calcinai\PHPi\Board;
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

        $led = new LED($this->board->getPin(18));
        $motor = new HBridge($this->board->getPin(19), $this->board->getPin(26));

        $led->on();
        $motor->forward();
        sleep(3);
        $motor->reverse();
        sleep(3);
        $motor->stop();
        $led->off();

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
