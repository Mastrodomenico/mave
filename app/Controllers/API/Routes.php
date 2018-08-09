<?php

return [
    'name' => 'API',
    'path' => 'API',
    'controllers' => [
        'User' => [
            'routes' => [
                'createUser' => [
                    'method' => 'post',
                    'route' => '/api/createuser',
                    'action' => 'createUser'
                ],
                'updateUser' => [
                    'method' => 'post',
                    'route' => '/api/updateuser',
                    'action' => 'updateUser'
                ]
            ]
        ]
    ]
];


