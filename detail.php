<?php
include("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>

    <link rel="stylesheet" href="p3_css/base_general.css">
    <link rel="stylesheet" href="p3_css/fruit_general.css">
    <link rel="stylesheet" href="css/responsive3.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/show_more.js"></script>
    <script src="js/add_product.js"></script>
</head>

<body>
    <!-- topbar -->
    <div id="topbar">
        <div class="content clearfix">
            <div class="logo">
                <a href="index.php"><img src="image/logo.jpg" width="46" height="46" alt=""></a>
            </div>
            <ul>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li><a herf="logout.php">Logout</a><span>|</span></li>
                <?php } else { ?>
                    <li><a href="signin.php">Sign in</a><span>|</span></li>
                    <li><a href="signup.php">Sign up</a><span>|</span></li>
                <?php } ?>
                <li><a id="name"><?php echo isset($_SESSION['user']) ? $_SESSION['user'] : "Account"?></a><span>|</span></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>
    </div>

    <!-- searchbar -->
    <div class="searchbar">
        <div class="w">
            <button class="gerocery">Gerocery</button>
            <div class="dropdown_content">
                <a href="milkeggs.php">Milk & Eggs</a>
                <a href="fruits.php">Fruits</a>
                <a href="vegetables.php">Vegetables</a>
                <a href="meat.php">Meat</a>
                <a href="fish.php">Fish</a>
            </div>
            <input type="text" value="">
            <button class="search">Search</button>
        </div>
    </div>

    <!-- header -->
    <div class="header">
        <div class="w"></div>
    </div>
    <?php
                $id = $_GET['id'];
                $rs = mysqli_query($link, "select * from products where id='$id'");
                $row = mysqli_fetch_array($rs);
                ?>
    <!-- items -->
    <div class="box">
        <div class="w">
            <div class="picture">
                <em>
                    <img src="image/save.png" alt="">
                </em>
                <img src="back-end/<?php echo $row['photo']; ?>" width="500px" height="500px" alt="">
            </div>
            <div class="dis">
            <form action="addcart.php" method="post" >
              
                <h1 class="name"><?php echo $row['name']; ?></h1>
                <p class="number">Item #: <?php echo $row['id']; ?></p>
                <h2 class="price">$<?php echo $row['price']; ?></h2>
                <h3 class="sp">$<?php echo $row['price']-$row['price']*$row['discount']/10; ?></h3>
                <p class="qua">Quantity</p>
                <div class="na">
                    <input class="min" name="" type="button" value="-">
                    <input class="num" name="num" type="text" value="1">
                    <input class="add" name="" type="button" value="+">
                    <!-- <input type="number" id="quan" /> -->
                    <input type="hidden" value="<?php echo $row['id'];?>" name="gid" />
                </div>
                <br>
                <p class="p">Price</p>
                <input class="sub_total" name="total" type="text" value="$<?php echo $row['price']-$row['price']*$row['discount']/10; ?>">
                <button id="add" type="submit" name="submit"> Add to Cart</button>
                <h2 class="pd">Product Details</h2>
                <button id="showmore"> show more</button>
                <p id="smd">
                <?php echo $row['detail']; ?> 
                </p>
            </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="w">

            <div class="copyright">
                <img src="image/logo.jpg" width="46" height="46" alt="">
                <a href="#" class="app">Download APP</a>
                <p>&copy; 2022 - 2026 Super Grocery<br>&nbsp;&nbsp;&nbspAll Rights Reserved</p>
            </div>

            <div class="links">
                <dl>
                    <dt>Auout Us</dt>
                    <dd><a href="#">At your service</a></dd>
                    <dd><a href="#">Environment</a></dd>
                    <dd><a href="#">In the community</a></dd>
                    <dd><a href="#">Info Covid</a></dd>
                </dl>
                <dl>
                    <dt>Promotions</dt>
                    <dd><a href="#">Flyer</a></dd>
                    <dd><a href="#">Gift cards</a></dd>
                    <dd><a href="#">Discount</a></dd>
                    <dd><a href="#">Rewards</a></dd>
                </dl>
                <dl>
                    <dt>Customer Service</dt>
                    <dd><a href="#">Contact us</a></dd>
                    <dd><a href="#">Terms and conditions</a></dd>
                    <dd><a href="#">Privacy</a></dd>
                    <dd><a href="#">FAQ</a></dd>
                </dl>
            </div>
        </div>
    </div>

</body>

</html>