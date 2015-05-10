<?php

require __DIR__ . '/../vendor/autoload.php';

use Rosello\T411\Authentication\Authentication;
use Rosello\T411\Config\AuthConfig;
use Rosello\T411\Repository\TorrentRepository;

//Create auth config object
$authConfig = new AuthConfig('username', 'password');

//Ask token
$authentication = new Authentication();
$tokenConfig = $authentication->auth($authConfig);

//Search torrents
$repository = new TorrentRepository($tokenConfig);
$torrents = $repository->search('Ubuntu');

var_dump($torrents);
