<?php

namespace Millenium\TestTask\Http\Exception;

class NotImplementedException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct("Not implemented {$message}", 501);
    }
}