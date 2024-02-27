<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;

class AlarmTest extends TestCase
{
    /** @test */
    public function shouldBeOffByDefault(): void
    {
        $alarm = new Alarm();
        $this->assertFalse($alarm->isAlarmOn());
    }

    /** @test */
    public function shouldCheckPressure(): void
    {
        $this->expectNotToPerformAssertions();
        $alarm = new Alarm();
        $alarm->check();
    }
}
