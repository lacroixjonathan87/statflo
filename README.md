# statflo

Start dev environment
```
docker-compose up --build (-d)
cp .env.example .env
docker-compose exec web php artisan key:generate
```

Run test
> docker-compose exec web vendor/bin/phpunit

Connect to the box
> docker-compose exec web bash
