<?php 
session_start();
$_SESSION = array();//unset all session variables
session_destroy();
header('Location: index.php'); 
?>
