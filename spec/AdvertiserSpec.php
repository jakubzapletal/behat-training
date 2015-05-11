<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdvertiserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Advertiser');
    }

    public function it_should_have_id()
    {
        $this->setId(2);

        $this->getId()->shouldBeLike(2);
    }
}
