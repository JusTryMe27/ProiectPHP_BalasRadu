<?php
/**
 * Created by PhpStorm.
 * User: Radu
 * Date: 03-Feb-19
 * Time: 14:12
 */

$options=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>FALSE
];
$user='root';
$pass='';
$dsn="mysql:host=localhost;dbname=servicemoto;charset=utf8mb4";
$options=[];
$conn = new mysqli($servername, $username, $password, $dbName);
if ($conn->connect_error)
{
    die("Nu ma pot conecta: ".$conn->connect_error);
}

try {
    $db = new PDO($dsn, $user, $pass, $options);
} catch(PDOException $e){
    throw new PDOException($e->getMessage(),$e->getCode());
}