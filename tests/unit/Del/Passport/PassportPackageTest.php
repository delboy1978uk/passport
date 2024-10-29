<?php

namespace DelTest\Passport;


use Barnacle\Container;
use Codeception\Test\Unit;
use Del\Passport\PassportPackage;
use Doctrine\ORM\EntityManagerInterface;

class PassportPackageTest extends Unit
{

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
            'host' => '127.0.0.1',
            'dbname' => 'awesome',
            'user' => 'dbuser',
            'password' => '[123456]'
        ];
        $package = new PassportPackage();
        $package->addToContainer($container);

        $this->assertTrue($container->has(EntityManagerInterface::class));
        $this->assertInstanceOf(EntityManagerInterface::class, $container->get(EntityManagerInterface::class));
    }
}
