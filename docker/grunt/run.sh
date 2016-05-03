#!/usr/bin/env bash

function log() {
    echo ""
    date
    echo $1
}

cd /app

log "Grunt: Copying node modules from global directory."
cp -R /npm/node_modules /app/

GRUNT_PARAMS="$*"
log "Grunt: Running with parameters: $GRUNT_PARAMS"

grunt "$GRUNT_PARAMS"

log  "Grunt: Done."
