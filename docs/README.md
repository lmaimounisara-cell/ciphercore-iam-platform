# CipherCore — Identity & Access Management Platform

CipherCore is a local-first IAM portfolio project demonstrating centralized identity and access management for two PHP/OIDC demo applications and a Spring Boot protected API.

## What it demonstrates
- Keycloak as the OIDC identity provider for the `CipherCore` realm
- Password sign-in and configured TOTP multi-factor authentication
- Separate client applications: CipherBank and BeeHappy
- Shared Keycloak browser session / SSO flow between clients
- JWT access-token validation in a Spring Boot OAuth2 resource server
- Realm-role authorization using `ADMIN`, `EDITEUR`, and `VISITEUR`
- HTTP 200 for allowed requests, 401 for missing authentication, and 403 for insufficient privileges
- Automated RBAC checks and screenshot evidence

## Local architecture
- Keycloak + PostgreSQL via Docker Compose
- CipherBank PHP OIDC client
- BeeHappy PHP OIDC client
- Spring Boot API on the local development port
- Test script: `tests/test-rbac.sh`
- Evidence: `evidence/` and the portfolio gallery

## Important scope note
This project is a local development lab. It is not a deployed cloud service, a production banking application, or a security certification.

## Portfolio
Open `index.html` in a browser with the `assets/` folder kept alongside it.

## Source repository
https://github.com/lmaimounisara-cell/ciphercore-iam-platform

## Security hygiene
Do not commit `.env`, passwords, client secrets, bearer tokens, private keys, or screenshots containing live one-time codes.
