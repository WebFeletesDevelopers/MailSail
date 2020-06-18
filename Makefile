dcompose=docker-compose
devfile=docker-compose-dev.yml
php_container=php
mailhog_container=maildev

.PHONY: docs

docker-images-dev:
	$(dcompose) -f $(devfile) pull
	$(dcompose) -f $(devfile) build

dependencies-dev:
	$(dcompose) -f $(devfile) run $(php_container) composer install

dependency-update:
	$(dcompose) -f $(devfile) run $(php_container) composer update ${args}

scripts:
	sh cfg/scripts/set_up_git_hooks.sh

build-dev: docker-images-dev dependencies-dev scripts

maildev-start:
	$(dcompose) -f $(devfile) up -d $(mailhog_container)

maildev-stop:
	$(dcompose) -f $(devfile) stop $(mailhog_container)

phpunit: maildev-start
	$(dcompose) -f $(devfile) run $(php_container) php vendor/bin/phpunit -c test/phpunit.xml
	make maildev-stop

phpunit-coverage: maildev-start
	$(dcompose) -f $(devfile) run $(php_container) php vendor/bin/phpunit -c test/phpunit.xml --coverage-html test/coverage
	make maildev-stop

command:
	$(dcompose) -f $(devfile) run $(php_container) $(args)

phpstan:
	$(dcompose) -f $(devfile) run $(php_container) vendor/bin/phpstan analyse src test --level 8

phpcs:
	$(dcompose) -f $(devfile) run $(php_container) vendor/bin/phpcs --standard=PSR12 --ignore="test/coverage" -p --colors src test

infection:
	$(dcompose) -f $(devfile) run $(php_container) vendor/bin/infection --threads=4

docs:
	$(dcompose) -f $(devfile) run $(php_container) phpdoc -d ./src -t ./docs --template="clean"
