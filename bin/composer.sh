#!/usr/bin/env bash

docker-compose -f dc-composer.yml up

bin/own.sh "$PWD/composer.json"
bin/own.sh "$PWD/composer.lock"
bin/own.sh "$PWD/vendor"
