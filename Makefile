.PHONY: build clean test

build: vendor

vendor:
	composer install

clean:
	rm -rf $(CURDIR)/vendor
	rm -f $(CURDIR)/composer.lock

test: build vendor
	$(CURDIR)/vendor/bin/phpunit $(CURDIR)/tests
