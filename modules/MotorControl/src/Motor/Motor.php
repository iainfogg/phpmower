<?php declare(strict_types=1);

namespace IainFogg\MotorControl\Motor;

use Calcinai\PHPi\External\Generic\Motor\HBridge;
use IainFogg\MotorControl\MotorDirectionConsts;
use IainFogg\MotorControl\MotorInterface;

/**
 * Class Motor
 *
 * This class wraps the HBridge instance, but with our interface compatibility.
 *
 * @package IainFogg\MotorControl\Motor
 */
class Motor implements MotorInterface
{
    protected $direction;
    protected $speed;

    /**
     * @var HBridge
     */
    private $hBridge;

    public function __construct(HBridge $hBridge)
    {
        $this->hBridge = $hBridge;
    }

    public function setSpeed(int $direction, int $speed): void
    {
        $this->direction = $direction;
        $this->speed = $speed;
        switch ($this->direction) {
            case MotorDirectionConsts::FORWARD:
                $this->hBridge->forward();
                break;
            case MotorDirectionConsts::BACKWARD:
                $this->hBridge->reverse();
                break;
            default:
                throw new \Exception('Unexpected direction passed in');
        }
    }

    public function stop(): void
    {
        $this->speed = 0;
        $this->hBridge->stop();
    }

    public function getDirection(): int
    {
        return $this->direction;
    }
    public function getSpeed(): int
    {
        return $this->speed;
    }
}
