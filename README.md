# PHP wrapper for Ordrestyring.dk
Framework agnostic. As it should be.

It's inspired by the Query Builder from Laravel and similar, and uses a nice fluent syntax. Example: 

````php
$ordrestyring->cases()
             ->with('hours', 'type')
             ->where('status', 1)
             ->sortDescending()
             ->sortBy('id')
             ->perPage(15)
             ->page(4)
             ->get();
````

This will return a ``Illuminate/Collection`` of cases, with related hours and type, ordered descending by id, and take 15 results from page 4.

You can also do things like:
````php
$ordrestyring->users()->find(10);
````

````php
$ordrestyring->debtors()->first();
````

````php
$ordrestyring->departments()->where('number', '!=', 19)->all();
````

````php
$ordrestyring->debtors()->where('id', [1,2,3,4])->get(); // Will get debtors with id 1, 2, 3 and/or 4
````

# Installation
````bash
composer require lasserafn/php-ordrestyring
````

# Usage
````php
$ordrestyring = new LasseRafn\Ordrestyring\Ordrestyring('API-KEY');

$ordrestyring->cases()->get();
````

You'd probably want to add a use statement instead:
````php
use LasseRafn\Ordrestyring\Ordrestyring;
````

## Exceptions
All request exceptions will throw an exception, which extends ``GuzzleHttp\Exception\ClientException``. The returned exception is ``LasseRafn\Ordrestyring\Exceptions\RequestException`` and will get the error message from Ordrestyring if one is present, and default to the ClientException message if none is present. So handling exceptions can be as simple as:

````php
try {
    // try to get something from the api, but nothing is found.
}
catch( LasseRafn\Ordrestyring\Exceptions\RequestException $exception ) {
    echo $exception->message; // could redirect back with the message.
}
````

Would echo out something like: "This item does not exists" (according to their API)