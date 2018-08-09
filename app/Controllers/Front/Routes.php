<?php

return [
    'name' => 'Front',
    'path' => 'Front',
    'controllers' => [
        'Site' => [
            'routes' => [
                'site' => [
                    'method' => 'get',
                    'route' => '/',
                    'action' => 'index'
                ]
            ]
        ]
    ]
];


