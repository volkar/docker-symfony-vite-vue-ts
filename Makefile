up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose down -v --remove-orphans
	docker-compose rm -vsf
	docker-compose up -d --build

test:
	docker-compose exec php vendor/bin/phpunit ./tests

bash:
	docker-compose exec -u www-data php bash

bash_root:
	docker-compose exec -u 0 php bash

