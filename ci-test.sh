#!/bin/bash
set -e
set -x

vendor/bin/phpcs --standard=catchndealz.phpcs.xml --extensions=php app -snp
vendor/bin/phpunit
