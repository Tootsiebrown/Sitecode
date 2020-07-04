#!/bin/bash
set -e
set -x

vendor/bin/phpcs --standard=PSR12 --extensions=php app
vendor/bin/phpunit
