<?php

namespace Millenium\TestTask\Test;

use Millenium\TestTask\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    protected App $instance;

    function setUp(): void
    {
        $this->instance = App::getInstance();
    }

    function testSingleton()
    {
        $this->assertEquals($this->instance, App::getInstance());
    }
}