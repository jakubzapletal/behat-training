<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Advertiser;
use Training\Promotion;
use Training\Storage\Storage;

class PromotionManagerSpec extends ObjectBehavior
{
    public function let(Storage $storage)
    {
        $this->beConstructedWith($storage);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\PromotionManager');
    }

    public function it_should_find_promotion_when_advertiser_and_code_and_start_date_and_end_date_given(
        Advertiser $advertiser,
        Storage $storage,
        Promotion $promotion
    ) {
        $storage->createPromotion($advertiser, 'code', '2015-01-01', '2016-01-01')->shouldBeCalled();
        $storage->findPromotion($advertiser, 'code', '2015-01-01', '2016-01-01')->willReturn($promotion);

        $this->create($advertiser, 'code', '2015-01-01', '2016-01-01');
        $this->find($advertiser, 'code', '2015-01-01', '2016-01-01')->shouldBeLike($promotion);
    }
}
