<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;

class HtmlTextConverterTest extends TestCase
{
    public function testFoo(): void
    {
        $converter = new HtmlTextConverter('foo');
        $this->assertSame('foo', $converter->getFileName());
    }

    /**
     * @test
     */
    public function shouldConvertAFile(): void
    {
        $this->expectNotToPerformAssertions();
        $file = tempnam(sys_get_temp_dir(), 'test');
        $path = realpath($file);
        $converter = new HtmlTextConverter($path);
        $converter->convertToHtml();
    }

    /**
     * @test
     */
    public function shouldBeEmptyWhenTheSourceFileIsEmpty(): void
    {
        $file = tempnam(sys_get_temp_dir(), 'test');
        $path = realpath($file);
        $converter = new HtmlTextConverter($path);
        $result = $converter->convertToHtml();
        $this->assertEmpty($result);
    }
}
