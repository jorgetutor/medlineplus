# MedlinePlus Web Service Guzzle Client

Provides an implementation of the Guzzle library to query MedlinePlus Web Service.

MedlinePlus offers a search-based Web service that provides access to MedlinePlus health topic data in XML format. Using the Web service, software developers can build applications that utilize MedlinePlus health topic information. The service accepts keyword searches as requests and returns relevant health topics (English or Spanish) in ranked order. Keyword searches may be limited to specific fields. The service also returns health topic summaries, search result snippets, external links, and other associated data.

- https://medlineplus.gov/webservices.html

## Usage

To use the MedlinePlus API Client simply instantiate the client.

```php
<?php

require dirname(__FILE__).'/../vendor/autoload.php';

use Tutor\MedlinePlus\MedlinePlusClient;
$client = MedlinePlusClient::factory();

// if you want to see what is happening, add debug => true to the factory call
$client = MedlinePlusClient::factory(['debug' => true]);
```

Invoke Commands using the `__call` method (auto-complete phpDocs are included)

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => '"diabetes medicines" OR "diabetes drugs"',
]);

```

Or Use the `getCommand` method (in this case you need to work with the $response['data'] array:

```php
<?php

$client = MedlinePlusClient::factory();

//Retrieve the Command from Guzzle
$command = $client->getCommand('Query', [
  'term' => '"diabetes medicines" OR "diabetes drugs"',
]);
$command->prepare();

$response = $command->execute();

$data = $response['data'];

```

## Examples
You can execute the examples in the examples directory.

You can look at the services.json for details on what methods are available and what parameters are available to call them.

https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=asthma

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => 'asthma',
]);

```

https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=%22diabetes+medicines%22+OR+%22diabetes+drugs%22

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => '"diabetes medicines" OR "diabetes drugs"',
]);

```

https://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish&term=asma

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'db' => 'healthTopicsSpanish',
  'term' => 'asma',
]);

```

### Field Searching

The text for term can include limiters to restrict the search to a specific health topic field. The syntax is <fieldName>:<fieldValue>. Fields that can be searched in this way are:

- title
- alt-title
- mesh (only available for English-language searches)
- full-summary
- group

https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=title:asthma

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => 'title:asthma',
]);

```

### Subsequent Requests

https://wsearch.nlm.nih.gov/ws/query?file=viv_0Uu9LP&server=qvlbsrch04&retstart=20

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'file' => 'viv_0Uu9LP',
  'server' => 'qvlbsrch04',
  'retstart' => 20,
]);

```

### Optional Parameters

https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=diabetes&retmax=50

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => 'diabetes',
  'retmax' => 50,
]);

```

https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=asthma&rettype=all

```php
<?php

$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => 'asthma',
  'rettype' => 'all',
]);

```

## TODO

- [ ] Add some more examples
- [ ] Add tests
- [ ] Add some Response models

## Contributions welcome

Found a bug, open an issue, preferably with the debug output and what you did.
Bugfix? Open a Pull Request and I'll look into it.

## License

The use MedlinePlus\MedlinePlusClient API client is available under an MIT License.
