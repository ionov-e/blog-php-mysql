<?php
/** Возвращает отрендеренный PHP-файл. Можно в файл передать аргументы */

namespace App\Services;

class View
{
    private const VIEWS_FOLDER = PROJECT_DIR . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR;
    private const TEMPLATE_PATH = self::VIEWS_FOLDER . 'template.php';
    private const ARTICLE_LIST_PATH = self::VIEWS_FOLDER . 'article_list.php';
    private const ARTICLE_SINGLE_PATH = self::VIEWS_FOLDER . 'article_single.php';

    private function __construct(
        private readonly string $path,
        private readonly array  $args = []
    )
    {
    }

    public static function articleList(array $articles, string $alertMessage): self
    {
        $view = new self(self::ARTICLE_LIST_PATH, $articles);

        Log::debug(__METHOD__ . " has been started");
        Log::debug("'articles' content: " . json_encode($articles));

        return $view->completePageWithinTemplate($view, $alertMessage);
    }

    public static function articleSingle(array $article): self
    {
        $view = new self(self::ARTICLE_SINGLE_PATH, $article);

        Log::debug(__METHOD__ . " has been started");
        Log::debug("'article' content: " . json_encode($article));

        return $view->completePageWithinTemplate($view);
    }

    public function __toString(): string
    {
        ob_start();
        include($this->path);
        $var = ob_get_contents();
        ob_end_clean();

        if (empty($var)) {
            Log::critical("Не вышло отрендерить файл: $this->path с аргументами: " . json_encode($this->args, JSON_UNESCAPED_UNICODE));
        }

        return $var;
    }

    private function completePageWithinTemplate(string $content, string $alertMessage = ''): self
    {
        return new self(self::TEMPLATE_PATH, [$content, $alertMessage]);
    }
}