<?php 
include_once('../db/connect_db.php');
session_start();
if(!isset($_SESSION['admin'])){
	header('Location: index.php');}


 ?>

<!DOCTYPE html>
<html>
<head>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<meta charset="utf-8">
	<title>Admin</title>
</head>
<body>
<p>Xin chào : <?php echo $_SESSION['admin']?>  <a href="index.php" style="padding-left:20px">Đăng Xuất</a></p>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="?quanly=donhang">Đơn hàng <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?quanly=danhmuc">Danh mục</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="?quanly=thuonghieu">Thương hiệu</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?quanly=sanpham">Sản phẩm</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="?quanly=khachhang">Khách hàng</a>
      </li>
    </ul>
  </div>
 
</nav>
 <?php 
  $quanly;
  if(isset($_GET['quanly'])){
  	$quanly=$_GET['quanly'];
  }else{$quanly='';}
  if($quanly=='danhmuc'){
  	include_once('xulydanhmuc.php');
  }elseif($quanly=='sanpham'){
  	include_once('xulysanpham.php');
  }elseif($quanly=='khachhang'){
  	include_once('xulykhachhang.php');
  }elseif($quanly=='donhang'){
    include_once('xulydonhang.php');
  }
  elseif($quanly=='thuonghieu'){
    include_once('xulythuonghieu.php');
  }
  else{
    include_once('xulysanpham.php');
  }
  ?>
</body>
</html>