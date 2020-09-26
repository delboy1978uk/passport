<?php declare(strict_types=1);

namespace Del\Passport\Entity;

use Del\Passport\PassportInterface;
use Doctrine\Common\Collections\Collection;

class Passport implements PassportInterface
{
    /**
     * @ORM\Column(type="integer")
     * @var int $userId
     */
    private $userId;

    public function getEntitlements(): Collection
    {
        return Collection::class;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}