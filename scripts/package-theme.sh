#!/bin/bash
set -e

# Package WordPress Theme into installable ZIP archive
REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_DIR="$REPO_ROOT/genesis-theme"
ZIP_FILE="$REPO_ROOT/genesis-theme.zip"

echo "Packaging WordPress Theme from: $THEME_DIR"

if [ ! -d "$THEME_DIR" ]; then
    echo "Error: Theme directory not found at $THEME_DIR"
    exit 1
fi

rm -f "$ZIP_FILE"

cd "$REPO_ROOT"
zip -r "$ZIP_FILE" genesis-theme -x "*.DS_Store" "*__MACOSX*" "*.git*"

echo "Successfully packaged: $ZIP_FILE"
ls -lh "$ZIP_FILE"
