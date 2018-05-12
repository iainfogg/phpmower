<?php declare(strict_types=1);

namespace IainFogg\MotorControl;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DriveCommand extends Command
{
    /**
     * @var MowerController
     */
    private $mowerController;

    public function __construct(MowerController $mowerController)
    {
        $this->mowerController = $mowerController;

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
        $this->mowerController->executeLoop();

        $output->writeln('done');
    }
}
