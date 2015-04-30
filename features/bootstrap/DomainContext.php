<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Training\Queue\InMemoryQueue;

/**
 * Defines application features from the specific context.
 */
class DomainContext implements Context, SnippetAcceptingContext
{
    /** @var \Training\Behat\CommonContext */
    private $commonContext;

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->commonContext = $environment->getContext('Training\Behat\CommonContext');

        $this->commonContext->consumerQueue = new InMemoryQueue();

        $this->commonContext->producerQueue = new InMemoryQueue();
    }

    /**
     * @When I run processing an update
     */
    public function iRunProcessingAnUpdate()
    {
        $processor = new \Training\UpdateProcessor(
            $this->commonContext->consumerQueue,
            $this->commonContext->producerQueue
        );
        $processor->process();
    }
}
