<?php

namespace PhpCsv;

use LimitIterator;

class TextFileReader extends TextFile
{
    protected LimitIterator $iterator;
    protected bool $skipEmpty = false;

    public function __construct(string $filename)
    {
        parent::__construct($filename);

        $this->iterator = new LimitIterator($this->file, 0, -1);
    }

    public function setLimit(int $offset, int $count = -1): self
    {
        $this->iterator = new LimitIterator($this->file, $offset, $count);

        return $this;
    }

    public function get(): \Generator
    {
        foreach ($this->iterator as $line) {
            yield trim($line);
        }
    }

    public function getLine(int $position): string
    {
        $this->file->seek($position);
        return trim($this->file->getCurrentLine());
    }

    public function batch(int $size): ?\Generator
    {
        $chunk = [];
        $counter = 0;

        foreach ($this->get() as $line) {
            if ($this->skipEmpty) {
                if (!empty($line)) {
                    $chunk[] = $line;
                    $counter++;
                }
            } else {
                $chunk[] = $line;
                $counter++;
            }

            if (($counter % $size) === 0) {
                if (!empty($chunk)) {
                    yield $chunk;
                }
                $chunk = [];
            }
        }

        if (!empty($chunk)) {
            yield $chunk;
        }
    }

    public function isSkipEmpty(): bool
    {
        return $this->skipEmpty;
    }

    public function skipEmpty(bool $skipEmpty = null): self
    {
        $this->skipEmpty = $skipEmpty;

        return $this;
    }
}
