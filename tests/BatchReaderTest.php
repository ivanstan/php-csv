<?php

use PhpCsv\BatchReader;
use PHPUnit\Framework\TestCase;

class BatchReaderTest extends TestCase
{
    private BatchReader $csv;

    protected function setUp(): void
    {
        $this->csv = new BatchReader('./tests/data/test.csv');
    }

    public function testCount(): void
    {
        self::assertEquals($this->csv->count(), 1000);
    }
}
