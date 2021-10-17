# Advert campaign is built using vueJs, vuex and laravel

## Requirements

- PHP 8.0+, docker, docker-compose, NODE 14.0+
- Other requirements can be found in the composer.json file

## Installing

### Setup hosts (virtual host)

- /etc/hosts (linux)
- C:\Windows\System32\drivers\etc\hosts (Windows)

### Installing
- After clone run 'composer install' to install dependencies
- run 'npm install' to install node dependancies
- change directory to laradock-laraveldock
- Enter the laradock folder `cp .env.example .env`
- open docker-compose.yml file and edit the frontend and backend alias of NGINX to your created host
- run `docker-compose up -d --build nginx phpmyadmin`
- Navigate to phpmyadmin with default_host:8081 and create your database (lara_db in my case) with these credentials:
	**Hostname: mysql**
	**Username: test**
	**Password: password**
- `cp .env.example .env` within the project root
- Edit the env to connet Laravel with Database


```bash
docker-compose exec workspace bash

```

Generate the new keys for the application:

```bash
artisan key:generate
```

Execute the migrations:

```bash
artisan migrate
```

### Build node

```bash
npm run prod
```

### To exit docker

```bash
docker-compose down
```
