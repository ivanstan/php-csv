<?php

namespace PhpCsv;

use LimitIterator;

class TextFile implements \Countable
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

    public function countRaw(): int
    {
        $this->file->seek(PHP_INT_MAX);

        return $this->file->key();
    }

    public function count(): int
    {
        return $this->countRaw();
    }
}
