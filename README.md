# PhpCsv

PhpCsv is performant csv data manipulation framework. 

### Usage

Batch reading:
```
use PhpCsv/TextFileReader;

$reader = new TextFileReader('data.list');

foreach($reader->batch(10) as $batch) {
    // $batch is array of 10 lines from file
}
```