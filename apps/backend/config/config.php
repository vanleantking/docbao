<?php

use Phalcon\Config;

return new Config(
    [
        // 'database'    => [
        //     'adapter'  => 'Mysql',
        //     'host'     => 'localhost',
        //     'username' => 'root',
        //     'password' => 'mysql',
        //     'name'     => 'docbao',
        // ],
        // 'application' => [
        //     'controllersDir' => __DIR__ . '/../controllers/',
        //     'modelsDir'      => __DIR__ . '/../models/',
        //     'viewsDir'       => __DIR__ . '/../views/',
        // ],
        'dictionary' => [
            'bigrams' => __DIR__ . '/bi-grams.txt',
            'trigrams' => __DIR__ . '/tri-grams.txt',
            'stopwords' => './vnmstopwords.txt',
        ]
    ]
);
