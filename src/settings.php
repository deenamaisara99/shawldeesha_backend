<?php
return [
    'settings' => [
        'displayErrorDetails' => true, //set to false in production
        'addContentLengthHeader' => false, //allow the web server to send 
        //the content-length header
        'upload_directory' => __DIR__ . '/../public/uploads', //upload directory

        //renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        //database connection settings
        "db" => [
            "host" => "localhost", 
            "dbname" => "shawldeesha_hijab",
            "user" => "root", 
            "pass" => "", 
        ]
    ],
];