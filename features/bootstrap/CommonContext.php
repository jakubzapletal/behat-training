<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Training\Account;

/**
 * Defines application features from the specific context.
 */
class CommonContext implements Context, SnippetAcceptingContext
{
    /** @var \Training\Account */
    public $account;

    /** @var \Training\ATM */
    public $atm;

    public function __construct()
    {
        $this->account = new Account();
    }

    /**
     * @Given there is an account with :balance pounds
     */
    public function thereIsAnAccountWithPounds($balance)
    {
        $this->account->setBalance($balance);
    }

    /**
     * @Then the account should have :amount pounds
     */
    public function theAccountShouldHavePounds($amount)
    {
        expect($this->account->getBalance())->shouldBeLike($amount);
    }

    /**
     * @Then the ATM should have :amount pounds
     */
    public function theAtmShouldHavePounds($amount)
    {
        expect($this->atm->getCash())->shouldBeLike($amount);
    }
}
