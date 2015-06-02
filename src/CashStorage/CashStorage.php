<?php

namespace Training\CashStorage;

interface CashStorage
{

    public function getCash();

    public function setCash($amount);
}
