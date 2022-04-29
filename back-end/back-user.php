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
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Product Management</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="back-user.php">User Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="back-order.php">Order Management</a>
              </li>
          </ul>
        </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <main class="container">
          <br>
     
          <br>
          <br>
  
          <div class="table-responsive bg-light rounded shadow-sm">
            <table class="table table-sm table-hover table-bordered">
              <thead class="thead-dark">
                  <tr>
                
                  <th>First Name</th>
                  <th>	Last Name</th>
                  <th>Email</th>
                  
                    <th>Registration Time</th>
                    <th colspan="2">Controls</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              include("../conn.php");
              $rs2 = mysqli_query($link, "select * from users order by id desc ");
       
              while ($row = mysqli_fetch_array($rs2)) {
              ?>
                  <tr>
                  <td><?php echo isset($row['FirstName'])?$row['FirstName']:'No set up';  ?></td>
                  <td><?php echo  isset($row['LastName'])?$row['LastName']:'No set up';  ?> </td>
                  <td><?php echo $row['username'];  ?></td>
                  <td><?php echo $row['time'];  ?></td>
      
                    <td><a href="edit-user.php?id=<?php echo $row['id']; ?>"" class="btn btn-warning">Edit</button></td>
                    <td><a href="deluser.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                  </tr>
                 <?php 
                 }
                 ?>
                 
              </tbody>
          </table>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
              </ul>
            </nav>
  
        </div>
  
            
        </main>
      </div>

    </div>



    

</body>
</html>