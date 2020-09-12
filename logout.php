<?php session_start();

// delete certain session
unset($_SESSION['id']);
// Jump to login page
header('Location: index.php');
