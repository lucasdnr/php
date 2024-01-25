<?php

use GuzzleHttp\Client;

require_once 'vendor/autoload.php';

$client = new Client();

$response1 = $client->get('http://localhost:8080/http-server.php');
$response2 = $client->get('http://localhost:8000/http-server.php');

echo 'Response 1: ' . $response1->getBody()->getContents();
echo 'Response 2: ' . $response2->getBody()->getContents();
