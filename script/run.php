<?php

require __DIR__ .'/../vendor/autoload.php';

$app = new \Training\Application();

$command = $app->getDic()->get('update.command');
$app->add($command);

$app->run();
