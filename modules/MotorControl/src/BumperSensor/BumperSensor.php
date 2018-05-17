<?php declare(strict_types=1);

namespace IainFogg\MotorControl\BumperSensor;

use Calcinai\PHPi\External\Generic\Button;
use Exception;
use IainFogg\MotorControl\BumperSensorInterface;
use IainFogg\MotorControl\SteeringController;

class BumperSensor implements BumperSensorInterface
{
    /**
     * @var Button
     */
    private $button;

    public function __construct(Button $button)
    {
        $this->button = $button;
    }

    public function initialise(SteeringController $steeringController)
    {
        echo 'initialising button';
        $this->button->on('press', [$steeringController, 'toggleDirection']);
    }

    public function isPressed(): bool
    {
        throw new Exception('Not implemented, and may no longer be needed');
    }
}
