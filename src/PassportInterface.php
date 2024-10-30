<?php declare(strict_types=1);

namespace Del\Passport;

use Del\Passport\Entity\PassportRole;
use Doctrine\Common\Collections\Collection;

interface PassportInterface
{
    /** @return Collection<PassportRole> */
    public function getEntitlements(): Collection;
    public function getUserId(): int;
}
