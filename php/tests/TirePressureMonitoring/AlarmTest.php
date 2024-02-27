<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\Sensor;

class AlarmTest extends TestCase
{
    /** @test */
    public function shouldBeOffByDefault(): void
    {
        $alarm = new Alarm(new Sensor());
        $this->assertFalse($alarm->isAlarmOn());
    }

    /** @test */
    public function shouldCheckPressure(): void
    {
        $this->expectNotToPerformAssertions();
        $alarm = new Alarm(new Sensor());
        $alarm->check();
    }

    /**
     * @test
     */
    public function shouldTurnOnOnLowPressure(): void
    {
        $sensor = new class extends Sensor {
            public function popNextPressurePsiValue(): float
            {
                return 0;
            }
        };
        $alarm = new Alarm($sensor);
        $alarm->check();

        $this->assertTrue($alarm->isAlarmOn());
    }

    /**
     * @test
     */
    public function shouldBeOffForPressuresBetweenThreshold(): void
    {
        $sensor = new class extends Sensor {
            public function popNextPressurePsiValue(): float
            {
                return 20;
            }
        };
        $alarm = new Alarm($sensor);
        $alarm->check();

        $this->assertFalse($alarm->isAlarmOn());
    }
}
