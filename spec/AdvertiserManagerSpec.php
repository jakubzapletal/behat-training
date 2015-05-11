<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Advertiser;
use Training\Storage\Storage;

class AdvertiserManagerSpec extends ObjectBehavior
{
    public function let(Storage $storage)
    {
        $this->beConstructedWith($storage);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\AdvertiserManager');
    }

    public function it_should_find_advertiser_by_id(Advertiser $advertiser, Storage $storage)
    {
        $storage->findAdvertiserById(2)->willReturn($advertiser);

        $this->findById(2)->shouldBeLike($advertiser);
    }

    public function it_should_create_advertiser_when_id_and_name_given(Storage $storage)
    {
        $storage->createAdvertiser(2, 'name')->shouldBeCalled();

        $this->create(2, 'name');
    }

    public function it_should_return_null_when_advertiser_does_not_exist()
    {
        $this->findById(999)->shouldBeLike(null);
    }
}
