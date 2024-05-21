<?php

namespace Millenium\TestTask\Http;

enum Status: int
{
    case HTTP_OK = 200;
    case HTTP_NOT_FOUND = 404;
    case HTTP_INTERNAL_SERVER_ERROR = 500;
    case HTTP_NOT_IMPLEMENTED = 501;
}