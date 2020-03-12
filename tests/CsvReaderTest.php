<?php

use PhpCsv\Metadata\CsvFileMetadata;
use PhpCsv\CsvFileReader;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    public function testBatchRead(): void
    {
        $file = (new CsvFileReader('./tests/data/simple.csv', new CsvFileMetadata()))
            ->firstLineIsHeader(true)
            ->skipEmpty(true);

        foreach ($file->batch(2) as $batch) {
            foreach ($batch as $record) {
                self::assertEquals(count($record), 6);
            }

            self::assertEquals(count($batch), 2);
        }
    }
}
