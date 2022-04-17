

<?php
session_start();
if(isset($_POST['submit'])){
	$id=$_POST['gid'];
	$buynum=$_POST['num'];
	if(isset($_SESSION['mycar'])){
		$mycar=$_SESSION['mycar'];
		if(array_key_exists($id,$mycar)){
			$mycar[$id]['buynum']=$mycar[$id]['buynum']+$buynum;
		    }else{
			   $mycar[$id]=array('id'=>$id,'buynum'=>$buynum);
		       }
	   }else{
		   $mycar[$id]=array('id'=>$id,'buynum'=>$buynum);
	        }
	$_SESSION['mycar']=$mycar;
 
	header("location:cart.php");
	}
?> 

<?php // include_once 'conn.php';
//        if(!isset($_SESSION['user'])){
		   
// 		          echo "<script>alert('请你登陆！');location='login.php'</script>";
// 				  die;
// 		   }
        
//         // put your code here
// //        var_dump($_POST);
//         $gid=$_POST['gid'];   
//         $num=$_POST['num'];     
//         $total=$_POST['total'];     
//         $username=$_SESSION['user'];  
 
         
            
//              $querySql="SELECT * FROM orderlist WHERE username='$username' AND gid='$gid' and flag='0'";
//             $result1=  mysqli_query($link,$querySql);
//             $row_nums=  mysqli_fetch_row($result1);
//             $num1=$row_nums['3'];
//             $t=$num1+$num;
//             $result;
//             if($row_nums>0){
//                 $updateSql="
//                     UPDATE orderlist
//                     SET num='$t'
//                     WHERE username='$username' AND gid='$gid'";

//                 $result=  mysqli_query($link,$updateSql);
//                  echo "<script> location='cart.php'</script>";
//             }else{
//             //插入购物车表
//              $cartSql="INSERT INTO orderlist(username,gid,num)VALUES('$username','$gid','$num');";
//             //echo "<br>$cartSql</br>";
//             $result=mysqli_query($link,$cartSql);//查询表并返回结果集
//             var_dump($result);
//             }
             
   
//             //3.操作结果集
//             if($result){
//                 echo "<script>location='car.php'</script>";
//             }else{
//                 echo "<script>alert('抱歉商品添加购物车失败，请继续努力！');location='detail.php?id=$gid'</script>";
//             }
?> 