#!/usr/bin/env bash

docker build -t grunt -f docker/grunt/Dockerfile .

docker run \
  --rm \
  -v "$PWD":/app \
  -w /app \
  -p 35729:35729 \
  grunt $*

bin/own.sh ${PWD}/public
