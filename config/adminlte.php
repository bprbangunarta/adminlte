<?php

return [

    /*
    | Skin AdminLTE: blue, black, purple, green, red, yellow (tambahkan "-light" untuk varian terang).
    */
    'skin' => env('ADMINLTE_SKIN', 'blue'),

    'logo_mini' => '<b>A</b>LT',

    'logo_lg' => '<b>Admin</b>LTE',

    /*
    | Menu sidebar. Setiap item: text, icon (Font Awesome 4), route, dan opsional
    | "children" (sub menu) atau "header" (judul grup). "active" berisi pola nama route.
    */
    'menu' => [
        ['header' => 'MENU UTAMA'],
        [
            'text' => 'Dashboard',
            'icon' => 'fa-dashboard',
            'route' => 'dashboard',
            'active' => ['dashboard'],
        ],
        [
            'text' => 'Halaman',
            'icon' => 'fa-files-o',
            'active' => ['pages.*'],
            'children' => [
                ['text' => 'Halaman Kosong', 'icon' => 'fa-circle-o', 'route' => 'pages.blank', 'active' => ['pages.blank']],
            ],
        ],
    ],
];
