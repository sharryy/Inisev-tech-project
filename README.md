## Subscription Service

Please visit [problem](docs/challenge.md) for more details about the challenge.

## Getting Started

1. Clone the repository

```bash
$ git clone git@github.com:sharryy/Inisev-tech-project.git
```

2. Install dependencies

```bash
$ composer install
```

3. Copy .env.example to .env

```bash
$ cp .env.example .env
```

4. Replace database and mail credentials in .env file
5. Generate application key

```bash
$ php artisan key:generate
```

6. Run migrations

```bash
$ php artisan migrate
```

7. Seed data

```bash
$ php artisan db:seed
```

8. Seed database with dummy data

```bash
php artisan db:seed
```

9. Visit http://127.0.0.1:8000/docs to view the API documentation

### Running the tests

```bash
$ php artisan test
```

### License

[MIT](LICENSE)
