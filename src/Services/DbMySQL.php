<?php

namespace App\Services;

use PDO;
use App\Interfaces\DbInterface;

class DbMySQL implements DbInterface
{
    private PDO $pdo;

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
        $sql = "SELECT * FROM articles WHERE id = :articleId";
        $sth = $this->pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute(['articleId' => $articleId]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    public function register(string $login, string $password): int
    {
        Log::debug(__METHOD__ . " has been started");

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (login, password_hashed) VALUES (?,?)";

        return $this->pdo->prepare($sql)->execute([$login, $passwordHash]);
    }

    public function storeArticle(string $title, string $content, int $userId): bool
    {
        Log::debug(__METHOD__ . " has been started");

        $sql = "INSERT INTO articles (title, content, user_id) VALUES (?,?,?)";

        return $this->pdo->prepare($sql)->execute([$title, $content, $userId]);
    }

    public function login(string $login, string $password): int
    {
        Log::debug(__METHOD__ . " has been started");

        try {
            $userArrayFromDb = $this->getUserRow($login);

            if (!$userArrayFromDb) {
                Log::info("User '$login' hasn't been found in DB");
                return DbInterface::LOGIN_NO_SUCH_USER;
            }

            Log::debug("For user '$login' fetched from DB row: " . json_encode($userArrayFromDb));

            if (!password_verify($password, $userArrayFromDb[PASSWORD_HASHED_KEY_NAME])) {
                return DbInterface::LOGIN_PASSWORD_NOT_MATCHED;
            }

            return DbInterface::LOGIN_SUCCESS;
        } catch (\Exception $e) {
            Log::error("Login Exception: " . json_encode($e->getMessage()));
            return DbInterface::LOGIN_EXCEPTION;
        }
    }

    public function getUserID(string $login): int
    {
        $userArrayFromDb = $this->getUserRow($login);

        if (empty($userId = $userArrayFromDb[ID_KEY_NAME])) {
            Log::critical("Couldn't find ID for user '$login'");
            return 0;
        }

        return (int)$userId;
    }

    private function getUserRow(string $login): array|false
    {
        $sql = sprintf('SELECT * FROM users WHERE %s = :login', LOGIN_KEY_NAME);
        $sth = $this->pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute(['login' => $login]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}