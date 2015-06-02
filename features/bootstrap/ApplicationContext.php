<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Symfony\Component\Console\Tester\ApplicationTester;
use Training\Application;
use Training\CashStorage\InMemoryCashStorage;

/**
 * Defines application features from the specific context.
 */
class ApplicationContext implements Context, SnippetAcceptingContext
{
    /** @var \Training\Behat\CommonContext */
    private $commonContext;

    /** @var ApplicationTester */
    private $tester;

    /** @var Application */
    private $app;

    /** @var \Symfony\Component\DependencyInjection\ContainerBuilder */
    private $dic;

    public function __construct()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->tester = new ApplicationTester($application);
        $this->app = $application;
        $this->dic = $application->getContainer();
    }

    /**
     * @BeforeScenario
     *
     * @param BeforeScenarioScope $scope
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->commonContext = $environment->getContext('Training\Behat\CommonContext');

        // set session
        $session = $this->dic->get('session');
        $session->setAccount($this->commonContext->account);
    }

    /**
     * @Given there is an ATM with :amount pounds
     */
    public function thereIsAnAtmWithPounds($amount)
    {
        $cashStorage = new InMemoryCashStorage();
        $cashStorage->setCash($amount);

        $this->dic->set('cash_storage', $cashStorage);

        $this->commonContext->atm = $this->dic->get('atm');
    }

    /**
     * @When the account holder tries to withdraw :amount pounds
     */
    public function theAccountHolderTriesToWithdrawPounds($amount)
    {
        $arguments = array ('command' => 'withdraw', $amount);

        $withdrawCommand = $this->dic->get('command.withdraw');

        $this->app->add($withdrawCommand);

        $this->tester->run($arguments);
    }

    /**
     * @Then the account holder should have :amount pounds
     */
    public function theAccountHolderShouldHavePounds($amount)
    {
        expect($this->tester->getDisplay())->toBe($amount);
    }
}
