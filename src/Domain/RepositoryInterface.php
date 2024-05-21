<?php

namespace Millenium\TestTask\Domain;

interface RepositoryInterface
{
    function findAll(): array;
}