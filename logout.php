<?php 
session_start();
unset($_SESSION['login']);
if (isset($_COOKIE['login_attemps'])) {
    unset($_COOKIE['login_attemps']); 
    setcookie('login_attemps', null, -1, '/'); 
} 

header('Location:index.php'); die();
?>