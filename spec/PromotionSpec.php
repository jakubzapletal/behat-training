<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Advertiser;

class PromotionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Promotion');
    }

    public function it_should_have_advertiser(Advertiser $advertiser)
    {
        $this->setAdvertiser($advertiser);

        $this->getAdvertiser()->shouldBeLike($advertiser);
    }

    public function it_should_have_code()
    {
        $this->setCode('code_test');

        $this->getCode()->shouldBeLike('code_test');
    }

    public function it_should_have_start_date()
    {
        $this->setStartDate('2015-01-01');

        $this->getStartDate()->shouldBeLike('2015-01-01');
    }

    public function it_should_have_end_date()
    {
        $this->setEndDate('2016-01-01');

        $this->getEndDate()->shouldBeLike('2016-01-01');
    }
}
