<?php

return [
    'name' => 'Admin/',
    'path' => 'Admin/',
    'controllers' => [
        'Usuarios' => [
            'routes' => [
                'adm.index' => [
                    'method' => 'get',
                    'route' => '/admin/usuarios',
                    'action' => 'index'
                ],
                'adm.novo' => [
                    'method' => 'post',
                    'route' => '/admin/usuarios/novo',
                    'action' => 'novo'
                ],
                'adm.atualizar' => [
                    'method' => 'post',
                    'route' => '/admin/usuarios/atualizar/{id}',
                    'action' => 'atualizar'
                ],
                'adm.deletar' => [
                    'method' => 'get',
                    'route' => '/admin/usuarios/deletar/{id}',
                    'action' => 'deletar'
                ]
            ]
        ]
    ]
];


