<?php

namespace ItsDamien\Heroku\Config\Tests;

class ExampleTest extends \PHPUnit_Framework_TestCase
{
    public function testDatabasePgsql()
    {
        putenv('HEROKU_DATABASE=DATABASE_URL');
        putenv('DATABASE_URL=postgres://usr:pwd@localhost:5432/hellodb');

        new \ItsDamien\Heroku\Config\Parse();

        $this->assertSame(getenv('DB_CONNECTION'), 'pgsql');
        $this->assertSame(getenv('DB_HOST'), 'localhost');
        $this->assertSame(getenv('DB_PORT'), '5432');
        $this->assertSame(getenv('DB_DATABASE'), 'hellodb');
        $this->assertSame(getenv('DB_USERNAME'), 'usr');
        $this->assertSame(getenv('DB_PASSWORD'), 'pwd');
    }

    public function testDatabaseMysql()
    {
        putenv('HEROKU_DATABASE=DATABASE_URL');
        putenv('DATABASE_URL=mysql://usr:pwd@localhost:3306/hellodb');

        new \ItsDamien\Heroku\Config\Parse();

        $this->assertSame(getenv('DB_CONNECTION'), 'mysql');
        $this->assertSame(getenv('DB_HOST'), 'localhost');
        $this->assertSame(getenv('DB_PORT'), '3306');
        $this->assertSame(getenv('DB_DATABASE'), 'hellodb');
        $this->assertSame(getenv('DB_USERNAME'), 'usr');
        $this->assertSame(getenv('DB_PASSWORD'), 'pwd');
    }

    public function testRedis()
    {
        putenv('HEROKU_REDIS=REDIS_URL');
        putenv('REDIS_URL=redis://h:pwd@ec2-s1:11469');

        new \ItsDamien\Heroku\Config\Parse();

        $this->assertSame(getenv('REDIS_HOST'), 'ec2-s1');
        $this->assertSame(getenv('REDIS_PORT'), '11469');
        $this->assertSame(getenv('REDIS_PASSWORD'), 'pwd');
    }
}
