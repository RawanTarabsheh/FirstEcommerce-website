<?php 
//connect to DataBase
$database_username      ="root";
$database_password      ="";
$conn = new PDO( 'mysql:host=localhost;dbname=htu_firstdb', $database_username, $database_password );


 if(!$conn){
 
  die("could not connect to the database");

  }
 