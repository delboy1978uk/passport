<?php

namespace Del\Passport;

use Barnacle\Container;
use Barnacle\EntityRegistrationInterface;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;

class PassportPackage implements RegistrationInterface, EntityRegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c[PassportControl::class] = $c->factory(function(Container $c) {
            $em = $c->get(EntityManager::class);

            return new PassportControl($em);
        });
    }

    /**
     * @return string
     */
    function getEntityPath(): string
    {
        return __DIR__ . '/Entity';
    }
}