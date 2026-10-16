# CipherCore — Phase 4 Verification Report

## Objective
Verify Keycloak authentication, JWT validation, and role-based access control (RBAC) in the Spring Boot API.

## Environment
- Identity Provider: Keycloak
- Realm: CipherCore
- Test client: ciphercore-api-v2
- API: Spring Boot Resource Server
- API base URL: http://localhost:8083

## Implemented roles
- VISITEUR: read-only visitor access
- EDITEUR: editor access
- ADMIN: administrative access

## Automated ADMIN test results
| Test | Expected HTTP status | Observed result |
|---|---:|---|
| Public health endpoint | 200 | PASS |
| Admin endpoint without token | 401 | PASS |
| Admin token accessing admin endpoint | 200 | PASS |
| Admin token accessing visitor endpoint | 403 | PASS |
| Admin token accessing editor endpoint | 403 | PASS |

## Additional manual verification
- VISITEUR token accessed the visitor endpoint successfully (200).
- EDITEUR token accessed the editor endpoint successfully (200).
- EDITEUR token was denied access to the admin endpoint (403).
- ADMIN token accessed the admin endpoint successfully (200).

## Security behavior
- Requests without a valid token are rejected.
- Authenticated users are restricted according to their assigned realm roles.
- Role claims are extracted from the Keycloak JWT realm_access.roles claim.

## Conclusion
The tested API endpoints enforce the configured role-based access rules.
The ADMIN automated test suite passed all five checks.

## Evidence files
- rbac-admin-test-results.txt — automated test output
