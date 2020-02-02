dcompose=docker-compose
devfile=docker-compose-dev.yml
php_container=php

build-dev:
	$(dcompose) -f $(devfile) pull
	$(dcompose) -f $(devfile) build

command:
	$(dcompose) -f $(devfile) run $(php_container) $(args)
