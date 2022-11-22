<?php

namespace App\Services;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
use PDO;
use App\Interfaces\DbInterface;

class DbMySQL implements DbInterface
{
    private PDO $pdo;
    private Logger $logger;

    public function __construct()
    {
        try {
            $dbConnectionDsnString = "mysql:host=" . MYSQL_SERVER_NAME . ";dbname=" . MYSQL_DATABASE;
            $dbConnection = new PDO($dbConnectionDsnString, MYSQL_USER, MYSQL_PASSWORD);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $dbConnection;
        } catch (\Throwable $e) {
            throw new \PDOException("Connection failed. Throwable name: '" . $e::class . "'. Message : " . $e->getMessage());
        }

        $this->logger = (new Logger('db'))->pushHandler(new RotatingFileHandler(LOG_PATH, LOG_MAX_DAYS, Level::Debug));
    }

    public function getArticles(): array
    {
        return $this->pdo->query("SELECT * FROM articles")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticlesByQuery(string $query): array
    {
        // TODO: Implement getArticlesByQuery() method.
    }

    public function getArticleById(int $articleId): array
    {
        return $this->pdo->query("SELECT * FROM articles WHERE id = {$articleId}")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function storeArticle(int $articleId): bool
    {
        // TODO: Implement storeArticle() method.
    }

    public function register(string $login, string $password): int
    {
        $this->logger->debug(__METHOD__ . " has been started");

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (login, password_hashed) VALUES (?,?)";

        return $this->pdo->prepare($sql)->execute([$login, $passwordHash]);
    }

    public function login(string $login, string $password): int
    {
        $this->logger->debug(__METHOD__ . " has been started");

        try {
            $sql = sprintf('SELECT * FROM users WHERE %s = "%s"', LOGIN_KEY_NAME, $login);
            $userRowFromDb = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

            if (!$userRowFromDb) {
                $this->logger->info("User '$login' hasn't been found in DB");
                return DbInterface::LOGIN_NO_SUCH_USER;
            }

            $this->logger->debug("For user '$login' fetched from DB row: " . json_encode($userRowFromDb));

            if (!password_verify($password, $userRowFromDb[PASSWORD_HASHED_KEY_NAME])) {
                return DbInterface::LOGIN_PASSWORD_NOT_MATCHED;
            }

            return DbInterface::LOGIN_SUCCESS;
        } catch (\Exception $e) {
            $this->logger->error("Login Exception: " . json_encode($e->getMessage()));
            return DbInterface::LOGIN_EXCEPTION;
        }
    }
}