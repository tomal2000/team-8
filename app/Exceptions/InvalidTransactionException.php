<?php

namespace App\Exceptions;

use Exception;

class InvalidTransactionException extends Exception
{
    protected $message = "invalid transaction";
}
