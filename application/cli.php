#!/usr/bin/env php
<?php
require_once __DIR__ . '/init.php';
$di = $bootstrap->getContainer();

$john = $di->get('john');
var_dump($john);


$jane = $di->get('jane');
var_dump($jane);
