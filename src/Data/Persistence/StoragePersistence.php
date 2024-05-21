<?php

namespace Millenium\TestTask\Data\Persistence;

use Millenium\TestTask\Data\Storage\StorageInterface;
use Millenium\TestTask\Domain\Entity\UserEntity;
use Millenium\TestTask\Domain\EntityInterface;

class StoragePersistence implements PersistenceInterface
{
    function __construct(public readonly StorageInterface $storage)
    {
        
    }

    function persist(EntityInterface $entity): void
    {
        match ($entity->getID())
        {
            null => $this->storage->insert($entity->toArray()),
            default => $this->storage->update($entity->toArray())
        };
    }

    function retrieve(int $id): ?EntityInterface
    {
        $data = $this->storage
            ->select()
            ->where("id", "=", $id)
            ->one();
        
        return ! empty($data) ? UserEntity::fromArray($data) : null;
    }
}