<?php 
include_once('../db/connect_db.php');
session_start();
if(isset($_POST['dangnhap'])){
	$tk=$_POST['taikhoan'];
	$mk=md5($_POST['matkhau']);
	if($tk==''||$mk==''){
		echo '<p>nhập đủ</p>';
	}
	else{
		$select_admin=mysqli_query($con,"SELECT * from admin where admin_taikhoan='$tk' and admin_matkhau='$mk' limit 1 ");
		$row_admin=mysqli_fetch_array($select_admin);
		if((mysqli_num_rows($select_admin))>0){
			$_SESSION['admin']=$row_admin['admin_taikhoan'];
			$_SESSION['id']=$row_admin['admin_id'];
			header('Location: dashboard.php');
		}
		else{
			$_SESSION['tt']="Tài khoản mật khẩu ko đúng";
		}
	}
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> dang nhap admin</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body >
	<div style="width: 100%;" align="center"> 
	<h2 align="center">Đăng Nhập Admin</h2>
	<div class="col-md-6" align="center">
	<div class="form-group" >
		<label style="margin: 0 20% 0 20%;">Tài khoản</label>
		<form action="" method="post">
		<input type="text" name="taikhoan" class="form-control">
		<label>Mật khẩu</label>
		<input type="password" style="margin-bottom: 20px;"  name="matkhau" class="form-control">
		<label style="color:red;"><?php
		if(isset($_SESSION['tt'])){ echo $_SESSION['tt']; }?></label><br>
		<input type="submit" name="dangnhap" class="btn btn-primary"  value="Đăng nhập admin">
		</form>
	</div>
	</div>
	</div>
</body>
</html>