<?php
session_start();
setcookie("user", $username, time() - 3600, '/');
unset($_SESSION['user']);
session_unset();
session_destroy();
echo "<script>alert('Logout Success');window.location.href='index.php'</script>";
?> 