<?php

session_start();
// Unset individual session variables
unset($_SESSION['user']);

// Destroy the entire session
session_destroy();

// Redirect to the login page or any other desired page
header('Location: index.php');
exit();
?>