#!/usr/bin/env bash

# Usage:
# bin/test [params]
#

bin/composer.sh dump-autoload > /dev/null
bin/composer.sh install

mkdir -p build

docker-compose \
  -f dc-test.yml \
  run -T --rm \
  web \
  /var/www/html/vendor/bin/phpunit --stderr --color $@ 2>&1 | tee build/test.log

bin/own.sh ${PWD}/build

#  Would be great if this would cause xdebug to work, but it does not
#
# http://randyfay.com/content/remote-command-line-debugging-phpstorm-phpdrupal-including-drush
# https://blog.flavia-it.de/xdebug-im-docker-container/
#
# docker-compose run -T \
#     -e XDEBUG_CONFIG="idekey=PHPSTORM profiler_enable=1" \
#     -e PHP_IDE_CONFIG="serverName=localhost" \
#     web \
#     php /var/www/html/vendor/bin/phpunit --stderr --color $@
