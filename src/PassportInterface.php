<?php declare(strict_types=1);

namespace Del\Passport;

use Doctrine\Common\Collections\ArrayCollection;

interface PassportInterface
{
    /**
     * @return ArrayCollection
     */
    public function getEntitlements(): ArrayCollection;

    /**
     * @return int
     */
    public function getUserId(): int;
}