<?php

namespace Training\Storage;

use Training\Advertiser;
use Training\Promotion;

class InMemoryStorage implements Storage
{
    /** @var array */
    private $data = array();

    /**
     * @param int $id
     * @param string $name
     */
    public function createAdvertiser($id, $name)
    {
        $advertiser = new Advertiser();
        $advertiser->setId($id);

        if (empty($this->data['advertisers']) || !is_array($this->data['advertisers'])) {
            $this->data['advertisers'] = array();
        }

        $this->data['advertisers'][$advertiser->getId()] = $advertiser;
    }

    /**
     * @param int $id
     *
     * @return Advertiser|null
     */
    public function findAdvertiserById($id)
    {
        if (isset($this->data['advertisers'][$id])) {
            return $this->data['advertisers'][$id];
        }
    }

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     */
    public function createPromotion(Advertiser $advertiser, $code, $startDate, $endDate)
    {
        $promotion = new Promotion();
        $promotion->setAdvertiser($advertiser);
        $promotion->setCode($code);
        $promotion->setStartDate($startDate);
        $promotion->setEndDate($endDate);

        if (empty($this->data['promotions']) || !is_array($this->data['promotions'])) {
            $this->data['promotions'] = array();
        }

        $key = $this->getPromotionArrayKey($advertiser, $code, $startDate, $endDate);
        $this->data['promotions'][$key] = $promotion;
    }

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     *
     * @return Promotion|null
     */
    public function findPromotion(Advertiser $advertiser, $code, $startDate, $endDate)
    {
        $key = $this->getPromotionArrayKey($advertiser, $code, $startDate, $endDate);

        if (isset($this->data['promotions'][$key])) {
            return $this->data['promotions'][$key];
        }
    }

    /**
     * @param Advertiser $advertiser
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     *
     * @return string
     */
    private function getPromotionArrayKey(Advertiser $advertiser, $code, $startDate, $endDate)
    {
        return $advertiser->getId() . '-' . $code . '-' . $startDate . '-' . $endDate;
    }
}
