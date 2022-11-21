<?php

namespace App\Controllers;

use App\Services\View;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
use PDO;

class Article
{
    private Logger $logger;

    public function __construct(private PDO $pdo)
    {
        $this->logger = (new Logger('view'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
    }

    public function listAll(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        $articles = $this->pdo->query("SELECT * FROM articles")->fetchAll(PDO::FETCH_ASSOC);

        echo View::articleList($articles);
    }

    public function showById(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        $articleId = $_GET[ARTICLE_ID_KEY_NAME];

        $article = $this->pdo->query("SELECT * FROM articles WHERE id = {$articleId}")->fetchAll(PDO::FETCH_ASSOC);

        echo View::articleSingle($article);
    }

    public function listFilteredByQuery(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        #TODO
    }

    public function store()
    {
        $this->logger->debug(__METHOD__ . " has been started");

        #TODO
    }
}