<p align="center"><img src="https://www.dropbox.com/s/jsq5x1g72lc8wir/laravel-heroku-config-parser.png?raw=1" width="600"></p>

[![Latest Stable Version](https://poser.pugx.org/itsdamien/laravel-heroku-config-parser/v/stable)](https://packagist.org/packages/itsdamien/laravel-heroku-config-parser)
[![Total Downloads](https://poser.pugx.org/itsdamien/laravel-heroku-config-parser/downloads)](https://packagist.org/packages/itsdamien/laravel-heroku-config-parser)
[![License](https://poser.pugx.org/itsdamien/laravel-heroku-config-parser/license)](https://packagist.org/packages/itsdamien/laravel-heroku-config-parser)
[![Build Status](https://travis-ci.org/itsDamien/laravel-heroku-config-parser.svg?branch=master)](https://travis-ci.org/itsDamien/laravel-heroku-config-parser)
[![Coverage Status](https://coveralls.io/repos/github/itsDamien/laravel-heroku-config-parser/badge.svg?branch=master)](https://coveralls.io/github/itsDamien/laravel-heroku-config-parser?branch=master)
[![Code Climate](https://codeclimate.com/github/itsDamien/laravel-heroku-config-parser/badges/gpa.svg)](https://codeclimate.com/github/itsDamien/laravel-heroku-config-parser)
[![StyleCI](https://styleci.io/repos/83414040/shield?branch=master&style=flat)](https://styleci.io/repos/83414040)

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

## ENV vars created

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
