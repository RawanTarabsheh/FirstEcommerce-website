<?php
//connect to DataBase
$ServerName   ="localhost";
$UserNam      ="root";
$PassWord     ="";
$DatabaseName ="htu_firstdb";

$conn=mysqli_connect($ServerName,$UserNam,$PassWord,$DatabaseName);
if(!$conn){
	die("Error in Connection");
}

