# docker-symfony-vite-vue-ts

Docker configuration with PHP 8.1+, NGINX 1.20+, PostgreSQL 14.2+ and Symfony 6.0 for SPA (Single Page Application) development with Vue/Vite, Pinia and EasyAdmin.

![SPA preview](https://github.com/volkar/docker-symfony-vite-vue-ts/blob/main/preview.jpg?raw=true)

### Docker container:
- Based on Alpine Linux
- Xdebug and PHPUnit
- Makefile
### Symfony backend:
- Symfony Data Fixtures (pages, categories, projects, users)
- Symfony Security for EasyAdmin
- [Serenity theme](https://github.com/volkar/easyadmin-serenity-theme) for EasyAdmin
 
### Vue frontend:
- TypeScript
- Vue 3
- Vite for assets build
- Pinia for data store
- ky for fetching data
- Simple SPA with basic routes for example
- [Cache system](https://github.com/volkar/vue-pinia-cache-composables) requests for symfony backend


## Prerequisites

Required requisites:

1. [Git](https://git-scm.com/book/en/Getting-Started-Installing-Git)
2. [Docker](https://docs.docker.com/engine/installation/)
3. [Docker Compose](https://docs.docker.com/compose/install/)

Docker and Docker Compose can be installed with [Docker Desktop](https://www.docker.com/products/docker-desktop/) app.

## Initialization

1. Clone the project:

```
git clone https://github.com/volkar/docker-symfony-vite-vue-ts.git
```

2. Go to the project's folder

```
cd /path/to/docker-symfony-vite-vue-ts
```

3. Update and install composer packages

```
composer update
```

4. Build and up project with Docker Compose

```
docker-compose up -d --build
```

5. Enter container's shell
```
make bash
```
6. Create database schema
```
symfony console doctrine:schema:update --force
```
7. Load data from symfony fixtures
```
symfony console doctrine:fixtures:load
```
8. Exit container's shell
```
exit
```
9. Install all node's dependencies
```
npm install
```
10. Run Vite dev server
```
npm run dev
```
11. Open `http://localhost` in your browser.

Administrator account created by fixtures (for EasyAdmin access):
- login: **admin@admin.com**
- pass: **admin**

## Using

### Using Docker Composer

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

Postgres database name, user and password defined in `.env` file.

All .sql files inside `docker/postgres/conf` will be executed on container build.

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
| /docker/postgres/data | /var/lib/postgresql/data | PostgreSQL data files |


Ports mapped default:

| Local | Container | Description |
| - | - | - |
| 80 | 80 | NGINX port |
| 5432 | 5432 | PostgreSQL port |

## Contact me

You always welcome to mail me at sergey@volkar.ru
