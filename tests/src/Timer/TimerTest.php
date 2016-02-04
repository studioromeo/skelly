<?php

namespace RS\Tests\Timer;
use RS\Timer\Timer;

class TimerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTimeGetsTheCurrentTime()
    {
        $timer = new Timer();

        $this->assertEquals($timer->getTime(), date('H:i:s'));
    }
}
