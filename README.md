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

## Setting up Mail server
Set up the ff. values in the .env file:
```
 MAIL_MAILER=smtp
 MAIL_HOST=<SMTP server>
 MAIL_PORT=<SMTP server port>
 MAIL_USERNAME=<USERNAME/EMAIL>
 MAIL_PASSWORD=<PASSWORD>
 MAIL_ENCRYPTION=<YOU MAIL ENCRYPTION METHOD>
 MAIL_FROM_ADDRESS="<EMAIL ADDRESS TO APPEAR IN EMAIL SENDER FROM>"
 MAIL_FROM_NAME="<NAME TO APPEAR IN EMAIL SENDER NAME>"
```

## Mail server setup using Sendgrid
To setup Mail server using sendgrid. use the ff. configurations:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=<YOUR SENDGRID API KEY>
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="<EMAIL ADDRESS TO APPEAR IN EMAIL SENDER FROM>"
MAIL_FROM_ADDRESS="<NAME TO APPEAR IN EMAIL SENDER NAME>"
```

Reference Link: https://docs.sendgrid.com/for-developers/sending-email/laravel

Note: that for this to work, you need to setup your Sender Identity within Sendgrid dashboard. You may follow this *[Guide](https://docs.sendgrid.com/for-developers/sending-email/sender-identity)* to do so.

## How to run
Open terminal and cd to project root directory
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail artisan migrate`
- `./vendor/bin/sail artisan db:seed`

## How to stop
Open terminal and cd to project root directory
- `./vendor/bin/sail down -v`
