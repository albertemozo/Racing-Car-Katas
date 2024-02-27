<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class PathReader
{
    public function linesFromPath(string $path): array
    {
        $f = fopen($path, 'r');

        $lines = [];

        while (($line = fgets($f)) !== false) {
            $line = rtrim($line);
            $lines[] = $line;
        }
        return $lines;
    }
}
