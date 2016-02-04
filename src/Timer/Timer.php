<?php

namespace RS\Timer;

use RS\Timer\TimerInterface;

class Timer implements TimerInterface
{
    public function getTime() {
        return Date('H:i:s');
    }
}
