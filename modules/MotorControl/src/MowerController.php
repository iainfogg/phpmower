<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Calcinai\PHPi\Board;
use Calcinai\PHPi\External\Generic\LED;
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

//        $this->loop->addPeriodicTimer(3, function () {
//            print_r($this->steeringController->getState());
//            $this->sensorController->checkSensors();
//        });

        $led = new LED($this->board->getPin(18));
        //$led->flash(5);
        echo 'LED going on';
        $led->on();
        sleep(3);
        echo 'LED going off';
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
