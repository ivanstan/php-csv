<?php

use PhpCsv\TextFile;
use PhpCsv\TextFileReader;
use PHPUnit\Framework\TestCase;

class TextReaderTest extends TestCase
{
    public function testBatchRead(): void
    {
        $file = (new TextFileReader('./tests/data/simple.list'))
            ->skipEmpty(false);

        foreach ($file->batch(2) as $batch) {
            self::assertEquals(count($batch), 2);
        }

        $file = null;
    }
}
