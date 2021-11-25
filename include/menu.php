<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					
						<select  id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
							<option>Thương Hiệu</option>
							
							<?php  
							$sql_loai=mysqli_query($con,'SELECT * from thuonghieu order by thuonghieu_id');
							while($row_loai=mysqli_fetch_array($sql_loai)) { ?>
								<a href="?quanly=danhmuc&thid=<?php echo $row_loai['thuonghieu_id'] ?>">
								<option id="op" value="<?php echo $row_loai['thuonghieu_id']  ?>">
									<?php echo $row_loai['thuonghieu_ten'] ?>
									</option></a>
						   <?php } ?>
						</select>
						
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div style="text-align: center; margin-left: 100px;">
				<div class="collapse navbar-collapse" id="navbarSupportedContent" style="text-align: center;">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">TRANG CHỦ
								<span class="sr-only">(current)</span>
							</a>
						</li>
 
                  <?php  
							$sql_loai=mysqli_query($con,'SELECT * from loai where loai_loai="0" order by loai_id ');
							while($row_loai=mysqli_fetch_array($sql_loai)) { ?>
								

                        <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link " href="?quanly=danhmuc&id=<?php echo $row_loai['loai_id'] ?>" role="button"  aria-haspopup="true" aria-expanded="false">
								<?php echo $row_loai['loai_ten'] ?>
							</a>
							<div class="dropdown-menu">
								<div class="agile_inner_drop_nav_info p-4">
									<h5 class="mb-3">Thương hiệu</h5>
									<div class="row">
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">
												
												<?php 
												$sql_th=mysqli_query($con,"SELECT* from thuonghieu");
												while($row_th=mysqli_fetch_array($sql_th))
												{ ?>
													<li>
													<a href="?quanly=danhmuc&loaiid=<?php echo $row_loai['loai_id']?>&thid=<?php echo $row_th['thuonghieu_id'] ?>"><?php echo $row_th['thuonghieu_ten'] ?></a>
												</li>
												<?php } ?>	
											</ul>
										</div>
										
									</div>
								</div>
							</div>
						</li>
						   <?php } ?>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link " href="?quanly=danhmuc&pk=10 role="button"  aria-haspopup="true" aria-expanded="false">
								PHỤ KIỆN
							</a>
							<div class="dropdown-menu">
								<div class="agile_inner_drop_nav_info p-4">
									<h5 class="mb-3">Các loại phụ kiện</h5>
									<div class="row">
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">
												
												<?php 
												$sql_th=mysqli_query($con,"SELECT* from loai where loai_loai=1");
												while($row_th=mysqli_fetch_array($sql_th))
												{ ?>
													<li>
													<a href="?quanly=danhmuc&id=<?php echo $row_th['loai_id']?>"><?php echo $row_th['loai_ten'] ?></a>
												</li>
												<?php } ?>	
											</ul>
										</div>
										
									</div>
								</div>
							</div>
						</li>

						

						
						
						<!-- <li class="nav-item mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="product.html">TIN TỨC</a>
						</li>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								TRANG
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="product.html">SẢN PHẨM MỚI</a>
							
								<a class="dropdown-item" href="checkout.html">KIỂM TRA ĐƠN HÀNG</a>
								<a class="dropdown-item" href="payment.html">THANH TOÁN ĐƠN HÀNG</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">LIÊN HỆ</a>
						</li> -->
					</ul>
				</div>
			</div>
			</nav>
		</div>
	</div>
	<script>
	
    

    $(document).ready(function(){

    	$('#agileinfo-nav_search').change(function(){
            
    		var th_id=$("#agileinfo-nav_search option:selected").val()
    		$.ajax({
    			
    			url:'danhmucsp.php',
    			method:'post',
    			data:{'th_id':th_id},
    			success: function(response){
                    
    				$('#htsp').html(response);
    			}
    		});
    	});
    	

    	
  });
 
	</script>