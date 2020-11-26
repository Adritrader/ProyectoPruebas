<?php

return ["database" => ["connection" => "mysql:host=localhost;dbname=mydb;charset=utf8",
    "username"=>"dbuser",
    "password"=> "1234",
    "options"=>[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT=>true]
]
    ,
    "logfile"=>"app.log"
];
