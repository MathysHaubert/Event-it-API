#!/usr/bin/env php
<?php
// doctrine.php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Adjust this path to your actual bootstrap.php
require __DIR__ . '/../../bootstrap.php';

$entityManagerProvider = new SingleManagerProvider($entityManager);

$cli = ConsoleRunner::createApplication($entityManagerProvider);
$cli->run();