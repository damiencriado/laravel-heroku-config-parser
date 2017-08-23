<?php

namespace ItsDamien\Heroku\Config;

class Parse
{
    private $databaseKey = 'KEY_DATABASE';
    private $redisKey = 'KEY_REDIS';

    public function __construct()
    {
        $this->database();
        $this->redis();
    }

    private function database()
    {
        $env = getenv(getenv($this->databaseKey));

        if ($env !== false) {
            $url = parse_url($env);

            if (isset($url['scheme']) && $url['scheme'] === 'mysql') {
                putenv('DB_CONNECTION=mysql');
            }

            if (isset($url['scheme']) && $url['scheme'] === 'postgres') {
                putenv('DB_CONNECTION=pgsql');
            }

            if (isset($url['host'])) {
                putenv('DB_HOST='.$url['host']);
            }

            if (isset($url['port'])) {
                putenv('DB_PORT='.$url['port']);
            }

            if (isset($url['path'])) {
                putenv('DB_DATABASE='.substr($url['path'], 1));
            }

            if (isset($url['user'])) {
                putenv('DB_USERNAME='.$url['user']);
            }

            if (isset($url['pass'])) {
                putenv('DB_PASSWORD='.$url['pass']);
            }
        }
    }

    private function redis()
    {
        $env = getenv(getenv($this->redisKey));

        if ($env !== false) {
            $url = parse_url($env);
            if (isset($url['host'])) {
                putenv('REDIS_HOST='.$url['host']);
            }

            if (isset($url['port'])) {
                putenv('REDIS_PORT='.$url['port']);
            }

            if (isset($url['pass'])) {
                putenv('REDIS_PASSWORD='.$url['pass']);
            }
        }
    }
}
