<?php

namespace Millenium\TestTask\Http\Exception;

class NotFoundException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct("Not found {$message}", 404);
    }
}