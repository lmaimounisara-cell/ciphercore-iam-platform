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

    $sub = $oidc->getVerifiedClaims('sub');
    $username = $oidc->requestUserInfo('preferred_username');

    if (!$sub) {
        throw new RuntimeException('Verified subject claim is missing.');
    }

    session_regenerate_id(true);
    $_SESSION['app_b_user'] = [
        'sub' => (string) $sub,
        'name' => (string) (
            $username ?: $oidc->requestUserInfo('name') ?: 'BeeHappy Customer'
        )
    ];

    header('Location: /dashboard.php');
    exit;
} catch (Throwable $e) {
    error_log('BeeHappy callback error: ' . $e->getMessage());
    http_response_code(500);
    echo 'Sign-in could not be completed. Check the PHP server logs.';
}
