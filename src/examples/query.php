<?php

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Tutor\MedlinePlus\MedlinePlusClient;

// @see https://medlineplus.gov/webservices.html

// https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=%22diabetes+medicines%22+OR+%22diabetes+drugs%22
$client = MedlinePlusClient::factory();
$response = $client->query([
  'term' => '"diabetes medicines" OR "diabetes drugs"',
]);
print_r($response);

// https://wsearch.nlm.nih.gov/ws/query?db=healthTopics&term=title:asthma

$response = $client->query([
  'term' => 'title:asthma',
]);
print_r($response);

// https://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish&term=asma

$response = $client->query([
  'db' => 'healthTopicsSpanish',
  'term' => 'asma',
]);
print_r($response);
