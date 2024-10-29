<?php

namespace DelTest\Passport;


use Barnacle\Container;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Codeception\Test\Unit;
use Del\Passport\PassportControl;
use Del\Passport\PassportPackage;
use Doctrine\ORM\EntityManagerInterface;

class PassportControlTest extends Unit
{

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

    public function testAddRole()
    {
//        $this->assertEquals('Ready to start building tests', $this->passport->blah());
    }
}
