<?php 

$server='localhost';
$username = 'root';
$serverKey='';
$database='todowebsite';

$conn=mysqli_connect($server,$username,$serverKey,$database);

if(!$conn) die('Connection failed: ' . mysqli_connect_error());


?>