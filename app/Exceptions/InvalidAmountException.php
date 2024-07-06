<?php

namespace App\Exceptions;

use Exception;

class InvalidAmountException extends Exception
{
    protected $message = "invalid amount";
}
