<?php
include("conn.php");
 

$totalprice=$_SESSION['total'];
$username=$_SESSION['user'];
 
foreach($_SESSION['mycar'] as $v){
	$gid.=$v['id']."@";
	$num.=$v['buynum']."@";
	}
	$addsql="insert into orderlist(username,gid,num,total,time) value('$username','$gid','$num','$totalprice',now())";
$addrs=mysqli_query($link,$addsql) or die(mysqli_error());
if(mysqli_affected_rows($link)>0){
	unset($_SESSION['mycar']);
	unset($_SESSION['total']);
  
	echo '<script type="text/javascript">alert("Order added successfully!");</script>';
	echo '<script type="text/javascript">location.href="index.php";</script>';
	}else{
		echo '<script type="text/javascript">alert("Failed to add an order. Procedure!");</script>';
	    echo '<script type="text/javascript">location.href="index.php";</script>';
		}
?> 