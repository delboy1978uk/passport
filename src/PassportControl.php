<?php

namespace Del\Passport;

use Del\Passport\Passport;
use Del\Passport\Entity\PassportRole;
use Del\Passport\Entity\Role;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

class PassportControl
{
    public function __construct(
        private EntityManager $entityManager
    )
    {}

    public function isAuthorized(PassportInterface $passport, ResourceInterface $resource): bool
    {
        return true;
    }

    public function grantEntitlement(PassportInterface $passport, RoleInterface $role, ResourceInterface $resource = null): bool
    {
        $userId = $passport->getUserId();
        $resource ? $resourceId = $resource->getResourceId() : null;
        $entitlement = new PassportRole();
        $entitlement->setUserId($userId);
        $entitlement->setRole($role);
        $resourceId ? $entitlement->setEntityId($resourceId) : null;
        $this->entityManager->persist($entitlement);
        $this->entityManager->flush();

        return true;
    }

    public function revokeEntitlement(PassportInterface $passport, RoleInterface $role, ResourceInterface $resource): bool
    {
        return true;
    }

    public function createNewRole(RoleInterface $role): RoleInterface
    {
        $this->entityManager->persist($role);
        $this->entityManager->flush();

        return $role;
    }

    public function removeRole(RoleInterface $role): void
    {
        $this->entityManager->remove($role);
        $this->entityManager->flush($role);
    }

    public function findRole(string $name): ?Role
    {
        return $this->entityManager->getRepository(Role::class)->findOneBy([
            'roleName' => $name,
        ]);
    }

    public function findPassportRole(string $name, int $id, int $entityId = null): ?PassportRole
    {
        $criteria = [
            'role' => $name,
            'userId' => $id,
        ];

        if ($entityId) {
            $criteria['entityId'] = $entityId;
        }

        return $this->entityManager->getRepository(PassportRole::class)->findOneBy($criteria);
    }

    public function findUserPassport(int $id): Passport
    {
        $roles = $this->entityManager->getRepository(PassportRole::class)->findBy([
            'userId' => $id,
        ]);

        return new Passport($id, $roles);
    }
}
