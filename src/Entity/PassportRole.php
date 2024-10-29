<?php

declare(strict_types=1);

namespace Del\Passport\Entity;

use Bone\BoneDoctrine\Traits\HasId;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PassportRole
{
    use HasId;

    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\ManyToOne(targetEntity: Role::class)]
    private Role $role;

    #[ORM\Column(type: 'integer')]
    private $entityId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): void
    {
        $this->entityId = $entityId;
    }
}
