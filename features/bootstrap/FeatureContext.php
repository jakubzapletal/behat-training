<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Training\Queue\InMemoryQueue;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var InMemoryQueue */
    private $consumerQueue;

    /** @var InMemoryQueue */
    private $producerQueue;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->consumerQueue = new InMemoryQueue();
        $this->producerQueue = new InMemoryQueue();

    }

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
     * @When I run processing an update
     */
    public function iRunProcessingAnUpdate()
    {
        $processor = new \Training\UpdateProcessor($this->consumerQueue, $this->producerQueue);
        $processor->process();
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
