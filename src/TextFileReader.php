<?php

namespace PhpCsv;

class TextFileReader extends TextFile
{
    private bool $skipEmpty = false;

    public function get(): \Generator
    {
        while (!$this->file->eof()) {
            yield trim($this->file->fgets());
        }
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
