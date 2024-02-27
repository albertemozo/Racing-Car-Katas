<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use RacingCar\TirePressureMonitoring\Sensor;

class DeterministicSensor implements Sensor
{
    private float $pressure;

    public function __construct(float $pressure)
    {

        $this->pressure = $pressure;
    }
    public function popNextPressurePsiValue(): float
    {
        return $this->pressure;
    }
}
