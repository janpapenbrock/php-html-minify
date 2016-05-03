#!/usr/bin/env bash

docker build -t npm -f docker/grunt/Dockerfile .

docker run \
  -it \
  --rm \
  --entrypoint npm \
  -v "$PWD":/app \
  -w /app \
  npm $*

bin/own.sh ${PWD}/package.json
bin/own.sh ${PWD}/node_modules/
