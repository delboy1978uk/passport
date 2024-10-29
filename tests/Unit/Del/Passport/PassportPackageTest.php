<?php

namespace DelTest\Passport;


use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\Test\Unit;
use Del\Passport\PassportPackage;
use Doctrine\ORM\EntityManagerInterface;
use Tests\Support\UnitTester;

class PassportPackageTest extends Unit
{
    protected UnitTester $tester;

    public function testPackage()
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

        $this->assertTrue($container->has(EntityManagerInterface::class));
        $this->assertInstanceOf(EntityManagerInterface::class, $container->get(EntityManagerInterface::class));
    }
}