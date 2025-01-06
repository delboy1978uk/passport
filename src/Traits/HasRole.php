<?php

declare(strict_types=1);

namespace Del\Passport\Traits;

use Del\Passport\Entity\Role;
use Doctrine\ORM\Mapping as ORM;

trait HasRole
{
    #[ORM\ManyToOne]
    private Role $role;

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
