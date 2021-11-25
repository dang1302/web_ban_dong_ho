<?php 
  if(isset($_GET['id'])){
  	$id=$_GET['id'];
  }else{$id='';}

 $sql_chitiet=mysqli_query($con,"SELECT sanpham_id,sanpham_ten ,sanpham_gia,sanpham_km,sanpham_img,sanpham_mota,thuonghieu_id,loai_id,sanpham_img2,sanpham_img3 from sanpham where sanpham_id='$id'");
 $spct=mysqli_fetch_array($sql_chitiet);
 $gia=$spct['sanpham_gia'];
 if(isset($_POST['danhgia'])){
 	$dg=$_POST['text'];
 	$kh=$_SESSION['khachhang_id'];
 	if($dg!=""){
 	mysqli_query($con,"INSERT INTO `danhgia`(`sanpham_id`, `khachhang_id`, `danhgia_danhgia`) VALUES ('$id','$kh','$dg')");}
 }
 ?>

<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang Chủ</a>
						<i>|</i>
					</li>
					<li><?php echo $spct['sanpham_ten'] ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<!-- <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Chi tiết sản phẩm</h3> -->
			<!-- //tittle heading -->
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">
								<li data-thumb="images/<?php echo $spct['sanpham_img'] ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $spct['sanpham_img'] ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
								<?php if($spct['sanpham_img2']!="") {?>
								<li data-thumb="images/<?php echo $spct['sanpham_img2'] ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $spct['sanpham_img2'] ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
							<?php } ?>
							<?php if($spct['sanpham_img3']!="") {?>
								<li data-thumb="images/<?php echo $spct['sanpham_img3'] ?>">
									<div class="thumb-image">
										<img src="images/<?php echo $spct['sanpham_img3'] ?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
							<?php }  ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo $spct['sanpham_ten'] ?></h3>
					<p class="mb-3">
						<span class="item_price">$<?php echo $spct['sanpham_gia'] ?></span>
						<del class="mx-2 font-weight-light">$<?php echo $spct['sanpham_km'] ?></del>
						<label>Miễn phí vận chuyển</label>
					</p>
					<p class="mb-3">
						<label><?php $loai = $spct['thuonghieu_id'] ;
            $row_tl=mysqli_fetch_array(mysqli_query($con,"SELECT * from thuonghieu where thuonghieu_id = '$loai' limit 1"));
            $ktm=mysqli_num_rows(mysqli_query($con,"SELECT * from thuonghieu where thuonghieu_id = '$loai' limit 1"));
            if($ktm==1){
               echo "Thương hiêu : ".$row_tl['thuonghieu_ten'];
            }else{
              echo '';
            }  ?></label>
					</p>
					<p class="mb-3">
						<label><?php $loai = $spct['loai_id'] ;
            $row_tl=mysqli_fetch_array(mysqli_query($con,"SELECT loai_ten from loai where loai_id = '$loai' limit 1"));
            $ktm=mysqli_num_rows(mysqli_query($con,"SELECT loai_ten from loai where loai_id = '$loai' limit 1"));
            if($ktm==1){
               echo "Loại : ".$row_tl['loai_ten'];
            }else{
              echo '';
            }  ?></label>
					</p>
					<div class="single-infoagile">
					
					<div class="product-single-w3l">
						<p class="my-3">
							<i class="far fa-hand-point-right mr-2"></i>
							<label>1 năm</label>bảo hành</p>
						<ul>
							<li class="mb-1">
								<?php echo "Giới thiệu sản phẩm : ".$spct['sanpham_mota']  ?>
							</li>
							
						</ul>
						<p class="my-sm-4 my-3">
							<i class="fas fa-retweet mr-3"></i>Lưu động thanh toán
						</p>
					</div>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanly=giohang" method="post">
													<fieldset>
														<input type="hidden" name="tensp" value="<?php echo $spct['sanpham_ten']  ?>" />
														<input type="hidden" name="sanpham_id" value="<?php echo $spct['sanpham_id']  ?>" />
														<input type="hidden" name="sanpham_hinhanh" value="<?php echo $spct['sanpham_img']  ?>" />
														<input type="hidden" name="sanpham_gia" value="<?php echo $spct['sanpham_gia']  ?>" />
														<input type="hidden" name="sanpham_sl" value="1" />
														<?php if($_SESSION['khachhang_ten']!=''){ ?>
														<input type="submit" name="themgiohang" value="thêm giỏ hàng" class="button btn" />
													<?php } else{?>
														<input type="button" data-toggle="modal" data-target="#dangky" value="thêm giỏ hàng" class="button btn" />
													<?php } ?>
													</fieldset>
												</form>
						</div>
					</div>
				</div>
			</div>

		</div>
    <br>
    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">Sản phẩm cùng tầm giá</h3>
							<div class="row">
							

                     <?php  
                  
							$sql_hot=mysqli_query($con,"SELECT  * from sanpham where sanpham_gia>($gia-500) and sanpham_gia<($gia+500)  and sanpham_id !='$id' order by sanpham_gia desc limit 3");
							while($row_hot=mysqli_fetch_array($sql_hot)) { ?>
								<div class="col-md-4 product-men mt-5" >
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?php echo $row_hot['sanpham_img']?>" style='width: 160px;height: 250px;'>
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsp&id=<?php echo $row_hot['sanpham_id']  ?>" class="link-product-add-cart">xem chi tiết</a>
												</div>
											</div>
										
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsp&id=<?php echo $row_hot['sanpham_id']  ?>"><?php echo $row_hot['sanpham_ten'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price">$<?php echo $row_hot['sanpham_gia'] ?></span>
												<del>$<?php echo $row_hot['sanpham_km'] ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											
											</div>

										</div>
									</div>
								</div>
						   <?php } ?>

							</div>	
						
						</div>

    <br>
    <div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="heading-tittle text-center font-italic">
				Đánh giá sản phẩm
			</h3>
			
     
						<?php 
						$danhgia_select=mysqli_query($con,"SELECT khachhang_ten,danhgia_danhgia from danhgia,khachhang where danhgia.khachhang_id=khachhang.khachhang_id  and danhgia.sanpham_id = '$id' order by danhgia_ngay desc ");
						while($row_danhgia=mysqli_fetch_array($danhgia_select)){
						 ?>
						 <div style="padding-top:10px;">
						 <label>
						 <img src="images/avt.jpg" width="100px" style="background-color:black;border-radius: 100%;">
						 <label  style="border-radius: 10px;background-color: #007bff;color: white;padding: 10px;"><?php echo $row_danhgia['danhgia_danhgia'] ?> </label>
						 </label>
						 </div>
						 <br>
						<?php } ?>
					
          <br>
          <?php 

          	$kh=$_SESSION['khachhang_id'];
          $kt=mysqli_query($con,"SELECT * from donhang where khachhang_id='$kh' and sanpham_id='$id' limit 1 ;");
          $ktm=mysqli_num_rows($kt);
          $kt1=mysqli_num_rows(mysqli_query($con,"SELECT * from danhgia where sanpham_id='$id' and khachhang_id='$kh' limit 1"));
          if(mysqli_num_rows($kt)==1 && $kt1<1){
           ?>
          
       <form action="" method="POST">
      <input type="text" style="width: 50%;" name="text" placeholder="đánh giá sản phẩm" >
      <input type="submit" name="danhgia" value="đánh giá" class="btn btn-success">
    </form>
     <?php }else{ }; ?>
					
		</div>

	</div>
	<!-- //Single Page -->