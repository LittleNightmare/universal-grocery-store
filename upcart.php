<?php
session_start();
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$buynum=$_GET['n'];
	$mycar=$_SESSION['mycar'];
	$mycar[$id]['buynum']=$buynum;
	$_SESSION['mycar']=$mycar;
	header("location:cart.php");
	}
?> 