# System dependencies

php8.2

mysql8 or mariadb10

# Installation

composer install

### If new database needs to be migrated

php artisan migrate

# Deploy
composer install

php artisan migrate

php artisan scribe:generate

### Swagger URL

/swagger

### Updating swagger

php artisan scribe:generate
