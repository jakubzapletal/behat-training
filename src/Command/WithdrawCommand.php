<?php

namespace Training\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\Session;
use Training\WithdrawManager;

class WithdrawCommand extends Command
{
    /** @var WithdrawManager */
    private $withdrawManager;

    /** @var Session */
    private $session;

    public function __construct($name, WithdrawManager $withdrawManager, Session $session)
    {
        $this->withdrawManager = $withdrawManager;
        $this->session = $session;

        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $account = $this->session->getAccount();

        $amount = $input->getArgument(0);

        $result = $this->withdrawManager->withdraw($account, $amount);

        $output->write($result);
    }
}
