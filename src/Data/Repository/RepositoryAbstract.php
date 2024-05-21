<?php

namespace Millenium\TestTask\Data\Repository;

use Millenium\TestTask\Data\Storage\StorageInterface;

abstract class RepositoryAbstract
{
    protected StorageInterface $storage;

    function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
}