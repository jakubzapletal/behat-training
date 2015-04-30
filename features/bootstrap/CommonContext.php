<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class CommonContext implements Context, SnippetAcceptingContext
{
    /** @var \Training\Queue\InMemoryQueue */
    public $consumerQueue;

    /** @var \Training\Queue\InMemoryQueue */
    public $producerQueue;

    /**
     * @Given there are new transaction:
     */
    public function thereAreNewTransaction(TableNode $table)
    {
        foreach ($table as $row) {
            $this->importTransaction($row);
        }
    }

    private function importTransaction($row)
    {
        $this->consumerQueue->add($row);
    }

    /**
     * @Then I should have:
     */
    public function iShouldHave(TableNode $table)
    {
        $expectedEvents = array();

        foreach ($table as $row) {
            $expectedEvents[] = $row;
        }

        expect($this->producerQueue->get())->shouldBeLike($expectedEvents);
    }
}
