<?php

namespace App\Exceptions;

use Exception;

class InsufficientFundException extends Exception
{
    protected $message = "insufficient fund";
}
