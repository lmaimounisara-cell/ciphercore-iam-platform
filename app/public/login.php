<?php
require_once __DIR__ . '/../src/auth.php';

try {
    loadLocalEnv();

    $clientId = getenv('OIDC_CLIENT_ID');
    $issuer = getenv('OIDC_ISSUER');
    $redirect = getenv('OIDC_REDIRECT_URI');

    if (!$clientId || !$issuer || !$redirect) {
        throw new RuntimeException('OIDC settings are missing from the local .env file.');
    }

    // State and nonce will be added by the OIDC client library.
    require_once __DIR__ . '/../vendor/autoload.php';

    $oidc = new Jumbojett\OpenIDConnectClient(
        $issuer,
        $clientId,
        getenv('OIDC_CLIENT_SECRET') ?: null
    );
    $oidc->setRedirectURL($redirect);
    $oidc->authenticate();

    $_SESSION['user'] = [
        'name' => (string)($oidc->requestUserInfo('name') ?: $oidc->requestUserInfo('preferred_username') ?: 'CipherBank Customer'),
        'sub' => (string)$oidc->getVerifiedClaims('sub')
    ];

    header('Location: /dashboard.php');
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    echo '<h1>Sign-in could not be completed</h1>';
    echo '<p>Check the local OIDC settings and Keycloak logs.</p>';
    error_log('CipherBank OIDC login error: ' . $e->getMessage());
}
