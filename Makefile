dcompose=docker-compose
devfile=docker-compose-dev.yml
php_container=php

docker-images-dev:
	$(dcompose) -f $(devfile) pull
	$(dcompose) -f $(devfile) build

dependencies-dev:
	$(dcompose) -f $(devfile) run $(php_container) composer install

scripts:
	sh cfg/scripts/set_up_git_hooks.sh

build-dev: docker-images-dev dependencies-dev scripts

phpunit:
	$(dcompose) -f $(devfile) run $(php_container) php vendor/bin/phpunit -c test/phpunit.xml

phpunit-coverage:
	$(dcompose) -f $(devfile) run $(php_container) php vendor/bin/phpunit -c test/phpunit.xml --coverage-html test/coverage/unit

command:
	$(dcompose) -f $(devfile) run $(php_container) $(args)