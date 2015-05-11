<?php

namespace spec\Training\Storage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Advertiser;

class InMemoryStorageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Storage\InMemoryStorage');
    }

    public function it_should_implement_storage()
    {
        $this->shouldHaveType('Training\Storage\Storage');
    }

    public function it_should_create_advertiser_when_id_and_name_given()
    {
        $id = 2;
        $name = 'name';

        $this->createAdvertiser($id, $name);

        $advertiser = $this->findAdvertiserById($id);

        $advertiser->shouldHaveType('Training\Advertiser');
        $advertiser->getId()->shouldBeLike(2);
    }

    public function it_should_create_promotion_when_advertise_and_code_and_start_date_and_end_date_given(
        Advertiser $advertiser
    ) {
        $code = 'code';
        $startDate = '2015-01-01';
        $endDate = '2016-01-01';

        $this->createPromotion($advertiser, $code, $startDate, $endDate);

        $promotion = $this->findPromotion($advertiser, $code, $startDate, $endDate);

        $promotion->shouldHaveType('Training\Promotion');
        $promotion->getAdvertiser()->shouldBeLike($advertiser);
        $promotion->getCode()->shouldBeLike($code);
        $promotion->getStartDate()->shouldBeLike($startDate);
        $promotion->getEndDate()->shouldBeLike($endDate);
    }
}
