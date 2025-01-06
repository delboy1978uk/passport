<?php

declare(strict_types=1);

namespace Del\Passport\Entity;

use Bone\BoneDoctrine\Traits\HasCreatedAtDate;
use Bone\BoneDoctrine\Traits\HasId;
use Del\Passport\Traits\HasRole;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class PassportRole
{
    use HasId;
    use HasRole;

    #[ORM\Column(type: 'integer')]
    private int $userId;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $entityId;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $approvedById = null;

    use HasCreatedAtDate;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): void
    {
        $this->entityId = $entityId;
    }

    public function getApprovedById(): ?int
    {
        return $this->approvedById;
    }

    public function setApprovedById(?int $approvedById): void
    {
        $this->approvedById = $approvedById;
    }
}
