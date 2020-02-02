dcompose=docker-compose
devfile=docker-compose-dev.yml
php_container=php

docker-images-dev:
	$(dcompose) -f $(devfile) pull
	$(dcompose) -f $(devfile) build

dependencies-dev:
	$(dcompose) -f $(devfile) run $(php_container) composer install

build-dev: docker-images-dev dependencies-dev

command:
	$(dcompose) -f $(devfile) run $(php_container) $(args)