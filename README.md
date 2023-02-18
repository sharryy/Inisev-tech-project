## Subscription Service

Create a simple subscription platform(only RESTful APIs with MySQL) in which users can subscribe to a website (there can
be multiple websites in the system). Whenever a new post is published on a particular website, all it's subscribers
shall receive an email with the post title and description in it

> **Note:** Please visit [DOCS](docs/db_structure.png) for database design

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

4. Replace following database and mail credentials in .env file

```bash
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

MAIL_DRIVER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
```

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
