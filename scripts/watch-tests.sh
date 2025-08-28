#!/usr/bin/env bash
set -euo pipefail

# Lightweight test watcher for this Laravel project.
# - Watches source/test files and runs `composer test` on changes.
# - Prefers `entr` if available, otherwise falls back to a portable polling loop.

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")"/.. && pwd)"
cd "$ROOT_DIR"

filter_paths() {
  # List files to watch, excluding heavy/generated folders
  if command -v rg >/dev/null 2>&1; then
    rg --files \
      -g '!vendor/**' \
      -g '!node_modules/**' \
      -g '!storage/**' \
      -g '!bootstrap/cache/**' \
      -g '!public/**' \
      -g '!**/*.min.js' \
      -g '!**/*.map' \
      app config routes resources tests composer.json package.json vite.config.js phpunit.xml
  else
    find app config routes resources tests \( -type f \) \
      -not -path '*/vendor/*' \
      -not -path '*/node_modules/*' \
      -not -path '*/storage/*' \
      -not -path '*/bootstrap/cache/*' \
      -not -path '*/public/*'
    printf '%s\n' composer.json package.json vite.config.js phpunit.xml
  fi
}

run_tests() {
  echo "[watch-tests] Running tests..." >&2
  if command -v composer >/dev/null 2>&1; then
    composer test || true
  else
    php artisan test || true
  fi
}

if command -v entr >/dev/null 2>&1; then
  # Use entr for efficient filesystem watching
  filter_paths | sort -u | entr -c -s 'echo [watch-tests] Change detected; composer test || true'
  exit 0
fi

# Portable polling fallback
echo "[watch-tests] entr not found; using portable polling watcher (1s interval)." >&2

snapshot() {
  # Cross-platform stat format (BSD vs GNU)
  if stat --version >/dev/null 2>&1; then
    # GNU stat
    filter_paths | xargs -I{} stat -c '%Y %n' {} 2>/dev/null | LC_ALL=C sort
  else
    # BSD/macOS stat
    filter_paths | xargs -I{} stat -f '%m %N' {} 2>/dev/null | LC_ALL=C sort
  fi
}

prev_hash=""
while true; do
  cur_hash=$(snapshot | cksum | awk '{print $1":"$2}')
  if [[ "$prev_hash" != "$cur_hash" ]]; then
    prev_hash="$cur_hash"
    run_tests
  fi
  sleep 1
done

