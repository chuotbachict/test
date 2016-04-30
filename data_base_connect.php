<?php
$servername = '192.168.56.101';
$username = 'root';
$passwd = '123456';
$dbname = 'gps';
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$passwd);
$sql = "select * from GpsUser where id = 1";
echo "<pre>";
$data = $conn->query($sql);
var_dump($data);
