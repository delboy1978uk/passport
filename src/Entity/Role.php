<?php

declare(strict_types=1);

namespace Del\Passport\Entity;

use Del\Passport\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\UniqueConstraint(name: "roleName_idx", columns: ["roleName"])]
class Role implements RoleInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int $id
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=50)
     * @var string $roleName
     */
    private $roleName;

    /**
     * A role can have various roles under it
     * @ORM\OneToMany(targetEntity="Role", mappedBy="parentRole")
     * @var ArrayCollection $children
     */
    private $children;

    /**
     * Many role have one parent
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @var Role $parentRole
     */
    private $parentRole;

    /**
     * @ORM\Column(type="string",length=75)
     * @var string $class
     */
    private $class;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     */
    public function setRoleName(string $roleName): void
    {
        $this->roleName = $roleName;
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Collection $children
     */
    public function setChildren(Collection $children): void
    {
        $this->children = $children;
    }

    /**
     * @return Role
     */
    public function getParentRole(): Role
    {
        return $this->parentRole;
    }

    /**
     * @param Role $parentRole
     */
    public function setParentRole(Role $parentRole): void
    {
        $this->parentRole = $parentRole;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }
}

