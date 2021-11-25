<?php
				 include_once('db/connect_db.php');
   
  if(!isset($_SESSION['giohang'])){
     $_SESSION['giohang']=array();
  }
  if(!isset($_SESSION['khachhang_ten'])&& !isset($_SESSION['khachhang_id'])){
  	$_SESSION['khachhang_ten']="";
  	$_SESSION['khachhang_id']="";
  }
				if(!isset($_SESSION['danhmuc'])){$_SESSION['danhmuc']='';};
				$limit=" limit 0,6;";
				/*if(isset($_POST['sxsp'])){
					
					$kt=$_POST['sxsp'];
					if($kt==1){
						$_SESSION['where']=" order by sanpham_gia";
					}elseif($kt==2){
						$_SESSION['where']=" order by sanpham_gia desc";
					}elseif($kt==3){
						$_SESSION['where']=" order by sanpham_ngay desc";
					}elseif($kt==4){
						$_SESSION['where']=" order by sanpham_km desc";
					}
					
				}*/
            
            if(isset($_POST['xapsep'])){
					
					$kt=$_POST['agileinfo_search'];
					if($kt==2){
						$_SESSION['where']=" order by sanpham_gia asc";
					}elseif($kt==1){
						$_SESSION['where']=" order by sanpham_gia desc";
					}elseif($kt==3){
						$_SESSION['where']=" order by sanpham_ngay desc";
					}elseif($kt==4){
						$_SESSION['where']=" order by sanpham_km desc";
					}else{
						$_SESSION['where']="";
					}
					
				}
				if( isset($_GET['trang'])){
					$trang=$_GET['trang'];
							$t=($trang-1)*6;
							$limit=" limit ".$t.",6 ;";
					
					}
				

				if(isset($_POST['th_id'])){
				 	
					$th=$_POST['th_id'];
					$_SESSION['sql1']="SELECT  sanpham_id,sanpham_ten,sanpham_gia,sanpham_km,sanpham_img,sanpham_ngay from sanpham where  thuonghieu_id = '$th'";
					$sql_dm=mysqli_query($con,"SELECT  thuonghieu_ten from thuonghieu where thuonghieu_id = '$th' limit 1");
				 $dm=mysqli_fetch_array($sql_dm);	
				 $_SESSION['danhmuc']=$dm['thuonghieu_ten'];		

				}
							
				 	
				if(isset($_POST['tk'])){
					$tk=$_POST['timkiem'];
					$_SESSION['sql1']="SELECT sanpham_id,sanpham_ten,sanpham_gia,sanpham_km,sanpham_img,sanpham_ngay from sanpham where sanpham_ten like '%$tk%'";
					$_SESSION['danhmuc']='kết quả tìm kiếm';
					
				}
				else{
                 if(isset($_GET['id'])){
				 $id=$_GET['id'];
				 $sql_dm=mysqli_query($con,"SELECT  * from loai where loai_id = '$id' limit 1");
				 $dm=mysqli_fetch_array($sql_dm);	
				 $_SESSION['danhmuc']=$dm['loai_ten'];			
				 $_SESSION['sql1']="SELECT  sanpham_id,sanpham_ten,sanpham_gia,sanpham_km,sanpham_img,sanpham_ngay from sanpham where loai_id = '$id'";
								}
				 if(isset($_GET['loaiid'])&&isset($_GET['thid'])){
				 $id=$_GET['loaiid'];$th=$_GET['thid'];
				 $sql_dm=mysqli_query($con,"SELECT  * from loai where loai_id = '$id' limit 1");
				 $dm=mysqli_fetch_array($sql_dm);	
				 $_SESSION['danhmuc']=$dm['loai_ten'];			
				 $_SESSION['sql1']="SELECT  * from sanpham where loai_id = '$id' and thuonghieu_id = '$th'";
								}
				 
				}
				if(isset($_GET['pk'])){
					$_SESSION['danhmuc']="Phụ Kiện";
					$_SESSION['sql1']="SELECT  sanpham_id,sanpham_ten,sanpham_gia,sanpham_km,sanpham_img,sanpham_ngay from sanpham,loai where sanpham.loai_id=loai.loai_id and loai_loai=1";	
				}
				if(isset($_SESSION['sql1'])){

				 $sql_hot1=mysqli_query($con,$_SESSION['sql1']);
								$sp_count= mysqli_num_rows($sql_hot1);
								$sp_buttun=$sp_count/6;
								$_SESSION['trang']=ceil($sp_buttun);
				}
		      if(isset($_SESSION['where'])){
		      	$_SESSION['sql']=$_SESSION['sql1'] . $_SESSION['where'] . $limit;
		      }else{
		      	$_SESSION['sql']=$_SESSION['sql1'] . $limit;
		      }
				
				?>
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Trang Chủ</a>
						<i>|</i>
					</li>
					<li><?php echo $_SESSION['danhmuc'] ?></li>
				</ul>
			</div>
		</div>
	</div>

<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						
						<!-- second section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<div class="row">
								<?php 
								$sql_hot=mysqli_query($con,$_SESSION['sql']);
								
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
										<div class="item-info-product text-center border-top mt-4" >
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

							<?php 
							$i=0;
							if(isset($_SESSION['trang'])&&$_SESSION['trang']>1){
							
							for($i=1;$i<=$_SESSION['trang'];$i++){
								echo' <a style="margin:0 5px;" href="?quanly=danhmuc&trang='.$i.'">'.$i.'</a>';
							}}
							
							 ?>
						<!-- //second section -->
						<!-- third section -->
						
					</div >
				</div>
				<!-- //product left -->
             <?php include_once('include/left.php'); ?>
				<!-- product right -->

				
					<!-- //product right -->
					<!-- //product right -->
				</div >
			</div>
		</div>
	</div>
	

