#!/bin/bash

DIR=$1

docker run \
  --rm \
  -v ${DIR}:/workdir \
  debian:wheezy \
  chown -R $(id -u):$(id -g) /workdir
