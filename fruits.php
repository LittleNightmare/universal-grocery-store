 <?php
    include("conn.php");
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Fruits</title>
     <link rel="stylesheet" href="css/p2_products.css">
     <link rel="stylesheet" href="css/p2_fruits.css">
     <link rel="stylesheet" href="css/responsive2.css">
 </head>

 <body>
     <!-- topbar -->
     <div id="topbar">
         <div class="content clearfix">
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

     <!-- header -->
     <div class="header w">
         <!-- logo -->
         <div class="logo">
             <img src="image/logo.jpg" width="56" height="56" alt="">
         </div>
         <!-- navigation bar -->
         <div class="nav">
             <ul>
                 <li><a href="index.php">Home</a></li>
                 <li class="dropdown">
                     <button class="dropbtn">Aisles</button>
                     <div class="dropdown-content">
                         <a href="milkeggs.php">Milk & Eggs</a>
                         <a href="fruits.php">Fruits</a>
                         <a href="vegetables.php">Vegetables</a>
                         <a href="meat.php">Meat</a>
                         <a href="fish.php">Fish</a>
                     </div>
                 </li>
             </ul>
         </div>
         <!-- search -->
         <div class="search">
             <input type="text" value="Key Words">
             <button>Search</button>
         </div>
         <!-- mobile app -->
         <div class="mobile_app">
             <div class="i">
                 <img src="image/phone.JPG" width="36" height="36" alt="">
             </div>
             <a href="#">Download APP</a>
         </div>
     </div>

     <!-- banner -->
     <div class="banner">
         <!-- 版心盒子 -->
         <div class="w">
             <div class="subnav">
                 <ul>
                     <li><a href="milkeggs.php">Milk & Eggs <span> &gt; </span></a></li>
                     <li><a href="fruits.php">Fruits <span> &gt; </span></a></li>
                     <li><a href="vegetables.php">Vegetables <span> &gt; </span></a></li>
                     <li><a href="meat.php">Meat <span> &gt; </span></a></li>
                     <li><a href="fish.php">Fish <span> &gt; </span></a></li>
                 </ul>
             </div>
             <!-- 版心title -->
             <div class="ttl">
                 <h2>Everyday Fresh Fruits</h2>
                 <div class="pic"></div>
             </div>
             <!-- special -->
             <div class="special">
                 <h2>Weekly Special</h2>
                 <div class="bd">
                     <ul>
                         <li><a href="#">Apples: 1.19$/lb</a></li>
                         <li><a href="#">Bananas: 0.89$/lb</a></li>
                         <li><a href="#">Peaches: 2.99$/lb</a></li>
                         <li><a href="#">Oranges: 1.29$/lb</a></li>
                         <li><a href="#">Limes: 2.99$/5</a></li>
                         <!-- <li><a href="#">Grapes: 2.99$/lb</a></li> -->
                     </ul>
                 </div>
             </div>
         </div>
     </div>

     <!-- items -->
     <div class="box w">
         <div class="box-hd">
             <h3>Fruits</h3>
             <a href="#">View All</a>
         </div>
         <div class="box-bd">
             <ul class="clearfix">


                 <?php
                    $rs2 = mysqli_query($link, "select * from products where type='Fruits' order by id desc limit 0,5");
                    while ($row = mysqli_fetch_array($rs2)) {
                    ?>
                     <li>
                         <em>
                             <img src="image/save.png" alt="">
                         </em>
                         <a href="detail.php?id=<?php echo $row['id']; ?>"><img src="back-end/<?php echo $row['photo']; ?>" alt="apples"></a>
                         <div class="description">
                             <a href="detail.php?id=<?php echo $row['id']; ?>">
                                 <h3><?php echo $row['name']; ?></h3>
                             </a>
                             <h2>$<?php echo $row['price']; ?></h2>
                             <h1>$<?php echo $row['price'] - $row['price'] * $row['discount'] / 10; ?></h2>
                         </div>
                         <a href="detail.php?id=<?php echo $row['id']; ?>"><img class="cart" src="image/cart.png" alt=""></a>
                     </li>
                 <?php } ?>

                 <!-- <li>
                    <em>
                        <img src="image/save.png" alt="">
                    </em>
                    <a href="p3_html/strawberry.php"><img src="image/strawberry.JPG" alt=""></a>
                    <h3>Strawberriess</h3>
                   
                    <h1>3.99$/box</h2>
                        <a href="p3_html/strawberry.php"><img class="cart" src="image/cart.png" alt=""></a>
                </li>
                <li>
                    <em>
                        <img src="image/save.png" alt="">
                    </em>
                    <a href="p3_html/mango.php"><img src="image/mango.JPG" alt=""></a>
                    <h3>Mangos</h3>
                    <h2>1.99$/each</h2>
                    <h1>0.99$/each</h2>
                        <a href="p3_html/mango.php"><img class="cart" src="image/cart.png" alt=""></a>
                </li>
                <li>
                    <a href="p3_html/grape.php"><img src="image/grape.JPG" alt=""></a>
                    <h3>Grapes</h3>
                    <h3>2lb/box</h3>
                    <h1>5.99$/each</h2>
                        <a href="p3_html/grape.php"><img class="cart" src="image/cart.png" alt=""></a>
                </li>
                <li>
                    <a href="p3_html/blueberry.php"><img src="image/blueberry.JPG" alt=""></a>
                    <h3>Blueberries</h3>
                    <h3>1lb/box</h3>
                    <h1>2.99$/each</h2>
                        <a href="p3_html/blueberry.php"><img class="cart" src="image/cart.png" alt=""></a>
                </li>
                <li>
                    <a href="p3_html/avocado.php"><img src="image/avocado.JPG" alt=""></a>
                    <h3>Avocados</h3>
                    <h3>From Mexico</h3>
                    <h1>4.99$/5</h2>
                        <a href="p3_html/avocado.php"><img class="cart" src="image/cart.png" alt=""></a>
                </li> -->
             </ul>
         </div>
     </div>

     <!-- footer -->
     <div class="footer">
         <div class="w">

             <div class="copyright">
                 <img src="image/logo.jpg" width="56" height="56" alt="">
                 <p>&copy; 2022 - 2026 Super Grocery All Rights Reserved</p>
                 <a href="#" class="app">Download APP</a>
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