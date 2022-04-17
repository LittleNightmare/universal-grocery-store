<?php
include("../conn.php");

		$id=$_POST['id'];
		$flag=$_POST['flag'];
		$rs=mysqli_query($link,"update orderlist set flag='$flag' where id='$id'") or die(mysqli_error());
        if(mysqli_affected_rows($link)>0){
			echo '<script type="text/javascript">alert(" success!");</script>';
	        echo '<script type="text/javascript">location.href="back-order.php";</script>';
			}else{
				echo '<script type="text/javascript">alert("failure!");</script>';
	            echo '<script type="text/javascript">location.href="back-order.php";</script>';
				}
?> 