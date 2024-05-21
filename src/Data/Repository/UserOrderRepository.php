<?php

namespace Millenium\TestTask\Data\Repository;

use Millenium\TestTask\Data\Persistence\PersistenceInterface;
use Millenium\TestTask\Data\Persistence\StoragePersistence;
use Millenium\TestTask\Data\StorageFactory;
use Millenium\TestTask\Domain\Entity\UserOrderEntity;
use Millenium\TestTask\Domain\Repository\UserOrderRepositoryInterface;

class UserOrderRepository implements UserOrderRepositoryInterface
{
    protected PersistenceInterface $persistence;

    function __construct(array $config)
    {
        $this->persistence = new StoragePersistence(
            StorageFactory::mysql(...$config["authority"])
                ->withScheme($config["scheme"])
                ->withTable("user_order")
        );
    }

    function findByUserID(int $userID): array
    {
        return array_map(
            fn ($data) => UserOrderEntity::fromArray([
                "user_id" => $data["user_id"],
                "product" => [
                    "id" => $data["id"],
                    "title" => $data["title"],
                    "price" => $data["price"]
                ],
                "created_at" => $data["created_at"]
            ]),
            $this->persistence->storage
                ->select(["user_order.*", "products.*"])
                ->leftJoin("products", "product_id", "=", "id")
                ->where("user_id", "=", $userID)
                ->orderBy("title, price")
                ->all()
        );
    }

    function findAll(): array
    {
        return array_map(
            fn ($user) => UserOrderEntity::fromArray($user)->toArray(),
            $this->persistence->storage->select()->all()
        );
    }
}