<?php

namespace DelTest\Passport\Entity;


use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\Test\Unit;
use Del\Passport\Entity\Role;
use Del\Passport\PassportControl;
use Del\Passport\PassportPackage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Tests\Support\UnitTester;

class RoleTest extends Unit
{
    protected UnitTester $tester;

    public function testGettersAndSetters()
    {
        $root = new Role();
        $root->setRoleName('superuser');
        $admin = new Role();
        $admin->setRoleName('admin');
        $admin->setClass('\Some\Resource\Admin\Can\Manage');
        $admin->setParentRole($root);
        $office = new Role();
        $office->setRoleName('officeworker');
        $office->setClass('\Some\Role\Entity');
        $admin->getChildren()->add($office);

        $this->assertEquals('\Some\Resource\Admin\Can\Manage', $admin->getClass());
        $this->assertInstanceOf(Role::class, $admin->getParentRole());
        $this->assertCount(1, $admin->getChildren());
        $this->assertInstanceOf(Role::class, $admin->getChildren()->current());

        $field = new Role();
        $field->setRoleName('fieldworker');
        $field->setClass('\Some\Other\Role\Entity');
        $collection = new ArrayCollection([$office, $field]);
        $admin->setChildren($collection);

        $this->assertCount(2, $admin->getChildren());
    }
}
