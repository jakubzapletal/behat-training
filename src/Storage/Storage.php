<?php

namespace Training\Storage;

use Training\Advertiser;
use Training\Promotion;

interface Storage
{
    /**
     * @param int $id
     * @param string $name
     */
    public function createAdvertiser($id, $name);

    /**
     * @param int $id
     *
     * @return Advertiser|null
     */
    public function findAdvertiserById($id);

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     */
    public function createPromotion(Advertiser $advertiser, $code, $startDate, $endDate);

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     *
     * @return Promotion|null
     */
    public function findPromotion(Advertiser $advertiser, $code, $startDate, $endDate);
}
