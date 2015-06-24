<?php

require_once("../config/db.php");

$db_connection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

$query = file_get_contents("db.sql");

$stmt = $db_connection->prepare($query);

if ($stmt->execute())
{
    echo "Success";
}
else 
{
    echo "Fail";
}    