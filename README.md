# statflo
Submission to Statflo code challenge: https://github.com/Statflo/challenge-rest-api-java


### Start dev environment
```
docker-compose up -d
cp .env.example .env
docker-compose exec web php artisan key:generate
docker-compose exec web php artisan migrate
```

### Api documentation
https://documenter.getpostman.com/view/4390074/RWgxta3N

### CI/Automatic integration
[![Build Status](https://travis-ci.org/lacroixjonathan87/statflo.svg?branch=master)](https://travis-ci.org/lacroixjonathan87/statflo)

### Run tests
```
docker-compose exec web vendor/bin/phpunit
```
Use in memory database for speed

### Connect to the box
```
docker-compose exec web bash
```
