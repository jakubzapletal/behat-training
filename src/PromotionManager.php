<?php

namespace Training;

use Training\Storage\Storage;

class PromotionManager
{
    /** @var Storage */
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     */
    public function create(Advertiser $advertiser, $code, $startDate, $endDate)
    {
        $this->storage->createPromotion($advertiser, $code, $startDate, $endDate);
    }

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     *
     * @return null|Promotion
     */
    public function find(Advertiser $advertiser, $code, $startDate, $endDate)
    {
        $promotion = $this->storage->findPromotion($advertiser, $code, $startDate, $endDate);

        return $promotion;
    }
}
