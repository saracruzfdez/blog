<?php
//  fichier de config de l'app

session_start();

const CONFIG = [
    'db' => [
        'HOST' => 'localhost',
        'PORT' => '3306',
        'NAME' => 'devtech',
        'USER' => 'root',
        'PWD' => ''
    ],

    'app' => [
        'name' => 'STARISLAND',
        'projecturl' => 'http://localhost/PHPexosSara/star_island/crud/'
    ]

];
