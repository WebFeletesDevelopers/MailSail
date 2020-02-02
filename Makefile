dcompose=docker-compose
devfile=docker-compose-dev.yml
php_container=php

docker-images-dev:
	$(dcompose) -f $(devfile) pull
	$(dcompose) -f $(devfile) build

dependencies-dev:
	$(dcompose) -f $(devfile) run $(php_container) composer install

build-dev: docker-images-dev dependencies-dev

phpunit:
	$(dcompose) -f $(devfile) run $(php_container) php vendor/bin/phpunit -c test/phpunit.xml

phpunit-coverage:
	$(dcompose) -f $(devfile) run $(php_container) php vendor/bin/phpunit -c test/phpunit.xml --coverage-html test/coverage/unit

command:
	$(dcompose) -f $(devfile) run $(php_container) $(args)