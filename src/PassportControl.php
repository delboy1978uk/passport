<?php

namespace Del\Passport;

use Del\Passport\Passport;
use Del\Passport\Entity\PassportRole;
use Del\Passport\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

class PassportControl
{
    public function __construct(
        private EntityManager $entityManager
    )
    {}

    public function isAuthorized(PassportInterface $passport, ResourceInterface $resource, string $roleName): bool
    {
        $entitlements = $passport->getEntitlements();

        foreach ($entitlements as $passportRole) {
            $role = $passportRole->getRole();
            codecept_debug($role->getRoleName());
            codecept_debug($passportRole->getEntityId());
            codecept_debug('resource ' . $resource->getResourceId());
            codecept_debug($resource->getResourceType());

            if ($role->getRoleName() === $roleName
                && $role->getClass() === $resource->getResourceType()
                && $passportRole->getEntityId() === $resource->getResourceId()
            ) {
                return true;
            }
        }


        return false;
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
        $passport->getEntitlements()->add($entitlement);

        return true;
    }

    public function revokeEntitlement(PassportRole $passportRole): bool
    {
        $this->entityManager->remove($passportRole);
        $this->entityManager->flush();

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
        $this->entityManager->flush();
    }

    public function findRole(string $name): ?Role
    {
        return $this->entityManager->getRepository(Role::class)->findOneBy([
            'roleName' => $name,
        ]);
    }

    public function findUserPassport(int $userId): Passport
    {
        $roles = $this->entityManager->getRepository(PassportRole::class)->findBy([
            'userId' => $userId,
        ]);

        return new Passport($userId, new ArrayCollection($roles));
    }
}
