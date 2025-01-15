There are a few steps you need to follow to start the project

 - create a copy of the configuration file cp .env.example .env
 - generate a key php artisan key:generate
 - configure ports for docker in the .env file
 - configure mail in the .env file
 - install all necessary packages - composer install
 - launch a project ./vendor/bin/sail up -d
 - go to bash ./vendor/bin/sail bash
 - update all packages composer update
 - perform migration - php artisan migrate
 - perform seed - php artisan db:seed --class=CreateAdminUserSeed
 - start the queue listener - php artisan queue:work