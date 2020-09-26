<?php

namespace DelTest\Passport;

use Del\Passport\PassportControl;

class PassportControlTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var PassportControl
     */
    protected $passport;

    protected function _before()
    {
        // create a fresh passport class before each test
        $this->passport = new PassportControl();
    }

    protected function _after()
    {
        // unset the passport class after each test
        unset($this->passport);
    }

    /**
     * Check tests are working
     */
    public function testBlah()
    {
        $this->assertEquals('Ready to start building tests', $this->passport->blah());
    }
}
