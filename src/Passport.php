<?php

declare(strict_types=1);

namespace Del\Passport;

use Del\Passport\Entity\PassportRole;
use Doctrine\Common\Collections\Collection;

class Passport implements PassportInterface
{
    public function __construct(
        private int $id,
        private Collection $entitlements
    ) {}

    /** @var Collection<PassportRole> */
    public function getEntitlements(): Collection
    {
        return $this->entitlements;
    }

    public function getUserId(): int
    {
        return $this->id;
    }
}
