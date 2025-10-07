<?php
return [
    'settings' => [
        'db' => [
            'dsn' => 'pgsql:host=toubiprati.db;dbname=toubiprat',
            'user' => 'toubiprat',
            'password' => 'toubiprat',
        ],
        'db_rdv' => [
            'dsn' => 'pgsql:host=toubirdv.db;dbname=toubirdv',
            'user' => 'toubirdv',
            'password' => 'toubirdv'
            ],
        'db_patient' => [
            'dsn' => 'pgsql:host=toubipat.db;dbname=toubipat',
            'user' => 'toubipat',
            'password' => 'toubipat'
        ],
        'displayErrorDetails' => true,
    ],
];