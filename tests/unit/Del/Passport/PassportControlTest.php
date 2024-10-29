<?php

namespace DelTest\Passport;


use Codeception\Test\Unit;
use Del\Passport\PassportControl;

class PassportControlTest extends Unit
{

    protected PassportControl $passportControl;

    protected function _before()
    {
        // create a fresh passport class before each test
//        $this->passport = new PassportControl();
    }

    protected function _after()
    {
        // unset the passport class after each test
        unset($this->passportControl);
    }

    /**
     * Check tests are working
     */
    public function testBlah()
    {
//        $this->assertEquals('Ready to start building tests', $this->passport->blah());
    }
}
