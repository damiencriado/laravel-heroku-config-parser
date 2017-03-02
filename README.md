<p align="center"><img src="https://www.dropbox.com/s/jsq5x1g72lc8wir/laravel-heroku-config-parser.png?raw=1" width="600"></p>

[![Packagist Latest Version][ico-version]][link-packagist]
[![Packagist Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Code Climate][ico-codeclimate]][link-codeclimate]
[![Code Climate Coverage][ico-coverage]][link-codeclimate]
[![StyleCI][ico-styleci]][link-styleci]

Parse Heroku config vars like `DATABASE_URL` or `REDIS_URL` to work with Laravel.

## Why

When adding a database or a redis server to your Heroku app, Heroku add a URL config var like this:
`DATABASE_URL=postgres://usr:pwd@localhost:5432/hellodb`

Unfortunately, Laravel can't read this var, so you probably parsed it manually like this:

```shell
heroku config:set DB_CONNECTION=pgsql
heroku config:set DB_HOST=localhost
heroku config:set DB_PORT=5432
heroku config:set DB_DATABASE=hellodb
heroku config:set DB_USERNAME=usr
heroku config:set DB_PASSWORD=pwd
```

**Laravel Heroku Config Parser** parse automatically your `DATABASE_URL` and `REDIS_URL` to dynamically set all vars needed by Laravel [(see the list)](#list-of-injected-config-var).

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

## List of injected config var

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

## Customize the config var who will be parsed

You can select wich config var will be parsed by setting `HEROKU_DATABASE` and `HEROKU_REDIS` like this:

```bash
heroku config:set HEROKU_DATABASE=HEROKU_POSTGRESQL_BRONZE
heroku config:set HEROKU_REDIS=REDIS_URL_BACKUP
```

## License

**Laravel Heroku Config Parser** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

[ico-version]: https://img.shields.io/packagist/v/itsdamien/laravel-heroku-config-parser.svg
[ico-downloads]: https://img.shields.io/packagist/dt/itsdamien/laravel-heroku-config-parser.svg
[ico-license]: https://img.shields.io/packagist/l/itsdamien/laravel-heroku-config-parser.svg
[ico-codeclimate]: https://codeclimate.com/repos/58b753f882f55c02710000b5/badges/7f0130fdf76c7fe7e8cd/gpa.svg
[ico-coverage]: https://codeclimate.com/repos/58b753f882f55c02710000b5/badges/7f0130fdf76c7fe7e8cd/coverage.svg
[ico-styleci]: https://styleci.io/repos/83414040/shield?branch=master&style=flat

[link-packagist]: https://packagist.org/packages/itsdamien/laravel-heroku-config-parser
[link-downloads]: https://packagist.org/packages/itsdamien/laravel-heroku-config-parser
[link-codeclimate]: https://codeclimate.com/repos/58b753f882f55c02710000b5/feed
[link-styleci]: https://styleci.io/repos/83414040
