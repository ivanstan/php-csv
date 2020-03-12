<?php

namespace PhpCsv\Metadata;

class CsvFileMetadata
{
    private string $delimiter;
    private string $enclosure;
    private string $escape;

    public function __construct($delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
    }

    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    public function getEnclosure(): string
    {
        return $this->enclosure;
    }

    public function getEscape(): string
    {
        return $this->escape;
    }
}
