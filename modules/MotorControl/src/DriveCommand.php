<?php

namespace IainFogg\MotorControl;

use IainFogg\MotorControl\Event\FrontBumperHitEvent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DriveCommand extends Command
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

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('romo:drive')
            ->setDescription('Drives the mower.')
            ->setHelp('This command allows you to drive the mower...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $controller = $this->steeringController;
        $controller->moveForward(10);

        $loop = \React\EventLoop\Factory::create();

        $loop->addPeriodicTimer(0.1, function () {
            $this->sensorController->checkSensors();
        });

        $loop->run();

        $output->writeln('done');
    }
}
