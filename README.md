# Laravel Heroku Config Parser

[![Packagist Latest Version][ico-version]][link-packagist]
[![Packagist Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![StyleCI][ico-styleci]][link-styleci]

Parse Heroku config vars like `DATABASE_URL` or `REDIS_URL` to work with Laravel.

## Why

When adding a database or a redis server to your Heroku app, Heroku add a config var with this url syntax:
`DATABASE_URL=postgres://foo:foo@localhost/hellodb`

Unfortunately, Laravel can't read these vars, so you probably have parsed them manually like this:
```shell
heroku config:set DB_CONNECTION=mysql
heroku config:set DB_HOST=host
heroku config:set DB_PORT=port
heroku config:set DB_DATABASE=database
heroku config:set DB_USERNAME=username
heroku config:set DB_PASSWORD=password
```

**Laravel Heroku Config Parser** parse automatically your `DATABASE_URL` and `REDIS_URL` to dynamically set all vars needed by Laravel [(example)](#what-is-parsed).

## Installation

Installation using composer:

```
composer require itsdamien/laravel-heroku-config-parser
```

### Heroku

Add these config vars:

```shell
heroku config:set HEROKU_DATABASE=DATABASE_URL
heroku config:set HEROKU_REDIS=REDIS_URL
```

### Laravel

Add this block code to the top of your `config/database.php`:

```php
if (class_exists('\ItsDamien\Heroku\Config\Parse')) {
    new \ItsDamien\Heroku\Config\Parse();
}
```

**Enjoy !**

## What is parsed

| DATABASE_URL  | postgres://usr:pwd@ec2-s1:5432/db1 | mysql://usr:pwd@ec2-s2:3306/db2 |
|---------------|------------------------------------|-----------------------------|
| DB_CONNECTION | pgsql                              | mysql                       |
| DB_HOST       | ec2-s1                             | ec2-s2                      |
| DB_PORT       | 5432                               | 3306                        |
| DB_DATABASE   | db1                                | db2                         |
| DB_USERNAME   | usr                                | usr                         |
| DB_PASSWORD   | pwd                                | pwd                         |

| REDIS_URL      | redis://h:pwd@ec2-s1:11469 |
|----------------|----------------------------|
| REDIS_HOST     | ec2-s1                     |
| REDIS_PORT     | 11469                      |
| REDIS_PASSWORD | pwd                        |

## Select the config var who will be parsed

You can select wich config var will be parsed by setting `HEROKU_DATABASE` and `HEROKU_REDIS` like this:

```bash
heroku config:set HEROKU_DATABASE=HEROKU_POSTGRESQL_BRONZE
heroku config:set HEROKU_REDIS=REDIS_URL_BACKUP
```

## License

**Laravel Heroku Config Parser** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

[ico-version]: https://img.shields.io/packagist/v/itsdamien/laravel-heroku-config-parser.svg
[ico-downloads]: https://img.shields.io/packagist/dt/itsdamien/laravel-heroku-config-parser.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg
[ico-styleci]: https://styleci.io/repos/83414040/shield?branch=master&style=flat

[link-packagist]: https://packagist.org/packages/itsdamien/laravel-heroku-config-parser
[link-downloads]: https://packagist.org/packages/itsdamien/laravel-heroku-config-parser
[link-styleci]: https://styleci.io/repos/83414040
