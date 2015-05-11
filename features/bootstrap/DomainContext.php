<?php

namespace Training;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Training\Storage\InMemoryStorage;

/**
 * Defines application features from the specific context.
 */
class DomainContext implements Context, SnippetAcceptingContext
{
    /** @var Advertiser */
    private $advertiser;

    /** @var array */
    private $advertiserIds = array();

    /** @var AdvertiserManager */
    private $advertiserManager;

    /** @var InMemoryStorage */
    private $storage;

    public function __construct()
    {
        $this->storage = new InMemoryStorage();
    }

    /**
     * @Given there are advertisers:
     */
    public function thereAreAdvertisers(TableNode $table)
    {
        foreach ($table as $row) {
            $this->advertiserIds[$row['name']] = $row['id'];
        }
    }

    /**
     * @Given I am an advertiser :advertiserName
     */
    public function iAmAnAdvertiser($advertiserName)
    {
        $advertiserId = $this->advertiserIds[$advertiserName];
        $this->advertiserManager = new AdvertiserManager($this->storage);
        $this->advertiserManager->create($advertiserId, $advertiserName);

        $this->advertiser = $this->advertiserManager->findById($advertiserId);
    }

    /**
     * @When I attempt to create a promotion with the code :code, start date :startDate, end date :endDate
     */
    public function iAttemptToCreateAPromotionWithTheCodeStartDateEndDate($code, $startDate, $endDate)
    {
        $promotionManager = new PromotionManager($this->storage);
        $promotionManager->create($this->advertiser, $code, $startDate, $endDate);
    }

    /**
     * @Then I should have a promotion for an advertiser :advertiserName with the code :code, start date :arg3, end date :arg4
     */
    public function iShouldHaveAPromotionForAnAdvertiserWithTheCodeStartDateEndDate($advertiserName, $code, $startDate, $endDate)
    {
        $advertiserId = $this->advertiserIds[$advertiserName];
        $advertiser = $this->advertiserManager->findById($advertiserId);

        $promotionManager = new PromotionManager($this->storage);
        $promotion = $promotionManager->find($advertiser, $code, $startDate, $endDate);

        expect($promotion)->shouldHaveType('Training\Promotion');
    }
}
