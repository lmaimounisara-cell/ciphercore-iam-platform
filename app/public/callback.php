<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../vendor/autoload.php';

try {
    loadLocalEnv();

    $issuer = getenv('OIDC_ISSUER');
    $clientId = getenv('OIDC_CLIENT_ID');
    $clientSecret = getenv('OIDC_CLIENT_SECRET');
    $redirectUri = getenv('OIDC_REDIRECT_URI');

    if (!$issuer || !$clientId || !$clientSecret || !$redirectUri) {
        throw new RuntimeException('Required OIDC configuration is missing.');
    }

    $oidc = new Jumbojett\OpenIDConnectClient(
        $issuer,
        $clientId,
        $clientSecret
    );

    $oidc->setRedirectURL($redirectUri);
    $oidc->authenticate();

    $name = $oidc->requestUserInfo('preferred_username');

    if (!$name) {
        $name = $oidc->requestUserInfo('name') ?: 'CipherBank Customer';
    }

    session_regenerate_id(true);

    $_SESSION['user'] = [
        'name' => (string) $name,
        'sub' => (string) $oidc->requestUserInfo('sub')
    ];

    header('Location: /dashboard.php');
    exit;
} catch (Throwable $e) {
    error_log('CipherBank OIDC callback error: ' . $e->getMessage());
    http_response_code(500);
    echo '<h1>Sign-in could not be completed</h1>';
    echo '<p>Check the OIDC configuration and PHP server logs.</p>';
}
