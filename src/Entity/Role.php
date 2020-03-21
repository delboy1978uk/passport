<?php declare(strict_types=1);

namespace Del\Passport\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Del\Passport\Repository\RoleRepository")
 * @ORM\Table(name="PassportRole",uniqueConstraints={@ORM\UniqueConstraint(name="roleName_idx", columns={"roleName"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="class", type="string")
 */
class Role implements PassportInterface
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
     * @OneToMany(targetEntity="Role", mappedBy="parentRole")
     * @var ArrayCollection $children
     */
    private $children;

    /**
     * Many role have one parent
     * @ManyToOne(targetEntity="Role", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     * @var Role $parentRole
     */
    private $parentRole;

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
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     */
    public function setChildren(ArrayCollection $children): void
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
}

