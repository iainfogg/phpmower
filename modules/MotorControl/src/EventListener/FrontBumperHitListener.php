<?php declare(strict_types=1);

namespace IainFogg\MotorControl\EventListener;

use IainFogg\MotorControl\SteeringController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FrontBumperHitListener implements EventSubscriberInterface
{
    /**
     * @var SteeringController
     */
    private $steeringController;

    public function __construct(SteeringController $steeringController)
    {
        $this->steeringController = $steeringController;
    }

    public static function getSubscribedEvents()
    {
        return [
            FrontBumperHitEvent::NAME => 'onFrontBumperHitAction',
        ];
    }

    public function onFrontBumperHitAction(FrontBumperHitEvent $event)
    {
        echo 'front bumper hit';
        $this->moveBackward(100);
    }
}
