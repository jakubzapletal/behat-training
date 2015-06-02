<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

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
     * @Given there is an account with :balance pounds
     */
    public function thereIsAnAccountWithPounds($balance)
    {
        $account = new \Training\Account;
        $account->setBalance($balance);

        $this->commonContext->account = $account;
    }

    /**
     * @Given there is an ATM with :amount pounds
     */
    public function thereIsAnAtmWithPounds($amount)
    {
        $cashStorage = new \Training\CashStorage\InMemoryCashStorage;
        $cashStorage->setCash($amount);

        $atm = new \Training\ATM($cashStorage);

        $this->commonContext->atm = $atm;
    }

    /**
     * @When the account holder tries to withdraw :amount pounds
     */
    public function theAccountHolderTriesToWithdrawPounds($amount)
    {
        $withdrawManager = new \Training\WithdrawManager($this->commonContext->atm);
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
