<?php
include("conn.php");
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = sha1($_POST['psw']);
    $sql = "select * from users where username='$username' and password='$password'"; //sql选择语句
    $result = mysqli_query($link, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0)  
    {
        $_SESSION['user'] = $username;
        if(isset($_POST['cb'])){
            setcookie("user", $username, time() + (86400 * 30), '/');
        }
        // admin part
        $sql = "select * from admin where name='$username' and password='$password'";
        $result = mysqli_query($link, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0){
            $_SESSION['admin'] = 1;
        }
        echo "<script>alert('Log in successfully');window.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Logon failure');window.location.href='signin.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/p5_signin.css">
    <link rel="stylesheet" href="css/responsive5.css">
</head>

<body>
    <div id="topbar">
        <div class="w clearfix">
            <div class="logo">
                <a href="index.php"><img src="image/logo.jpg" width="60px" height="60px" alt=""></a>
            </div>
            <h1>Welcome to Universal Grocery Store</h1>
        </div>
    </div>
    <form action="signin.php" method="post"   >
    <!-- box -->
    <div class="box">
        <div class="w">
            <h1>Sign In</h1>
            <div class="info">
                <h2>Email Address</h2>
                <input type="text" id="user" name="user" placeholder="Email Address">
                <input type="password" id="psw" name="psw" placeholder="Password">
                <a href="#" class="fp">Forgot Password?</a>
                <input type="checkbox" id="cb" name="cb">
                <h3>Remember Me</h3>
                 
                <button  class="signin" type="submit" name="submit">Sign In</button>
                <div class="end">
                    <h3>New Customer?</h3>
                </div>
                <a href="signup.php" class="bt"><input type="button" class="ca" onclick="window.location.href('signup.php')" value='Create Account'></a>


            </div>

        </div>

    </div>
    </form>
    <!-- footer -->
    <div class="footer">
        <div class="w">

            <div class="copyright">
                <img src="image/logo.jpg" width="56" height="56" alt="">
                <a href="#" class="app">Download APP</a>
                <p>&copy; 2022 - 2026 Super Grocery All Rights Reserved</p>
            </div>

            <div class="links">
                <dl>
                    <dt>Auout Us</dt>
                    <dd><a href="#">At your service</a></dd>
                    <dd><a href="#">Environment</a></dd>
                    <dd><a href="#">In the community</a></dd>
                </dl>
                <dl>
                    <dt>Promotions</dt>
                    <dd><a href="#">Flyer</a></dd>
                    <dd><a href="#">Gift cards</a></dd>
                    <dd><a href="#">Discount</a></dd>
                </dl>
                <dl>
                    <dt>Customer Service</dt>
                    <dd><a href="#">Contact us</a></dd>
                    <dd><a href="#">Terms and conditions</a></dd>
                    <dd><a href="#">Privacy</a></dd>
                </dl>
            </div>
        </div>
    </div>
</body>

</html>