<?php
include("../conn.php");

	$id=$_GET['id'];
	$rs=mysqli_query($link,"delete from products where id='$id'") or die (mysqli_error());
	if(mysqli_affected_rows($link)>0){
		echo '<script type="text/javascript">alert("Delete the success!")</script>';
	    echo '<script type="text/javascript">location.href="index.php";</script>';
		}
