<?php

namespace App\Interfaces;

interface DbInterface
{
    const LOGIN_SUCCESS = 1;
    const LOGIN_NO_SUCH_USER = 2;
    const LOGIN_PASSWORD_NOT_MATCHED = 4;
    const LOGIN_EXCEPTION = 0;

    public function getArticles(): array;

    public function getArticlesByQuery(string $query): array;

    public function getArticleById(int $articleId): array;

    public function storeArticle(string $title, string $content, int $userId): bool;

    public function register(string $login, string $password): int;

    public function login(string $login, string $password): int;

    public function getUserID(string $login): int;
}