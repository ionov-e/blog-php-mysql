<?php

namespace App\Controllers;

use App\Interfaces\DbInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

class User
{
    private Logger $logger;

    public function __construct(private readonly DbInterface $db)
    {
        $this->logger = (new Logger('user'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
    }

    public function register(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");
        $login = $_POST[LOGIN_KEY_NAME];
        $password = $_POST[PASSWORD_KEY_NAME];
        $this->logger->debug("Received: login: '$login', password: '$password'");
        if ($this->db->register($login, $password)) {
            $alertMessage = "Registered successfully";
        } else {
            $alertMessage = "Registering failed. Try again";
        }
        (new Article($this->db))->listAll($alertMessage);
    }

    public function login(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");
        $login = $_POST[LOGIN_KEY_NAME];
        $password = $_POST[PASSWORD_KEY_NAME];
        $this->logger->debug("Received: login: '$login', password: '$password'");


        $loginStatus = $this->db->login($login, $password);

        switch ($loginStatus) {
            case DbInterface::LOGIN_SUCCESS:
                $alertMessage = "Logged in successfully";
                break;
            case DbInterface::LOGIN_PASSWORD_NOT_MATCHED:
                $alertMessage = "Password didn't matched";
                break;
            case DbInterface::LOGIN_NO_SUCH_USER:
                $alertMessage = "User with login $login hasn't been found";
                break;
            case DbInterface::LOGIN_EXCEPTION:
                $alertMessage = "There was a backend error";
                break;
            default:
                $this->logger->critical("Unforeseen login status: $loginStatus");
                $alertMessage = "There was a backend error";
        }

        (new Article($this->db))->listAll($alertMessage);
    }
}