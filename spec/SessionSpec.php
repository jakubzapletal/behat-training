<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Account;

class SessionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Session');
    }

    public function it_should_have_logged_account(Account $account)
    {
        $this->setAccount($account);

        $this->getAccount()->shouldBeLike($account);
    }
}
