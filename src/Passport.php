<?php declare(strict_types=1);

namespace Del\Passport;

class Passport implements PassportInterface
{
    public function __construct(
        private int $id,
        private array $entitlements)
    {}

    public function getEntitlements(): array
    {
        return $this->entitlements;
    }

    public function getUserId(): int
    {
        return $this->id;
    }
}
