<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/auth.php';

try {
    loadAppBEnv();
    require_once dirname(__DIR__, 2) . '/app/vendor/autoload.php';

    $issuer = getenv('OIDC_APP_B_ISSUER');
    $clientId = getenv('OIDC_APP_B_CLIENT_ID');
    $clientSecret = getenv('OIDC_APP_B_CLIENT_SECRET');
    $redirectUri = getenv('OIDC_APP_B_REDIRECT_URI');

    if (!$issuer || !$clientId || !$clientSecret || !$redirectUri) {
        throw new RuntimeException('BeeHappy OIDC settings are missing from .env.');
    }

    $oidc = new Jumbojett\OpenIDConnectClient(
        $issuer,
        $clientId,
        $clientSecret
    );

    $oidc->setRedirectURL($redirectUri);
    $oidc->authenticate();

    // With this redirect URI, authenticate() should redirect to Keycloak.
    // The callback endpoint handles the authorization response.
    header('Location: /');
    exit;
} catch (Throwable $e) {
    error_log('BeeHappy login error: ' . $e->getMessage());
    http_response_code(500);
    echo 'Sign-in could not be started. Check BeeHappy configuration and PHP logs.';
}
