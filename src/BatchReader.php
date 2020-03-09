<?php

namespace PhpCsv;

class BatchReader
{
    protected \SplFileObject $file;

    public function __construct(string $filename)
    {
        $this->file = new \SplFileObject($filename, 'rb');
    }

    public function getFileObject(): \SplFileObject
    {
        return $this->file;
    }
}
