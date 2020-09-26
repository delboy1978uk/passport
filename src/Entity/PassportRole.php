<?php

namespace Del\Passport\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PassportRole
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int $id
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var int $userId
     */
    private $userId;

    /**
     * many users have many roles
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role", referencedColumnName="id")
     * @var Role $role
     */
    private $role;
}