<?php session_start();   
  $link = mysqli_connect("localhost", "root" ,"","db_vegetable");  
  header("Content-type: text/html; charset=utf-8"); 
  ini_set('error_reporting', 'E_ALL ^ E_NOTICE'); 

   mysqli_query($link,"set names utf8");
  ?>