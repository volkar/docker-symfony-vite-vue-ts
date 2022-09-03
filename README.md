# docker-vite-symfony-nginx-php-postgres

Minimal clean Docker configuration with PHP 8.1+, NGINX 1.20+, PostgreSQL 14.2+ and Symfony 6.0 for development.

- Based on Alpine Linux.
- Xdebug and PHPUnit.
- Doctrine
- Makefile

## Prerequisites

Required requisites:

1. [Git](https://git-scm.com/book/en/Getting-Started-Installing-Git)
2. [Docker](https://docs.docker.com/engine/installation/)
3. [Docker Compose](https://docs.docker.com/compose/install/)
4. [Composer](https://getcomposer.org)

Docker and Docker Compose can be installed with [Docker Desktop](https://www.docker.com/products/docker-desktop/) app.

## Initialization

1. Clone the project:

```
git clone https://github.com/volkar/docker-symfony-nginx-php-postgres.git
```

2. Go to the project's folder

```
cd /path/to/docker-symfony-nginx-php-postgres
```

3. Update and install Composer packages

```
composer update
```

4. Build and up project with Docker Compose

```
docker-compose up -d --build
```

5. Open `http://localhost` in your browser, you should see the Symfony's welcome page.

## Using

### Using Docker Compose

Build and up:

```
docker-compose up -d --build
```

Up only:

```
docker-compose up -d
```

Down:

```
docker-compose down
```

Rebuild and up:

```
docker-compose down -v --remove-orphans
docker-compose rm -vsf
docker-compose up -d --build
```

### Using PostgreSQL

All .sql files inside `docker/postgres/conf` will be executed on container build. Currently, there is `docker/postgres/conf/create_test_table.sql` file, creating `test_table` with 3 records for testing purposes. It can be safely deleted.

Postgres database name, user and password defined in `.env` file.

Connect to database with default login:

```
docker-compose exec postgres psql -U dbuser dbname
```

### Using PHP

PHP config located at `docker/php/conf/php.ini`. You might want to change `date.timezone` value in `php.ini`. Default value is `Europe/Helsinki` (GMT+3).

Execute command `php -v` in the `php` container:

```
docker-compose exec php php -v
```

*There is OPCache commented out settings in `php.ini` as well as loading line in `Dockerfile` if you need it, by any means. Not recommended for development environment.*

### Using PHPUnit

There is two test for testing Docker environment:

1. PHPUnit self test
2. PostgreSQL connection test

Run the tests:

```
docker-compose exec php vendor/bin/phpunit ./tests
```

Successfully passed tests output:

```
OK (2 tests, 2 assertions)
```

### Using Xdebug

XDebug config located at `docker/php/conf/xdebug.ini`.

To enable Xdebug at the project build, set `INSTALL_XDEBUG` variable to `true` in `.env` file.

### Using Makefile

To execute Makefile command use `make <command>` from project's folder

List of commands:

| Command | Description |
| ----------- | ----------- |
| up | Up containers |
| down | Down containers |
| build | Build/rebuild continers |
| test | Run PHPUnit tests |
| bash | Use bash in `php` container as `www-data` |
| bash_root | Use bash in `php` container as `root` |

## Mapping

Folders mapped for default Symfony folder structure (assuming local `/` is project's folder):

| Local | Container | Description |
| - | - | - |
| / | /var/www | Project root |
| /public | /var/www/public | Web server document root |
| /logs/nginx | /var/logs/nginx | NGINX logs |

Ports mapped default:

| Local | Container | Description |
| - | - | - |
| 80 | 80 | NGINX port |
| 5432 | 5432 | PostgreSQL port |

## Contact me

You always welcome to mail me at sergey@volkar.ru
