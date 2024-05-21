<?php

namespace Millenium\TestTask\Http;

class Response
{
    static array $statusText = [
        200 => 'OK',
        404 => 'Not found',
        500 => 'Internal server error',
        501 => 'Not implemented'
    ];

    private int $statusCode = 200;
    private string $body = '';

    function __construct(string $body = "", int $statusCode = 200, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body;

        $this->sendHeaders($headers);
    }

    function getStatusCode(): int
    {
        return $this->statusCode;
    }

    function getStatusText(): string
    {
        return self::$statusText[$this->statusCode];
    }

    function getBody(): string
    {
        return $this->body;
    }

    function sendHeaders(array $headers = []): void
    {
        if ( ! headers_sent())
        {
            http_response_code($this->statusCode);

            $headers = ['Status' => $this->statusCode] + $headers;

            foreach ($headers as $header)
            {
                header("{$header}");
            }
        }
    }
}