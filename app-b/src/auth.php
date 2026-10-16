<?php
declare(strict_types=1);

session_name('CIPHERCORE_APPB');
session_start();

function loadAppBEnv(): void
{
    $path = dirname(__DIR__) . '/../.env';

    if (!is_file($path)) {
        throw new RuntimeException('Project .env file not found.');
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim(trim($value), "\"'");

        if ($key !== '' && getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

function requireAppBLogin(): void
{
    if (empty($_SESSION['app_b_user'])) {
        header('Location: /');
        exit;
    }
}

function appBEscape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
