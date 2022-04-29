<?php
include("conn.php");

 
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/p4_cart.css">
    <link rel="stylesheet" href="css/responsive4.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/cart_handle.js"></script>


</head>
<script language="javascript">
    function resizeImage(obj) {
        if (obj.height > 50) obj.height = 50;
        if (obj.width > 50) obj.width = 50;
    }

    function upd(x) {
        var id = x.id;
        var n = x.value;
        location.href = "upcart.php?id=" + id + "&n=" + n;
    }

    function qx(x) {
        var arr = document.getElementsByName("del");
        if (x.checked) {
            for (var i = 0; i < arr.length; i++) {
                arr[i].checked = true;
            }
        } else {
            for (var i = 0; i < arr.length; i++) {
                arr[i].checked = false;
            }
        }
    }

    function del() {
        var arr = document.getElementsByName("del");
        var str = "";
        for (var i = 0; i < arr.length; i++) {
            if (arr[i].checked) {
                str += arr[i].value + "-";
            }
        }
        location.href = "delcart.php?str=" + str;
    }
</script>

<body>
    <!-- topbar -->
    <div id="topbar">
        <div class="content clearfix">
            <div class="logo">
                <a href="index.php"><img src="image/logo.jpg" width="46" height="46" alt=""></a>
            </div>
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

    <!-- searchbar -->
    <div class="searchbar">
        <div class="w">
            <button class="gerocery">ALL</button>
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

    <!-- item cart -->
    <div class="bigbox clearfix">
        <div class="cart-container cart-page w">
      <?php   if(isset($_SESSION['mycar'])){ ?>
        <form action="order.php" method="post" onsubmit="return slyz()">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th id="checkAll">
                        <input name="all" type="checkbox" value="" class="checkall" checked onclick="qx(this)"/>  
                        </th>
                        <th id="items">Items</th>
                        <th id="qu">Quantity</th>
                        <th id="subtt">Subtotal</th>
                    </tr>



                    <?php
          
                    $total = 0;
                    $totalnum = 0;
                    foreach ($_SESSION['mycar'] as $v) {
                        $id = $v['id'];
                        $buynum = $v['buynum'];
                        $rs = mysqli_query($link, "select * from products where id='$id'");
                        $row = mysqli_fetch_array($rs);
                    ?>
                        <tr>
                            <td>
                                <input name="del" type="checkbox" checked value="<?php echo $id; ?>" />
                            </td>
                            <Td>
                                <div id="item">
                                    <img src="back-end/<?php echo $row['photo']; ?>" width="44" height="59" onload="resizeImage(this)" />
                                    <div id="dis">
                                        <p><?php echo  $row['name'] ?></p>
                                        <h4 class="price">$<?php echo $row['price'] - $row['price'] * $row['discount'] / 10; ?></h4>
                                        <br>

                                        <a class="remove" href="delcart.php?id=<?php echo $id; ?>">Remove</a>
                                    </div>
                                </div>

                            </Td>
                            <td>
                                <div id="quantity">
                                    <input class="min" name="" type="button" value="-">
                                    <input class="num" type="text" name="sl[]" id="<?php echo $id; ?>" value="<?php echo $buynum; ?>" onchange="upd(this)" />
                                    <input class="add" name="" type="button" value="+">
                                </div>
                            </td>


                            <td class="pri">$<?php echo ($row['price'] - $row['price'] * $row['discount'] / 10) * $buynum; ?></td>



                        </tr>
                    <?php
                          $total = $total + ($row['price'] - $row['price'] * $row['discount'] / 10) * $buynum;
                        $totalnum = $totalnum + $buynum;
                        $_SESSION['total'] = $total;
                    }  
                    ?>  




                </thead>
                <tbody></tbody>
            </table>
            <div class="total-price">
                <table>
                    <tr>
                        <td>Total Items</td>
                        <td class="totalitems"> <?php echo  $totalnum  ?></td>
                    </tr>

                    <tr>
                        <td>Total</td>
                        <td class="total"> <?php echo  $total  ?></td>
                    </tr>
                </table>
                <a href="clearall.php?qk=yes"> <button class="ea">Empty All</button></a>

                <a href="index.php"><button class="cs">Continue Shopping</button></a>
                <button class="checkout" " name="ok" value="" type="submit" >Check Out</button>
            </div>
            </form>
            <?php }else{

                echo "<p class='nogood'>No items in cart</p>";
            } ?>
            <style>
.nogood{
    text-align: center;
    line-height: 100px;
    color: #f90;
}
                
            </style>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="w">

            <div class="copyright">
                <img src="image/logo.jpg" width="46" height="46" alt="">
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