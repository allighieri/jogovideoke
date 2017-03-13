<?php 

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'jogovideoke';
 
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(PDOException $e){
    echo 'ERROR: ' . $e->getMessage();
}	


?>