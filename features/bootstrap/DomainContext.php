<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Training\ATM;
use Training\CashStorage\InMemoryCashStorage;
use Training\WithdrawManager;

/**
 * Defines application features from the specific context.
 */
class DomainContext implements Context, SnippetAcceptingContext
{
    /** @var \Training\Behat\CommonContext */
    private $commonContext;

    private $result;

    /**
     * @BeforeScenario
     *
     * @param BeforeScenarioScope $scope
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->commonContext = $environment->getContext('Training\Behat\CommonContext');
    }

    /**
     * @Given there is an ATM with :amount pounds
     */
    public function thereIsAnAtmWithPounds($amount)
    {
        $cashStorage = new InMemoryCashStorage();
        $cashStorage->setCash($amount);

        $atm = new ATM($cashStorage);

        $this->commonContext->atm = $atm;
    }

    /**
     * @When the account holder tries to withdraw :amount pounds
     */
    public function theAccountHolderTriesToWithdrawPounds($amount)
    {
        $withdrawManager = new WithdrawManager($this->commonContext->atm);
        $this->result = $withdrawManager->withdraw($this->commonContext->account, $amount);
    }

    /**
     * @Then the account holder should have :amount pounds
     */
    public function theAccountHolderShouldHavePounds($amount)
    {
        expect($this->result)->shouldBeLike($amount);
    }
}
