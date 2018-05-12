<?php declare(strict_types=1);

namespace IainFogg\MotorControl\Event;

use Symfony\Component\EventDispatcher\Event;

class FrontBumperHitEvent extends Event
{
    const NAME = 'iainfogg.motorcontrol.frontbumperhit';
}
