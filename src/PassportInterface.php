<?php declare(strict_types=1);

namespace Del\Passport;

interface PassportInterface
{
    /**
     * @return array
     */
    public function getEntitlements(): array;

    /**
     * @return int
     */
    public function getUserId(): int;
}