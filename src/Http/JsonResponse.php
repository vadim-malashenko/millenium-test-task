<?php

namespace Millenium\TestTask\Http;

class JsonResponse extends Response
{
    function __construct(mixed $body = "", int $statusCode = 200, array $headers = [])
    {
        parent::__construct(
            json_encode($body),
            $statusCode,
            ["Content-type: application/json"] + $headers
        );
    }
}