<?php
include("../conn.php");

if (isset($_SESSION['user'])){
  $username = $_SESSION['user'];
  $sql = "select * from admin where name='$username'";
  $result = mysqli_query($link, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 0) {
    echo "<script>alert('No permission'); window.location.href='../index.php'</script>";
  } 
} else{
  echo "<script>alert('Please log in first'); window.location.href='../signin.php'</script>";
}

if (isset($_POST['submit'])) {
 
  $id = $_GET['id'];
  $choose = $_POST['choose'];
  $nummer = $_POST['nummer'];
 
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
                    <a class="nav-link active" href="#">Edit Order</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Order Management</a></li>
          <li class="breadcrumb-item active"><a href="#">Edit</a></li>
        </ol>
      </nav>
      <br>
      <div id="right" >
 

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

<form action="uporder.php" method="post">
<?php
$id=$_GET['id'];
$rs=mysqli_query($link,"select * from orderlist where id='$id'");
$row=mysqli_fetch_array($rs);
?>
<br>
  <tr>
    <td width="100" height="20">The order no. :<?php echo $id;?></td>
  <td width="400" height="20">

  <input name="flag" type="radio" value="0"  <?php if($row['flag']=="0"){echo "checked";}?>/>Not to deliver goods&nbsp;&nbsp;
  <input name="flag" type="radio" value="1"  <?php if($row['flag']=="1"){echo "checked";}?>/>Has been shipped&nbsp;&nbsp;
  <input name="flag" type="radio" value="2" <?php if($row['flag']=="2"){echo "checked";}?>/>Have the goods</td>
  <input type="hidden" name="id" value="<?php echo $id;?>" />
  <td width="100"><input name="ok"  value="Modify " type="submit" style="width:55px; height:20px;" /></td>
  </tr>
  </form>
  <tr><td height="20" colspan="3"><hr width="500"></td></tr>
  <tr>
  <td width="156" height="20">List of goods (below)：</td><td></td><td></td>
  </tr>
</table><br />
<table width="100%" height="60" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#666666"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
      <tr bgcolor="#628e37" style="color:#FFF">
        <td width="153" height="20">Name of commodity</td>
        <td width="80">The market price</td>
        <td width="80">discount</td>
        <td width="80">The number</td>
          </tr>
          <?php
		  $spc=explode("@",$row['gid']);
	      $slc=explode("@",$row['num']);
		  for($i=0;$i<count($spc)-1;$i++){
		      $rs2=mysqli_query($link,"select * from products where id='$spc[$i]'");
		      $row2=mysqli_fetch_array($rs2);
		  ?>
    <tr bgcolor="#FFFFFF">
        <td height="20"><?php echo $row2['name'];?></td>
        <td height="20"><?php echo $row2['price'];?></td>
        <td height="20"><?php echo $row2['discount'];?></td>
        <td height="20"><?php echo $slc[$i];?></td>

     </tr>
     <?php
		  }
	 ?>
        <tr bgcolor="#FFFFFF">
        <td height="20" colspan="4">
        Total cost:<?php echo $row['total'];?>
          </td>
        </tr>
    </table></td>
  </tr>
</table>
<br />

<br />
</div>
    </div>
    
</body>
</html>