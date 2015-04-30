<?php

namespace Training\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Console\Input\ArrayInput;
use Training\Application;

/**
 * Defines application features from the specific context.
 */
class ApplicationContext implements Context, SnippetAcceptingContext
{
    /** @var Application */
    private $app;

    private $dic;

    /** @var \Training\Behat\CommonContext */
    private $commonContext;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->app = new Application();
        $this->app->setAutoExit(false);
        $this->dic = $this->app->getDic();
    }

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->commonContext = $environment->getContext('Training\Behat\CommonContext');

        $this->commonContext->consumerQueue = $this->dic->get('queue.consumer');

        $this->commonContext->producerQueue = $this->dic->get('queue.producer');
    }

    /**
     * @When I run processing an update
     */
    public function iRunProcessingAnUpdate()
    {
        $command = $this->dic->get('update.command');
        $this->app->add($command);

        $input = new ArrayInput(array('update'));
        $this->app->run($input);
    }
}
