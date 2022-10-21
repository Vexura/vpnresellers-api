<?php

namespace VPNResellersAPI\Exception;

use Exception;

class AssertNotImplemented extends Exception
{
    public function __construct()
    {
        parent::__construct('This function does not exist! It will be added Soon!', 0, null);
    }
}