## Subscription Service

Please visit [problem](docs/challenge.md) for more details about the challenge.

## Getting Started

- Clone the repository

```bash
$ git clone git@github.com:sharryy/Inisev-tech-project.git
```

- Install dependencies

```bash
$ composer install
```

- Copy .env.example to .env

```bash
$ cp .env.example .env
```

- Replace database and mail credentials in .env file
- Generate application key

```bash
$ php artisan key:generate
```

- Run migrations

```bash
$ php artisan migrate
```

- Seed data

```bash
$ php artisan db:seed
```

- Visit http://127.0.0.1:8000/docs to view the API documentation


