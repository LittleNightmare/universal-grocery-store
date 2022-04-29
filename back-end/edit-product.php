<?php
include("../conn.php");

if (isset($_SESSION['user'])){
  $username = $_SESSION['user'];
  $sql = "select * from admin where name='$username'";
  $result = mysqli_query($link, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 0) {
    echo "<script>alert('No permission'); window.location.href='index.php'</script>";
  } 
} else{
  echo "<script>alert('Please log in first'); window.location.href='signin.php'</script>";
}

if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $goodname = $_POST['name'];
  $goodtype = $_POST['type'];
  $discount = $_POST['discount'];
  $price = $_POST['price'];
  $amount = $_POST['amount'];
  $detail = $_POST['detail'];
  $time = date("YmdHis");

  if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
    $date = date('ymdhis');
    if ((($_FILES["upfile"]["type"] == "image/gif")
      || ($_FILES["upfile"]["type"] == "image/jpeg") || ($_FILES["upfile"]["type"] == "image/png")
      || ($_FILES["upfile"]["type"] == "image/pjpeg"))) {
      if ($_FILES["upfile"]["error"] > 0) {
        echo "Return Code: " . $_FILES["upfile"]["error"] . "<br />";
      } else {
        $uptype = explode(".", $_FILES["upfile"]["name"]);
        $newname = $date . "." . $uptype[1];
        $_FILES["upfile"]["name"] = $newname;
        if (file_exists("./upimages/" . $_FILES["upfile"]["name"])) {
          echo $_FILES["upfile"]["name"] . " already exists. ";
        } else {
          $_FILES["upfile"]["name"] =
            move_uploaded_file(
              $_FILES["upfile"]["tmp_name"],
              "./upimages/" . $_FILES["upfile"]["name"]
            );
          $photo = "upimages/".$newname;
        }
      }
    }
  }


  if (isset($photo)) {
    $rs = mysqli_query($link, "update products set name='$goodname',type='$goodtype',discount='$discount',price='$price',amount='$amount',detail='$detail',photo='$photo'  where id='$id'");
  } else {
    $rs = mysqli_query($link, "update products set name='$goodname',type='$goodtype',discount='$discount',price='$price',amount='$amount',detail='$detail'  where id='$id'");
  }

  if (mysqli_affected_rows($link) > 0) {
    echo '<script type="text/javascript">alert("Modify the success!")</script>';
    echo '<script type="text/javascript">location.href="index.php";</script>';
  } else {
    echo '<script type="text/javascript">alert("Modify the failure");history.back();</script>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Universal Grocery Store Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href=".\css\back-style.css">
</head>

<body>
  <nav class="navbar sticky-top navbar-expand-xl bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Universal Grocery</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse order-1" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Product Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="back-user.php">User Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="back-order.php">Order Management</a>
        </li>
      </ul>
    </div>

    <div class="navbar-collapse collapse order-2">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Edit Product</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Product Management</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit</a></li>
      </ol>
    </nav>
    <br>
    <?php
    $id = $_GET['id'];
    $rs = mysqli_query($link, "select * from products where id='$id'");
    $row = mysqli_fetch_array($rs);
    ?>

    <form action="edit-product.php?id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" name="jcform" onsubmit="return Jiance()">
      <div class="form-row">
        <div class="form-inline col-md-2">
          <img src="<?php echo $row['photo']; ?>" class="figure-img img-fluid img-thumbnail mx-auto d-block" alt="A generic square placeholder image with rounded corners in a figure.">
        </div>
        <div class="form-inline col-md-3">
          <input type="file" class="file" id="product-image" name="upfile" placeholder="Please Upload Image">
        </div>
        <div class="form-inline col-md-3">
          <label for="product-name" class="mr-sm-2">Name:</label>
          <input type="text" class="form-control mb-2 mr-sm-2" id="product-name" value="<?php echo $row['name']; ?>" name="name" placeholder="Edit Product Name">
        </div>
        <div class="form-inline col-md-4">
          <label for="product-price" class="mr-sm-2">Price:</label>
          <input type="text" class="form-control mb-2 mr-sm-2" id="product-price" value="<?php echo $row['price']; ?>" name="price" placeholder="Enter Product Price">
        </div>
      </div>
      <br>
      <div class="form-row">
        <div class="form-inline col-md-5">
          <label for="product-discount" class="mr-sm-2">Discount:</label>
          <input type="text" class="form-control" id="product-discount" name="discount" value="<?php echo $row['discount']; ?>" required placeholder="Edit discount">
          <div class="input-group-append">
            <span class="input-group-text">0% off</span>
          </div>
        </div>
        <div class="form-inline col-md-3">
          <label for="product-action" class="mr-sm-2">Type</label>
          <select id="product-action" class="form-control" name="type">
            <option selected>Choose...</option>
            <option <?php if ($row['type'] == "MilkEggs") {
                      echo  "selected";
                    } ?> value="MilkEggs">Milk & Eggs</option>
            <option <?php if ($row['type'] == "Fruits") {
                      echo  "selected";
                    } ?> value="Fruits">Fruits </option>
            <option <?php if ($row['type'] == "Vegetables") {
                      echo  "selected";
                    } ?> value="Vegetables">Vegetables </option>
            <option <?php if ($row['type'] == "Meat") {
                      echo  "selected";
                    } ?> value="Meat">Meat </option>
            <option <?php if ($row['type'] == "Fish") {
                      echo  "selected";
                    } ?> value="Fish">Fish </option>
          </select>

        </div>
        <div class="form-inline col-md-4">
          <label for="product-amount" class="mr-sm-2">Amount:</label>
          <input type="text" class="form-control mb-2 mr-sm-2" id="product-amount" value="<?php echo $row['amount']; ?>" name="amount" required placeholder="Edit Product">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="name" class="mr-sm-2">Detail</label>
          <textarea class="form-control " rows="10" cols="100" required name="detail"><?php echo $row['detail']; ?></textarea>
        </div>


      </div>
      <br>
      <div class="form-group" style="text-align:center">
        <div>
          <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>

      </div>

    </form>
  </div>

</body>

</html>


<script language="javascript">
  function Jiance() {
    if (document.jcform.name.value == "") {
      window.alert('enter produce name');
      return false;
    }

    if (document.jcform.price.value == "") {
      alert('Enter produce price!');

      return false;
    }

    if (document.jcform.discount.value == "") {
      alert('Enter produce discount!');

      return false;
    }




    return true;
  }
</script>