<?php

namespace App\Controllers;

use App\Interfaces\DbInterface;
use App\Services\View;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

class Article
{
    private Logger $logger;

    public function __construct(private readonly DbInterface $db)
    {
        $this->logger = (new Logger('view'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
    }

    public function listAll(string $alertMessage = ''): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        $articles = $this->db->getArticles();

        echo View::articleList($articles, $alertMessage);
    }

    public function showById(): void
    {
        $this->logger->debug(__METHOD__ . " has been started");

        $articleId = $_GET[ARTICLE_ID_KEY_NAME];

        $this->logger->debug("Article ID received: $articleId");

        $article = $this->db->getArticleById($articleId);

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