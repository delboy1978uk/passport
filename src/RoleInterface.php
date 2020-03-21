<?php declare(strict_types=1);

namespace Del\Passport;

interface RoleInterface
{
    /**
     * @return string
     */
    public function getRoleName(): string;
}