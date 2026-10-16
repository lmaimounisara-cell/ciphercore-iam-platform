#!/usr/bin/env bash
set -u

BASE_URL="http://localhost:8083"
TOKEN_FILE="/tmp/ciphercore-access-token"

if [ ! -f "$TOKEN_FILE" ]; then
    echo "ERROR: Token file not found."
    exit 1
fi

TOKEN=$(cat "$TOKEN_FILE")

check_status() {
    local description="$1"
    local expected="$2"
    local url="$3"
    local token="${4:-}"
    local actual

    if [ -n "$token" ]; then
        actual=$(curl -s -o /dev/null -w "%{http_code}" \
            -H "Authorization: Bearer $token" "$url")
    else
        actual=$(curl -s -o /dev/null -w "%{http_code}" "$url")
    fi

    if [ "$actual" = "$expected" ]; then
        echo "PASS: $description (HTTP $actual)"
    else
        echo "FAIL: $description (expected $expected, got $actual)"
        return 1
    fi
}

echo "CipherCore RBAC integration tests"
echo "================================="

check_status "Public health endpoint" 200 "$BASE_URL/api/health"
check_status "Unauthenticated admin request" 401 "$BASE_URL/api/admin/dashboard"
check_status "Admin access to admin endpoint" 200 "$BASE_URL/api/admin/dashboard" "$TOKEN"
check_status "Admin access to visitor endpoint" 403 "$BASE_URL/api/visitor/dashboard" "$TOKEN"
check_status "Admin access to editor endpoint" 403 "$BASE_URL/api/editor/dashboard" "$TOKEN"
