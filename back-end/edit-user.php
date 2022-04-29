<?php
    include("../conn.php");
    if (isset($_SESSION['user'])){
      // $username = $_SESSION['user'];
      // $sql = "select * from admin where name='$username'";
      // $result = mysqli_query($link, $sql);
      // $num = mysqli_num_rows($result);
      if ($_SESSION["admin"] != 1) {
        echo "<script>alert('No permission'); window.location.href='../index.php'</script>";
      } 
    } else{
      echo "<script>alert('Please log in first'); window.location.href='../signin.php'</script>";
    }
if (isset($_POST['submit'])) {
  $id = $_GET['id'];
  $username = $_POST['username'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $Gender = $_POST['Gender'];
  $Phone = $_POST['Phone'];
  $Address1 = $_POST['Address1'];
  $Address2 = $_POST['Address2'];
  $Country = $_POST['Country'];
  $State = $_POST['State'];
  $City = $_POST['City'];
  $zip = $_POST['zip'];
 
  $rs = mysqli_query($link, "update users set username='$username',FirstName='$FirstName',LastName='$LastName',Gender='$Gender',Address1='$Address1',Address2='$Address2',Phone='$Phone',Country='$Country',State='$State',City='$City',zip='$zip' where id='$id'"); 
 
  if (mysqli_affected_rows($link) > 0) {
    echo '<script type="text/javascript">alert("Modify the success!")</script>';
    echo '<script type="text/javascript">location.href="back-user.php";</script>';
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
          <a class="nav-link active" href="#">Edit User</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">User Management</a></li>
        <li class="breadcrumb-item active"><a href="#">Edit</a></li>
      </ol>
    </nav>
    <br>
    <?php
    $id = $_GET['id'];
    $rs = mysqli_query($link, "select * from users where id='$id'");
    $row = mysqli_fetch_array($rs);
    ?>



    <form action="edit-user.php?id=<?php echo $row['id']; ?>" method="post" name="jcform" onsubmit="return Jiance()">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="user-first-name">First Name</label>
          <input type="text" class="form-control" id="user-first-name" name="FirstName" value="<?php echo $row['FirstName']; ?>" required placeholder="First Name">
        </div>
        <div class="form-group col-md-4">
          <label for="user-last-name">Last Name</label>
          <input type="text" class="form-control" id="user-last-name" name="LastName" value="<?php echo $row['FirstName']; ?>" required placeholder="Last Name">
        </div>
        <div class="form-group col-md-4">
          <label for="user-gender">Gender</label>
          <select id="user-gender" class="form-control" name="Gender">
            <option <?php if ($row['Gender'] == "Male") {
                      echo  "selected";
                    } ?> value="Male">Male</option>
            <option <?php if ($row['Gender'] == "Female") {
                      echo  "selected";
                    } ?> value="Female">Female</option>
            <option <?php if ($row['Gender'] == "Other") {
                      echo  "selected";
                    } ?> value="Other">Other</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="user-email">Email</label>
          <input type="email" class="form-control" id="user-email" name="username" value="<?php echo $row['username']; ?>" required placeholder="Email">
        </div>
        <div class="form-group col-md-4">
          <label for="user-phone">Phone</label>
          <input type="text" class="form-control" id="user-phone" name="Phone" value="<?php echo $row['Phone']; ?>" required placeholder="Phone Number">
        </div>
        <div class="form-group col-md-4">
          <label for="user-password">Password</label>
          <input type="password" class="form-control" id="user-password" name="password" value="<?php echo $row['password']; ?>" required placeholder="Password">
        </div>
      </div>
      <div class="form-group">
        <label for="user-address-1">Address</label>
        <input type="text" class="form-control" id="user-address-1" name="Address1" value="<?php echo $row['Address1']; ?>" required placeholder="1234 Main St">
      </div>
      <div class="form-group">
        <label for="user-address-2">Address 2</label>
        <input type="text" class="form-control" id="user-address-2" name="Address2" value="<?php echo $row['Address2']; ?>" required placeholder="Apartment, studio, or floor">
      </div>
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="user-country">Country</label>
          <input type="text" class="form-control" name="Country" required value="<?php echo $row['Country']; ?>" id="user-city">
        </div>
        <div class="form-group col-md-3">
          <label for="user-state">State</label>
          <input type="text" class="form-control" name="State" required value="<?php echo $row['State']; ?>" id="user-city">
        </div>
        <div class="form-group col-md-3">
          <label for="user-city">City</label>
          <input type="text" class="form-control" name="City" required value="<?php echo $row['City']; ?>" id="user-city">
        </div>
        <div class="form-group col-md-3">
          <label for="user-zip">Zip</label>
          <input type="text" class="form-control" name="zip" required value="<?php echo $row['zip']; ?>" id="user-zip">
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Save</button>
    </form>
  </div>

</body>

</html>