<?php

namespace Del\Passport;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\Contracts\Container\EntityRegistrationInterface;
use Doctrine\ORM\EntityManager;

class PassportPackage implements RegistrationInterface, EntityRegistrationInterface
{
    public function addToContainer(Container $c): void
    {
        $c[PassportControl::class] = $c->factory(function(Container $c) {
            $em = $c->get(EntityManager::class);

            return new PassportControl($em);
        });
    }

    function getEntityPath(): string
    {
        return __DIR__ . '/Entity';
    }
}
