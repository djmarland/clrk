#!/bin/sh

vendor/bin/phpunit -c app/tests/phpunit.xml app/tests
vendor/bin/phpcs app --ignore=build,vendor,node_modules,tmp --standard=PSR2 -p