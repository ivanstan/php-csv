# PhpCsv

PhpCsv is performant csv data manipulation framework. 

### Usage

Batch reading text file:
```
use PhpCsv/TextFileReader;

$reader = new TextFileReader('data.list');

foreach($reader->batch(10) as $batch) {
    // $batch is array of 10 lines from file
}
```
Batch reading csv file:
```
use PhpCsv/CsvFileReader;

$file = (new CsvFileReader('data.csv', new CsvFileMetadata()))
    ->firstLineIsHeader(true)
    ->fetchAssoc(true)
    ->skipEmpty(true);

foreach($reader->batch(10) as $batch) {
    // $batch is array of 10 rows from file

    Array
    (
        [0] => Array
            (
                [id] => 1
                [first_name] => Pattin
                [last_name] => Vivyan
                [email] => pvivyan0@ox.ac.uk
                [gender] => Male
                [ip_address] => 176.228.167.165
            )
    
        [1] => Array
            (
                [id] => 2
                [first_name] => Lynette
                [last_name] => Kerne
                [email] => lkerne1@wix.com
                [gender] => Female
                [ip_address] => 34.167.242.184
            )

        ...

    )
}
```