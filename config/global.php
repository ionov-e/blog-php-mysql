<?php

require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use Dotenv\Dotenv;

try { // Подключение констант из .env
    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
    $dotenv->load();
} catch (\Exception $e) {
    printf("Ошибка при подключении окружения: %s в файле %s(%d)", $e->getMessage(), $e->getFile(), $e->getLine());
    exit(1);
}

define('MYSQL_SERVER_NAME', $_ENV['MYSQL_SERVER_NAME']);
define('MYSQL_ROOT_PASSWORD', $_ENV['MYSQL_ROOT_PASSWORD']);
define('MYSQL_DATABASE', $_ENV['MYSQL_DATABASE']);
define('MYSQL_USER', $_ENV['MYSQL_USER']);
define('MYSQL_PASSWORD', $_ENV['MYSQL_PASSWORD']);

define('PROJECT_DIR', dirname(__DIR__, 1));              // Корневая папка

const LOG_PATH = PROJECT_DIR . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . "monolog.log";
const LOG_MAX_DAYS = 120;

const SEARCH_KEY_NAME = 'search';
const ARTICLE_ID_KEY_NAME = 'article_id';
const REGISTER_KEY_NAME = 'register';
const LOGIN_KEY_NAME = 'login';
const LOGOUT_KEY_NAME = 'logout';
const PASSWORD_KEY_NAME = 'password';
const PASSWORD_HASHED_KEY_NAME = 'password_hashed';
const ID_KEY_NAME = 'id';
const USER_ID_KEY_NAME = 'user_id';
const TITLE_KEY_NAME = 'title';
const CONTENT_KEY_NAME = 'content';
const AUTHENTICATED_USER_ID = 'auth_user_id';
const NEW_ARTICLE_KEY_NAME = 'new_article';

// Установка часового пояса как в примере (где бы не выполнялся скрипт - одинаковое время)
date_default_timezone_set('Europe/Moscow');

session_start();