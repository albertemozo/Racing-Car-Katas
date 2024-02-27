<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

class HtmlTextConverter
{
    public function __construct(
        private string $fullFileNameWithPath,
        private PathReader $pathReader,
        private HtmlTransformer $htmlTransformer
    ) {
    }

    public function convertToHtml(): string
    {
        $lines = $this->pathReader->linesFromPath($this->fullFileNameWithPath);

        return $this->htmlTransformer->htmlFromLines($lines);
    }

    public function getFileName(): string
    {
        return $this->fullFileNameWithPath;
    }

}
