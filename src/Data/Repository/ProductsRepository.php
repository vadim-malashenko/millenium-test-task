<?php

namespace Millenium\TestTask\Data\Repository;

use Millenium\TestTask\Data\Persistence\PersistenceInterface;
use Millenium\TestTask\Data\Persistence\StoragePersistence;
use Millenium\TestTask\Data\StorageFactory;
use Millenium\TestTask\Domain\Entity\ProductEntity;
use Millenium\TestTask\Domain\Repository\ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface
{
    protected PersistenceInterface $persistence;

    function __construct(array $config)
    {
        $this->persistence = new StoragePersistence(
            StorageFactory::mysql(...$config["authority"])
                ->withScheme($config["scheme"])
                ->withTable("products")
        );
    }

    function add(ProductEntity $product): void
    {
        $this->persistence->persist($product);
    }

    function find(int $id): ?ProductEntity
    {
        return $this->persistence->retrieve($id);
    }

    function findAll(): array
    {
        return array_map(
            fn ($data) => ProductEntity::fromArray($data)->toArray(),
            $this->persistence->storage->select()->all()
        );
    }
}