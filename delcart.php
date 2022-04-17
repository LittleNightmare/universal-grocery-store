<?php
session_start();
if(isset($_GET['id'])){
	$id=$_GET['id'];
    $mycar=$_SESSION['mycar'];
    foreach($mycar as $v){
	    if($v['id']==$id){
		    unset($mycar[$id]);
		    }
	}
    $_SESSION['mycar']=$mycar;
	header("location:cart.php");
}
?> 