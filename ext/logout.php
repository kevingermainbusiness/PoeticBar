<?php
session_start();
session_destroy();
header('Location:\ext/login.php');
?>