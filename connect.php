<?php
$servername="localhost";
$serverpass="";
$serveruser="root"; 
$dbname="photoland";    
$conn = mysqli_connect($servername, $serveruser, $serverpass, $dbname);
if(!$conn){
    die("Błąd połączenia: ". mysqli_connect_error());
};      
?>