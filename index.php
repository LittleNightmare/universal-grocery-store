<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store</title>
    <link rel="stylesheet" href="css/p1_index.css">
    <link rel="stylesheet" href="css/responsive1.css">

</head>

<body>
    <!-- topbar -->
    <div id="topbar">
        <div class="content">
            <ul>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li><a href="logout.php">Logout</a><span>|</span></li>
                    <?php if ($_SESSION['admin']==1) {?>
                        <li><a href="back-end/index.php">Admin</a><span>|</span></li>
                    <?php } ?>
                <?php } else { ?>
                    <li><a href="signin.php">Sign in</a><span>|</span></li>
                    <li><a href="signup.php">Sign up</a><span>|</span></li>
                <?php } ?>
                <li><a id="name"><?php echo isset($_SESSION['user']) ? $_SESSION['user'] : "Account"?></a><span>|</span></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>
    </div>

    <!-- logo -->
    <div id="logo" class="content">
        <div class="storelogo">
            <img src="image/logo.jpg" width="56" height="56" alt="">
        </div>
        <p>TEL:514-6223777</p>
        <div class="nav-searchbar">
            <input type="text" class="nav-input">
            <input type="button" class="nav-search" value="Search">
        </div>
        <div class="clear"></div>
    </div>

    <!-- nav -->
    <div id="nav" class="content">
        <div class="navbar">
            <a class="navbar_home" href="index.php">Home</a>
            <div class="dropdown">
                <button class="dropbtn">Aisles</button>
                <div class="dropdown-content">
                    <a href="milkeggs.php">Milk & Eggs</a>
                    <a href="fruits.php">Fruits</a>
                    <a href="vegetables.php">Vegetables</a>
                    <a href="meat.php">Meat</a>
                    <a href="fish.php">Fish</a>
                </div>
            </div>
        </div>
    </div>

    <!-- banner -->
    <div id="banner" class="content">
        <div class="left">
            <ul class="menu">
                <a href="milkeggs.php">
                    <li>Milk & Eggs</li>
                </a>
                <a href="fruits.php">
                    <li>Fruits</li>
                </a>
                <a href="vegetables.php">
                    <li>Vegetables</li>
                </a>
                <a href="meat.php">
                    <li>Meat</li>
                </a>
                <a href="fish.php">
                    <li>Fish</li>
                </a>
            </ul>
        </div>
        <div class="right"></div>
    </div>
    <div id="ip" class="content">
        <h1>In Promotion</h1>
    </div>

    <!-- goods_list -->
    <div id="goods_list" class="content">
        <!-- item 1 -->

        <?php
         
              $rs2 = mysqli_query($link, "select * from products where discount > 0 and discount < 10 order by id desc limit 0,5");
         
              while ($row = mysqli_fetch_array($rs2)) {
              ?>


        <div class="item item-responsive1">
            <em>
                <img class="img-responsive_1" src="image/save.png" alt="">
            </em>
            <a href="detail.php?id=<?php echo $row['id']; ?>"><img src="back-end/<?php echo $row['photo']; ?>" width="100%" height="100%" alt="apples"></a>
            <div class="description">
                <a href="detail.php?id=<?php echo $row['id']; ?>"><p class="p1"><?php echo $row['name']; ?></p></a>
                <p class="p2"></p>
                <p class="p3">$<?php echo $row['price'];?></p>
                <p class="p4">$<?php echo $row['price']-$row['price']*$row['discount']/10; ?></p>
            </div>
            <a href="detail.php?id=<?php echo $row['id']; ?>"><img class="img-responsive_2" src="image/cart.png" alt="" width="20%" height="20%"></a>
        </div>
                <?php } ?>
        
        <div class="clear"></div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="content">

            <div class="copyright">
                <img src="image/logo.jpg" width="56" height="56" alt="">
                <a href="#" class="app">Download APP</a>
                <p id="cr">&copy; 2022 - 2026 Super Grocery All Rights Reserved</p>  
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