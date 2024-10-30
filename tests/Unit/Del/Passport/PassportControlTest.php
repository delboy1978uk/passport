<?php

namespace DelTest\Passport;


use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\Test\Unit;
use Del\Passport\Entity\Role;
use Del\Passport\PassportControl;
use Del\Passport\PassportPackage;
use Del\Passport\Resource;
use Doctrine\ORM\EntityManagerInterface;
use Tests\Support\UnitTester;

class Team
{
    public function __construct(private readonly int $id){}

    public function getId(): int
    {
        return $this->id;
    }
}

class PassportControlTest extends Unit
{
    protected UnitTester $tester;
    protected PassportControl $passportControl;

    protected function _before()
    {
        $container = new Container();
        $container['cache_dir'] = './tests/data';
        $container['proxy_dir'] = './tests/data';
        $container['entity_paths'] = ['./tests/data'];
        $container['consoleCommands'] = [];
        $container['devMode'] = true;

        $container['db'] = [
            'driver' => 'pdo_mysql',
            'host' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD']
        ];
        $package = new BoneDoctrinePackage();
        $package->addToContainer($container);
        $package = new PassportPackage();
        $package->addToContainer($container);
        $this->passportControl = new PassportControl($container->get(EntityManagerInterface::class));
    }

    protected function _after()
    {
        unset($this->passportControl);
    }

    public function testAddFindAndRemoveRole()
    {
        $role = new Role();
        $role->setRoleName('superuser');
        $this->passportControl->createNewRole($role);
        $this->tester->seeInDatabase('Role', ['rolename' => 'superuser']);
        $role = $this->passportControl->findRole('superuser');
        $this->assertInstanceOf(Role::class, $role);
        $this->assertIsInt($role->getId());
        $this->assertEquals('superuser', $role->getRoleName());
        $this->passportControl->removeRole($role);
        $this->tester->dontSeeInDatabase('Role', ['rolename' => 'superuser']);
    }

    public function testUserPassport()
    {
        $team = new Team(10);
        $team2 = new Team(11);
        $role = new Role();
        $role->setRoleName('teamadmin');
        $role->setClass('DelTest\Passport\Team');
        $this->passportControl->createNewRole($role);
        $passport = $this->passportControl->findUserPassport(7);

        $this->assertEquals(7, $passport->getUserId());
        $this->assertCount(0, $passport->getEntitlements());

        $this->passportControl->grantEntitlement($passport, $role, new Resource($team));

        $this->tester->seeInDatabase('PassportRole', [
            'userId' => 7,
            'entityId' => 10,
            'role_id' => $role->getId()
        ]);
        $this->assertCount(1, $passport->getEntitlements());

        $this->assertTrue($this->passportControl->isAuthorized($passport, new Resource($team), 'teamadmin'));
        $this->assertFalse($this->passportControl->isAuthorized($passport, new Resource($team2), 'teamadmin'));

        $passportRole = $passport->getEntitlements()[0];
        $this->passportControl->revokeEntitlement($passportRole);

        $this->tester->dontSeeInDatabase('PassportRole', [
            'userId' => 7,
            'entityId' => 10,
            'role_id' => $role->getId()
        ]);
        $this->passportControl->removeRole($role);
    }
}
