<?php

namespace Millenium\TestTask\Domain\Entity;

use Millenium\TestTask\Domain\EntityInterface;

class UserEntity implements EntityInterface
{
    private ?int $id;
    private ?string $first_name;
    private ?string $second_name;
    private ?\DateTime $birthday;
    private \DateTime $created_at;

    function __construct(?int $id)
    {
        $this->id = $id;
    }

    function getID(): ?int
    {
        return $this->id;
    }

    function getFirstName(): ?string
    {
        return $this->first_name;
    }

    function setFirstName(?string $first_name): void
    {
        if ( ! is_null($first_name) && 255 < mb_strlen($first_name))
        {
            throw new \InvalidArgumentException("");
        }
        
        $this->first_name = $first_name;
    }

    function getSecondName(): ?string
    {
        return $this->second_name;
    }

    function setSecondName(?string $second_name): void
    {
        if ( ! is_null($second_name) && 2255 < mb_strlen($second_name))
        {
            throw new \InvalidArgumentException("");
        }

        $this->second_name = $second_name;
    }

    function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    function setBirthday(?\DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    function toArray(): array
    {
        return [
            "id" => $this->getID(),
            "first_name" => $this->getFirstName(),
            "second_name" => $this->getSecondName(),
            "birthday" => $this->getBirthday(),
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
        $user = new static($data["id"] ?? null);

        if (isset($data["birthday"]))
        {
            $data["birthday"] = new \DateTime($data["birthday"]);
        }

        $data["created_at"] = new \DateTime($data["created_at"]);

        $user->setFirstName($data["first_name"] ?? null);
        $user->setSecondName($data["second_name"] ?? null);
        $user->setBirthday($data["birthday"] ?? null);
        $user->setCreatedAt($data["created_at"]);

        return $user;
    }
}