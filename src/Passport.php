<?php declare(strict_types=1);

namespace Del\Passport;

use Del\Passport\PassportInterface;

class Passport implements PassportInterface
{
    /** @var int $userId */
    private $userId;

    /** @var array $entitlements */
    private $entitlements;

    public function __construct(int $id, array $entitlements)
    {
        $this->userId = $id;
        $this->entitlements = $entitlements;
    }

    public function getEntitlements(): array
    {
        return $this->entitlements;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}