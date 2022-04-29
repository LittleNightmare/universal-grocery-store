<?php session_start();
ini_set('error_reporting', 'E_ALL ^ E_NOTICE');
header("Content-type: text/html; charset=utf-8");
include("conn.php");
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $receive =isset($_POST['receive'])?$_POST['receive']:'0';
    $password = sha1($_POST['psw']);
    $sql = "INSERT INTO users (`username`,`password`,`receive`,`time`)  VALUES('$username','$password','$receive',now())"; 
 
  $result = mysqli_query($link, $sql);
    if ($result == true) 
    {
        echo "<script>alert('Registered successfully');window.location.href='signin.php'</script>";
    } else {
        echo "<script>alert('Registration failed');window.location.href='signup.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/p6_signup.css">
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
    <form action="signup.php" method="post"   name="jcform" onsubmit="return Jiance()" >
    <!-- box -->
    <div class="box">
        <div class="w">
            <h1>Create Account</h1>

            <div class="info">
           
                <input type="email"  id="user" name="user" placeholder="Email Address">
                <input type="password" id="psw"  name="psw" placeholder="Enter Password">
                <h2>Comfirm Password</h2>
                <input type="password" id="cp" name="cpsw"  placeholder=" Enter Password Again">
                <button id="reset" type="reset">Reset Form</button>
                <input type="checkbox" id="cb" name="receive" value="1">
                <h3>Yes, I want to receive commercial electronic messages</h3>
                <br>
                <br>
                <button id="signup" type="submit" name="submit">Create Account</button>
                <div class="end">
                    <h3>Already have an account?</h3>
                </div>
                <a href="signin.php" class="si"><input type="button" class="ca" onclick="window.location.href('signup.php')" value='Sign In'></a>
           
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



<script language="javascript">
function Jiance() {
    if (document.jcform.user.value=="") 
    {
        window.alert('enter Email Address!'); 
        return false;
    }
 
    if (document.jcform.psw.value=="") 
    {
        alert('Enter Password!'); 
        
        return false;
    }
     
    if (document.jcform.cpsw.value=="") 
    {
        alert('Enter Password Again!'); 
        
        return false;
    }
    if (document.jcform.cpsw.value!=document.jcform.psw.value) 
    {
        alert('Entered passwords differ'); 
        
        return false;
    }
     

	 
    return true;
} 
</script>
