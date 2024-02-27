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

    /**
     * @dataProvider data
     */
    public function shouldCheckThePressure(float $pressure, bool $result): void
    {
        $sensor = new DeterministicSensor($pressure);
        $alarm = new Alarm($sensor);
        $alarm->check();

        $this->assertEquals($result, $alarm->isAlarmOn());
    }

    public function data(): array
    {
        return [
            [0, true],
            [20, false],
            [100, true]
        ];
    }
}
