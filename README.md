Laravel Broadcast Demo
---

# WARNING
**THIS PROJECT DOESN'T BOTHER REGARDING SECURITY. IT'S UPTO YOU HOW YOU WANT TO IMPLEMENT SECURITY**

### Key generation
You can use any of the following to generate random key if you have PHP installed in your machine.
- `php artisan key:generate --ansi --show`
- `php -r "echo password_hash(uniqid(), PASSWORD_BCRYPT).\"\n\";"`
- `php -r "echo md5(uniqid()).\"\n\";"`
- `php -r "echo bin2hex(random_bytes(16));"`

### Requirements
This project comes with Docker. If using docker, to minimize the docker build time, the project requires to `php`, `composer`, `node`, `npm`/`yarn` in your local machine.

### Installation
- Clone this repository.
- Copy your `docker-compose.yml.example` to `docker-compose.yml`. Example: `cp docker-compose.yml.example docker-compose.yml`.
- Update your `docker-compose.yml` with appropriate values.
- Copy `.env.example` to `.env`. Example: `cp .env.example .env`.
- Update your `.env` variable values.
- `composer install` to install dependencies.
- `yarn install` or `npm install` to install JS dependencies.
- `docker-compose up -d --build` to start the project containers.
- Run `http://IP_ADDRESS:NGINX_PORT_NUMBER` to run the project. Example: `http://127.0.0.1:PORT_NUMBER`.

**N.B: If you're working locally, it's mandatory to download the requirements via composer.**

