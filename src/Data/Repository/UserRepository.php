<?php

namespace Millenium\TestTask\Data\Repository;

use Millenium\TestTask\Data\Persistence\PersistenceInterface;
use Millenium\TestTask\Data\Persistence\StoragePersistence;
use Millenium\TestTask\Data\StorageFactory;
use Millenium\TestTask\Domain\Entity\UserEntity;
use Millenium\TestTask\Domain\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected PersistenceInterface $persistence;

    function __construct(array $config)
    {
        $this->persistence = new StoragePersistence(
            StorageFactory::mysql(...$config["authority"])
                ->withScheme($config["scheme"])
                ->withTable("user")
        );
    }

    function find(int $id): ?UserEntity
    {
        return $this->persistence->retrieve($id);
    }

    function findAll(): array
    {
        return array_map(
            fn ($user) => UserEntity::fromArray($user)->toArray(),
            $this->persistence->storage->select()->all()
        );
    }
}