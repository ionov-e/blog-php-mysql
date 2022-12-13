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

        try {
            $query = $_GET[SEARCH_KEY_NAME];

            $articles = $this->db->getArticlesByQuery($query);

            echo View::articleList($articles, "For query '$query' found results: " . count($articles));
        } catch (\Exception $e) {
            Log::error("Exception: {$e->getMessage()}");
            $this->listAll("There was an unexpected error while searching your query");
        }
    }

    public function store(): void
    {
        Log::init('artStore');

        try {
            Log::info("Post-content: " . json_encode($_POST));

            list($title, $content) = $this->getArticleFromPost();

            $this->db->storeArticle($title, $content, $_SESSION[AUTHENTICATED_USER_ID]);

            $this->listAll("Article with title '$title' has been stored!");
        } catch (\UnexpectedValueException $e) {
            Log::info("Invalid input: {$e->getMessage()}");
            $this->listAll("Please correct your input, we've got an error: {$e->getMessage()}");
        } catch (\Throwable $e) {
            Log::error("Throwable: {$e->getMessage()}");
            $this->listAll('Sorry, we have got an error processing your article. Article was not saved');
        }

    }

    public function formForNew(): void
    {
        Log::init('formNewArt');

        if (empty($_SESSION[AUTHENTICATED_USER_ID])) {
            Log::info("Unauthenticated user tried to access new article form page");
            $this->listAll('Log in to be able to create new article');
        } else {
            echo View::articleCreateFrom();
        }

        $articleId = $_GET[ARTICLE_ID_KEY_NAME];

        Log::debug("Article ID received: $articleId");

        $article = $this->db->getArticleById($articleId);

        echo View::articleSingle($article);
    }

    /**
     * @return array
     * @throws \UnexpectedValueException
     */
    private function getArticleFromPost(): array
    {
        $title = $_POST[TITLE_KEY_NAME];
        $content = $_POST[CONTENT_KEY_NAME];

        if (strlen($title) > 60) {
            throw new \UnexpectedValueException('Title is more than 60 symbols');
        }

        if (strlen($title) == 0) {
            throw new \UnexpectedValueException('Title is empty');
        }

        if (strlen($content) == 0) {
            throw new \UnexpectedValueException('Content is empty');
        }

        return [$title, $content];
    }
}