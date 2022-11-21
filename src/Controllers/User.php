<?php

namespace App\Controllers;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
use PDO;

class User
{
    private Logger $logger;

    public function __construct(private PDO $pdo)
    {
        $this->logger = (new Logger('user'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
    }

    public function register(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        #TODO
    }

    public function login(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        #TODO
    }
}