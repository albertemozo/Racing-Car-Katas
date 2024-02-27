<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class HtmlTransformer
{
    public function htmlFromLines(array $lines): string
    {
        $html = '';
        foreach ($lines as $line) {
            $html .= htmlspecialchars($line, ENT_QUOTES | ENT_HTML5);
            $html .= '<br />';
        }

        return $html;
    }
}
