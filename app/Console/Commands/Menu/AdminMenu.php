<?php

namespace App\Console\Commands\Menu;

trait AdminMenu {
    

    public function adminAccess() {
        return [
            'Menu Umum Admin : Menu Umum Admin' => [ // Nama Permission ( Nama : Deskripsi )
                [
                    'title' => 'User', // Nama Menu
                    'route_name' => 'admin.user.index', // Route Menu
                    'icon' => '' // Icon Menu
                ],
                [
                    'title' => 'Role',
                    'route_name' => 'admin.role.index',
                    'icon' => ''
                ],
                [
                    'title' => 'Kategori Pekerjaan',
                    'route_name' => 'admin.job_category.index',
                    'icon' => ''
                ],
                [
                    'title' => 'Station',
                    'route_name' => 'admin.station.index',
                    'icon' => ''
                ],
                [
                    'title' => 'Daily Activity',
                    'route_name' => 'admin.job_activity.index',
                    'icon' => ''
                ]
            ]
        ];
    }


    public function adminComposingMenu() {
        return [
            'Manajemen Role' => [
                'title' => 'Manajemen Role',
                'route_name' => '',
                'child' => [
                    [
                        'route_name' => 'admin.user.index'
                    ],
                    [
                        'route_name' => 'admin.role.index'
                    ]
                ]
            ],
            'Kategori Pekerjaan' => [
                'route_name' => 'admin.job_category.index'
            ],
            'Station' => [
                'route_name' => 'admin.station.index'
            ],
            'Daily Activity' => [
                'route_name' => 'admin.job_activity.index'
            ]
        ];
    }

}