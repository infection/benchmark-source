# See https://tech.davis-hansson.com/p/make/
MAKEFLAGS += --warn-undefined-variables
MAKEFLAGS += --no-builtin-rules

PHPUNIT_BIN = vendor/bin/phpunit
PHPUNIT = $(PHPUNIT_BIN)
COVERAGE_DIR = dist/coverage

.DEFAULT_GOAL := test

.PHONY: help
help:
	@printf "\033[33mUsage:\033[0m\n  make TARGET\n\n\033[32m#\n# Commands\n#---------------------------------------------------------------------------\033[0m\n"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//' | awk 'BEGIN {FS = ":"}; {printf "\033[33m%s:\033[0m%s\n", $$1, $$2}'

.PHONY: test
test:	## Executes the tests
test: $(PHPUNIT_BIN)
	$(PHPUNIT)

vendor: composer.lock
	composer install
	touch -c $@

composer.lock: composer.json
	composer update --lock
	touch -c $@
	touch -c vendor

$(PHPUNIT_BIN): vendor
	touch -c $@

$(RECTOR_BIN): vendor
	touch -c $@
