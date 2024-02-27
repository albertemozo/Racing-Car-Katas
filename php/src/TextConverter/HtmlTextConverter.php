<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class HtmlTextConverter
{
    public function __construct(
        private string $fullFileNameWithPath
    ) {
    }

    public function convertToHtml(): string
    {
        $lines = $this->linesFromPath($this->fullFileNameWithPath);

        $html = '';
        foreach ($lines as $line) {
            $html .= htmlspecialchars($line, ENT_QUOTES | ENT_HTML5);
            $html .= '<br />';
        }

        return $html;
    }

    public function getFileName(): string
    {
        return $this->fullFileNameWithPath;
    }

    private function linesFromPath(string $path): array
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
