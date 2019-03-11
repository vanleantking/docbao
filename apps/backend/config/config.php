<?php

use Phalcon\Config;

return new Config(
    [
        'dictionary' => [
            'bigrams' => __DIR__ . '/bi-grams.txt',
            'trigrams' => __DIR__ . '/tri-grams.txt',
            'stopwords' => './vnmstopwords.txt',
        ],
        'web_config' => [
            'config' => __DIR__ . '/config.json'
        ]
    ]
);
