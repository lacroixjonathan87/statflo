# statflo

Start dev environment
```
docker-compose up --build -d
cp .env.example .env
docker-compose exec web php artisan key:generate
```

Run tests [![Build Status](https://travis-ci.org/lacroixjonathan87/statflo.svg?branch=master)](https://travis-ci.org/lacroixjonathan87/statflo)
> docker-compose exec web vendor/bin/phpunit

Connect to the box
> docker-compose exec web bash
