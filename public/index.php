<?php
require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "global.php";

use App\Controllers;
use App\Services\DB;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET[SEARCH_KEY_NAME])) {
        (new Controllers\Article(DB::pdo()))->listFilteredByQuery();
    } elseif (!empty($_GET[ARTICLE_ID_KEY_NAME])) {
        (new Controllers\Article(DB::pdo()))->showById();
    } else {
        (new Controllers\Article(DB::pdo()))->listAll();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST[REGISTER_KEY_NAME])) {
        (new Controllers\User(DB::pdo()))->register();
    } elseif (!empty($_POST[LOGIN_KEY_NAME])) {
        (new Controllers\User(DB::pdo()))->login();
    } elseif (!empty($_POST[TITLE_KEY_NAME])) {
        (new Controllers\Article(DB::pdo()))->store();
    } else {
        $logger = (new Logger('weird_user'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
        $logger->debug('Post непредвиденный: ' . json_encode($_POST, JSON_UNESCAPED_UNICODE));
    }
}
exit();