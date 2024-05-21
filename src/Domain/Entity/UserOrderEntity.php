<?php

namespace Millenium\TestTask\Domain\Entity;

class UserOrderEntity
{
    private int $user_id;
    private ProductEntity $product;
    private \DateTime $created_at;

    function __construct()
    {
        
    }

    function getUserID(): int
    {
        return $this->user_id;
    }

    function setUserID(int $user_id): void
    {
        if ($user_id <= 0)
        {
            throw new \InvalidArgumentException("");
        }

        $this->user_id = $user_id;
    }

    function getProduct(): ProductEntity
    {
        return $this->product;
    }

    function setProduct(ProductEntity $product): void
    {
        $this->product = $product;
    }

    function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    function setCreatedAt(\DateTime $timestamp): void
    {
        $this->created_at = $timestamp;
    }

    function toArray(): array
    {
        return [
            "user_id" => $this->getUserID(),
            "product" => $this->getProduct()->toArray(),
            "created_at" => $this->getCreatedAt(),
        ];
    }

    static function santize(array $data): array
    {
        $keys = array_keys($data);
        $args = array_fill_keys(
            $keys,
            [
                "filter" => FILTER_CALLBACK,
                "options" => fn ($value) => trim(strip_tags($value))
            ]
        );

        return filter_var_array($data, $args);
    }

    static function fromArray(array $data): static
    {
        $data = static::santize($data);
        $userOrder = new static();

        $userOrder->setUserID((int)$data["user_id"]);
        $userOrder->setProduct(ProductEntity::fromArray($data["product"]));
        $userOrder->setCreatedAt(new \DateTime($data["created_at"] ?? "now"));

        return $userOrder;
    }
}