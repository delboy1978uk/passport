<?php

namespace DelTest\Passport\Entity;


use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\Test\Unit;
use Del\Passport\Entity\PassportRole;
use Del\Passport\Entity\Role;
use Del\Passport\PassportControl;
use Del\Passport\PassportPackage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Tests\Support\UnitTester;

class PassportRoleTest extends Unit
{
    protected UnitTester $tester;

    public function testGettersAndSetters()
    {
        $role = new Role();
        $role->setRoleName('admin');
        $role->setClass('\Some\Class');
        $passportRole = new PassportRole();
        $passportRole->setRole($role);
        $passportRole->setEntityId(5);
        $passportRole->setUserId(7);
        $passportRole->setApprovedById(4);

        $this->assertInstanceOf(Role::class, $passportRole->getRole());
        $this->assertEquals(5, $passportRole->getEntityId());
        $this->assertEquals(7, $passportRole->getUserId());
        $this->assertEquals(4, $passportRole->getApprovedById());
    }
}
