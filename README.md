## Prerequisites
- Download [Docker](https://www.docker.com/products/docker-desktop/)
- Install Sail: 
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

## How to run
- Open terminal and cd to project root directory
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail artisan migrate`
- `./vendor/bin/sail artisan db:seed`

## How to stop
- `./vendor/bin/sail down -v`
