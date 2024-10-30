<?php

declare(strict_types=1);

namespace Del\Passport\Entity;

use Bone\BoneDoctrine\Traits\HasId;
use Del\Passport\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\UniqueConstraint(name: "roleName_idx", columns: ["roleName"])]
class Role implements RoleInterface
{
    use HasId;

    #[ORM\Column(type: 'string', length: 50)]
    private string $roleName = '';

    #[ORM\OneToMany(targetEntity: Role::class, mappedBy: 'parentRole')]
    private Collection $children;

    #[ORM\ManyToOne(targetEntity: Role::class, inversedBy: 'children')]
    private ?Role $parentRole;

    #[ORM\Column(type: 'string', length: 75)]
    private string $class = '';

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRoleName(): string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function setChildren(Collection $children): void
    {
        $this->children = $children;
    }

    public function getParentRole(): Role
    {
        return $this->parentRole;
    }

    public function setParentRole(Role $parentRole): void
    {
        $this->parentRole = $parentRole;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): void
    {
        $this->class = $class;
    }
}

