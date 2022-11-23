<?php

namespace App\Controllers;

use App\Interfaces\DbInterface;
use App\Services\Log;
use App\Services\View;

class Article
{

    public function __construct(private readonly DbInterface $db)
    {
    }

    public function listAll(string $alertMessage = ''): void
    {
        Log::init('artList');

        $articles = $this->db->getArticles();

        echo View::articleList($articles, $alertMessage);
    }

    public function showById(): void
    {
        Log::init('artShowId');

        $articleId = $_GET[ARTICLE_ID_KEY_NAME];

        Log::debug("Article ID received: $articleId");

        $article = $this->db->getArticleById($articleId);

        echo View::articleSingle($article);
    }

    public function listFilteredByQuery(): void
    {
        Log::init('artListQuery');

        #TODO
    }

    public function store()
    {
        Log::init('artStore');

        #TODO
    }
}