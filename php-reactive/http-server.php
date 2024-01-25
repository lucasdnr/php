<?php

$wait = rand(1, 5);
sleep($wait);

echo "Server response that took $wait seconds" . PHP_EOL;
