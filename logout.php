<?php
session_start();
unset($_SESSION['user']);
session_unset();
session_destroy();
echo "<script>alert('Logout Success');window.location.href='index.php'</script>";
?> 