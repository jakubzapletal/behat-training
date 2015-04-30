<?php

namespace Training\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\UpdateProcessor;

class UpdateCommand extends Command
{
    /** @var UpdateProcessor */
    private $updateProcessor;

    public function __construct($name, UpdateProcessor $updateProcessor)
    {
        $this->updateProcessor = $updateProcessor;

        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->updateProcessor->process();
    }
}
