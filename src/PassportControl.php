<?php

namespace Del\Passport;

use Del\Passport\Entity\Passport;
use Doctrine\ORM\EntityManager;

class PassportControl
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * PassportControl constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param PassportInterface $passport
     * @param ActionInterface $action
     * @param ResourceInterface $resource
     * @return bool
     */
    public function isAuthorized(PassportInterface $passport, ActionInterface $action, ResourceInterface $resource): bool
    {
        return true;
    }

    /**
     * @param PassportInterface $passport
     * @param RoleInterface $role
     * @param ResourceInterface $resource
     * @return bool
     */
    public function grantEntitlement(PassportInterface $passport, RoleInterface $role, ResourceInterface $resource): bool
    {
        return true;
    }

    /**
     * @param PassportInterface $passport
     * @param RoleInterface $role
     * @param ResourceInterface $resource
     * @return bool
     */
    public function revokeEntitlement(PassportInterface $passport, RoleInterface $role, ResourceInterface $resource): bool
    {
        return true;
    }

    /**
     * @param int $userId
     * @return PassportInterface
     */
    public function createNewPassport(int $userId): PassportInterface
    {
        $passport = new Passport();

        return $passport;
    }
}
