<?php

namespace Millenium\TestTask\Data\Persistence;

use Millenium\TestTask\Domain\EntityInterface;

interface PersistenceInterface
{
    function persist(EntityInterface $entity): void;
    function retrieve(int $id): ?EntityInterface;
}