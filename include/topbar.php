	<?php 
	if(isset($_POST['dangky'])){
		$ten=$_POST['name'];
		$email=$_POST['email'];
		$mk=md5($_POST['password']);
		/*$mk1=md5($_POST['password1']);*/
		$phone=$_POST['sdt'];
		/*if($mk==$mk1){*/
		if($ten!=''&&$email!=''&&$mk!=''&&$phone!=''){
			mysqli_query($con,"INSERT INTO `khachhang`(`khachhang_ten`, `khachhang_sdt`, `khachhang_email`,`khachhang_matkhau`) VALUES ('$ten','$phone','$email','$mk')");
			$sql=mysqli_query($con,"SELECT *  from khachhang order by khachhang_id desc limit 1");
			$row=mysqli_fetch_array($sql);
			$_SESSION['khachhang_ten']=$row['khachhang_ten'];
		    $_SESSION['khachhang_id']=$row['khachhang_id'];
		}/*}
		else{echo "<script> alert ('xem lại passwork') </script>";}*/

	}
	if(isset($_GET['dangxuat'])){
		$_SESSION['khachhang_ten']='';
		$_SESSION['khachhang_id']='';
		session_destroy();
	}
	if(isset($_POST['dangnhap'])){
		$email=$_POST['email'];
		$mk=md5($_POST['mk']);
		if($email!=0 && $mk!=0){
			$sql=mysqli_query($con,"SELECT * from khachhang WHERE khachhang_email='$email' and khachhang_matkhau='$mk' ");
			$count=mysqli_num_rows($sql);
			$row=mysqli_fetch_array($sql);
			if($count>0){
				$_SESSION['khachhang_ten']=$row['khachhang_ten'];
		        $_SESSION['khachhang_id']=$row['khachhang_id'];
				header('Location:index.php');
			}else{
				echo '<script> alert("tài khoản hoặc mật khẩu ko đúng")</script>';
			}
		}
	 
	}?>
	<!-- top-header -->
	<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					
					
						<?php
					if($_SESSION['khachhang_ten']!='' && $_SESSION['khachhang_id']!=''){  ?>
						<p class="text-white text-lg-left text-center">Xin chào : <?php echo $_SESSION['khachhang_ten'] ?>
							<i class="fas fa-shopping-cart ml-1"></i>
							<a href="index.php?dangxuat=1" style="color:red;">Đăng Xuất</a>
					</p> 
					<?php }else{}; ?>
						
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
						<?php 
						if($_SESSION['khachhang_ten']!=''){
						 ?>
						
						
						<li class="text-center border-right text-white">
							<a href="?quanly=xemdonhang" data-target="#exampleModal" class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem Đơn Hàng</a>
						</li>
					<?php } ?>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i> 6969696969
						</li>
						<li class="text-center border-right text-white">
							<a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập </a>
						</li>
						<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng Ký</a>
						</li>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>

	<!-- Button trigger modal(select-location) -->
	
	<!-- //shop locator (popup) -->

	<!-- modals -->
	
	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng Nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email" required="">
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" class="form-control" placeholder=" " name="mk" required="">
						</div>
						
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangnhap" value="đăng nhập">
						</div>
						
						
						<p class="text-center dont-do mt-3">chưa có tài khoản
							<a href="#" data-toggle="modal" data-target="#dangky">
								Đăng Ký</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng Ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên Khách Hàng</label>
							<input type="text"  class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Số Điện Thoại</label>
							<input minlength="10" type="number" class="form-control" placeholder=" " name="sdt" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật Khẩu</label>
							<input type="password" minlength="6" class="form-control" placeholder=" " name="password" required="">
						</div>
						
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangky" value="đăng ký">
						</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->

	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.html" class="font-weight-bold font-italic">
							<img src="images/logo.jfif" alt=" " class="img-fluid">Nóm 16
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="?quanly=danhmuc" method="post">
								<input class="form-control mr-sm-2" name="timkiem" type="search" placeholder="Search" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="tk" type="submit">Tìm Kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<?php if(!($_SESSION['khachhang_id']=="")){ ?>
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<form action="?quanly=giohang" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									<button class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"></i>
									</button>
								</form>
							</div>
						</div>
						</div>
					<?php } ?>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>