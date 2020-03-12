<?php

use PhpCsv\TextFileReader;
use PHPUnit\Framework\TestCase;

class TextReaderTest extends TestCase
{
    public function testBatchRead(): void
    {
        $file = (new TextFileReader('./tests/data/simple.list'))
            ->skipEmpty(true);

        $result = [];
        foreach ($file->batch(2) as $batch) {
            $result[] = $batch;
            self::assertEquals(count($batch), 2);
        }

        $result = array_merge([], ...$result);

        self::assertEquals($result, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
    }
}
