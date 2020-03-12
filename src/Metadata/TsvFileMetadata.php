<?php

namespace PhpCsv\Metadata;

class TsvFileMetadata extends CsvFileMetadata
{
    public function __construct($delimiter = "\t", $enclosure = '"', $escape = '\\')
    {
        parent::__construct($delimiter, $enclosure, $escape);
    }
}
