<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given there is an account with :arg1 pounds
     */
    public function thereIsAnAccountWithPounds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given there is an ATM with :arg1 pounds
     */
    public function thereIsAnAtmWithPounds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When the account holder tries to withdraw :arg1 pounds
     */
    public function theAccountHolderTriesToWithdrawPounds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the account should have :arg1 pounds
     */
    public function theAccountShouldHavePounds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the ATM should have :arg1 pounds
     */
    public function theAtmShouldHavePounds($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the account holder should have :arg1 pounds
     */
    public function theAccountHolderShouldHavePounds($arg1)
    {
        throw new PendingException();
    }

}
