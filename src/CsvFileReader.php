<?php

namespace PhpCsv;

use PhpCsv\Metadata\CsvFileMetadata;

class CsvFileReader extends TextFileReader
{
    protected bool $firstLineIsHeader = false;
    protected array $header = [];
    protected CsvFileMetadata $metadata;

    public function __construct(string $filename, CsvFileMetadata $metadata)
    {
        parent::__construct($filename);

        $this->metadata = $metadata;
    }

    public function get(): \Generator
    {
        $counter = 0;

        foreach (parent::get() as $line) {
            $data = $this->parseLine($line);

            if ($this->firstLineIsHeader && $counter === 0) {
                $this->file->current();
                yield [];
            }

            if (!$this->skipEmpty) {
                yield $data;
            }

            if (!$this->isEmptyRow($data)) {
                yield $data;
            }

            $counter++;
        }
    }

    protected function isEmptyRow(array $data): bool
    {
        if (empty($data)) {
            true;
        }

        $first = reset($data);

        return \count($data) === 1 && empty($first);
    }

    public function isFirstLineHeader(): bool
    {
        return $this->firstLineIsHeader;
    }

    public function getRow(int $line): array
    {
        return $this->parseLine(
            $this->getLine($line)
        );
    }

    public function firstLineIsHeader(bool $value): self
    {
        if ($value) {
            $this->setLimit(1);
            $this->setHeader(
                $this->getRow(0)
            );
        } else {
            $this->setLimit(0);
            $this->setHeader([]);
        }

        $this->firstLineIsHeader = $value;

        return $this;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    public function parseLine(string $line): array
    {
        $metadata = $this->metadata;

        return str_getcsv($line, $metadata->getDelimiter(), $metadata->getEnclosure(), $metadata->getEscape());
    }
}
