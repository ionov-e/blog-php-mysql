<?php
/** Возвращает отрендеренный PHP-файл. Можно в файл передать аргументы */

namespace App\Services;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

class View
{
    private const VIEWS_FOLDER = PROJECT_DIR . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR;
    private const TEMPLATE_PATH = self::VIEWS_FOLDER . 'template.php';
    private const ARTICLE_LIST_PATH = self::VIEWS_FOLDER . 'article_list.php';
    private const ARTICLE_SINGLE_PATH = self::VIEWS_FOLDER . 'article_single.php';

    private Logger $logger;

    private function __construct(
        private readonly string $path,
        private readonly array  $args = []
    )
    {
        $this->logger = (new Logger('view'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
    }

    public static function articleList(array $articles): self
    {
        $view = new self(self::ARTICLE_LIST_PATH, $articles);

        $view->logger->debug(__METHOD__ . " has been started");
        $view->logger->debug("'articles' content: " . json_encode($articles));

        return $view->completePageWithinTemplate($view);
    }

    public static function articleSingle(array $article): self
    {
        $view = new self(self::ARTICLE_SINGLE_PATH, $article);

        $view->logger->debug(__METHOD__ . " has been started");
        $view->logger->debug("'article' content: " . json_encode($article));

        return $view->completePageWithinTemplate($view);
    }

    public function __toString(): string
    {
        ob_start();
        include($this->path);
        $var = ob_get_contents();
        ob_end_clean();

        if (empty($var)) {
            $this->logger->critical("Не вышло отрендерить файл: $this->path с аргументами: " . json_encode($this->args, JSON_UNESCAPED_UNICODE));
        }

        return $var;
    }

    private function completePageWithinTemplate(string $content): self
    {
        return new self(self::TEMPLATE_PATH, [$content]);
    }
}