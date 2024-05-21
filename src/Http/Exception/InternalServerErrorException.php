<?php

namespace Millenium\TestTask\Http\Exception;

class InternalServerErrorException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(empty($message) ? 'Internal server error' : $message, 500);
    }
}