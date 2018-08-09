<?php 

return [
    'development' => [
        'database' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'clienteagentegru',
            'username' => 'clienteagentegru',
            'password' => 'q1w2e3r4',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'baseUrl' => 'http://localhost:4000/',
        'controller' => [
            'basePathControllers' => "\app\Controllers\\"
        ],
        'DirectoryFiles' => __DIR__."/../../www/uploads/",
        'hash' => 'parangaricotirimirruaro'
    ]
];