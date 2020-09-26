<?php declare(strict_types=1);

namespace Del\Passport;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface PassportInterface
{
    /**
     * @return Collection
     */
    public function getEntitlements(): Collection;

    /**
     * @return int
     */
    public function getUserId(): int;
}