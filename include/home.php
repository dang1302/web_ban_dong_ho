
<div class="ads-grid py-sm-5 py-4" >
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">Sản phẩm mới</h3>
							<div class="row">

                     <?php  
							$sql_hot=mysqli_query($con,"SELECT  * from sanpham  order by sanpham_ngay desc limit 3");
							while($row_hot=mysqli_fetch_array($sql_hot)) { ?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?php echo $row_hot['sanpham_img']?>" style='width: 160px;height: 250px;'>
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsp&id=<?php echo $row_hot['sanpham_id']  ?>" class="link-product-add-cart">xem chi tiết</a>
												</div>
											</div>
											<span class="product-new-top">new</span>

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
												<form action="?quanly=giohang" method="post">
													<fieldset>
														<input type="hidden" name="tensp" value="<?php echo $row_hot['sanpham_ten']  ?>" />
														<input type="hidden" name="sanpham_id" value="<?php echo $row_hot['sanpham_id']  ?>" />
														<input type="hidden" name="sanpham_hinhanh" value="<?php echo $row_hot['sanpham_img']  ?>" />
														<input type="hidden" name="sanpham_gia" value="<?php echo $row_hot['sanpham_gia']  ?>" />
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
						   <?php } ?>

								
							</div>
						</div>
						<!-- //first section -->
						<!-- second section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">Giảm giá</h3>
							<div class="row">
								<?php  
							$sql_hot=mysqli_query($con,"SELECT  * from sanpham  order by sanpham_km desc limit 3");
							while($row_hot=mysqli_fetch_array($sql_hot)) { ?>
								<div class="col-md-4 product-men mt-5">
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
												<form action="?quanly=giohang" method="post">
													<fieldset>
														<input type="hidden" name="tensp" value="<?php echo $row_hot['sanpham_ten']  ?>" />
														<input type="hidden" name="sanpham_id" value="<?php echo $row_hot['sanpham_id']  ?>" />
														<input type="hidden" name="sanpham_hinhanh" value="<?php echo $row_hot['sanpham_img']  ?>" />
														<input type="hidden" name="sanpham_gia" value="<?php echo $row_hot['sanpham_gia']  ?>" />
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
						   <?php } ?>
							</div>
						</div>
						<!-- //second section -->
						<!-- third section -->
						
					</div>
				</div>
				<!-- //product left -->
                 <div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<img style="width: 450px;" src="images/poster.jpg">
					<img style="width: 450px;" src="images/poster1.jpg">
					<!-- //product right -->
				</div>
		
				<!-- product right -->
				
			</div>
		</div>
	</div>