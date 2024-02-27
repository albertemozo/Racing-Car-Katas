<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\RandomSensor;

class AlarmTest extends TestCase
{
    /** @test */
    public function shouldBeOffByDefault(): void
    {
        $alarm = new Alarm(new RandomSensor());
        $this->assertFalse($alarm->isAlarmOn());
    }

    /** @test */
    public function shouldCheckPressure(): void
    {
        $this->expectNotToPerformAssertions();
        $alarm = new Alarm(new RandomSensor());
        $alarm->check();
    }

    /**
     * @test
     */
    public function shouldTurnOnOnLowPressure(): void
    {
        $sensor = new class extends RandomSensor {
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
        $sensor = new class extends RandomSensor {
            public function popNextPressurePsiValue(): float
            {
                return 20;
            }
        };
        $alarm = new Alarm($sensor);
        $alarm->check();

        $this->assertFalse($alarm->isAlarmOn());
    }

    /**
     * @test
     */
    public function shouldTurnOnOnHighPressure(): void
    {
        $sensor = new class extends RandomSensor {
            public function popNextPressurePsiValue(): float
            {
                return 100;
            }
        };
        $alarm = new Alarm($sensor);
        $alarm->check();

        $this->assertTrue($alarm->isAlarmOn());
    }

    /**
     * @dataProvider data
     */
    public function shouldCheckThePressure(float $pressure, bool $result): void
    {
        $sensor = new class extends RandomSensor {
            public function popNextPressurePsiValue(): float
            {
                return 100;
            }
        };
        $alarm = new Alarm($sensor);
        $alarm->check();

        $this->assertEquals($result, $alarm->isAlarmOn());
    }

    public function data(): array
    {
        return [
            [0, true]
        ];
    }
}
