## Prerequisite
- [Docker](https://www.docker.com/products/docker-desktop/)

## How to run
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail artisan migrate`
- `./vendor/bin/sail artisan db:seed`

## How to stop
- `./vendor/bin/sail down -v`
