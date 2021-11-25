
<?php 
 if(isset($_POST['themgiohang'])){
 	$tensp=$_POST['tensp'];
 	$idsp=$_POST['sanpham_id'];
 	$giasp=$_POST['sanpham_gia'];
 	$hasp=$_POST['sanpham_hinhanh'];
 	$slsp=$_POST['sanpham_sl'];
 	if(isset($_SESSION['giohang'][$idsp])){
 		$_SESSION['giohang'][$idsp]['slsp'] +=$slsp;
 	}
 	else
 	{   
        $_SESSION['giohang'][$idsp]=array('tensp' => $tensp ,'idsp' => $idsp ,'giasp' => $giasp , 'hasp'=>$hasp , 'slsp'=> $slsp ) ;
 	}}
 if(isset($_POST['capnhapsoluong'])){
 	$idsp=$_POST['sanpham_id'];
 	$sl=$_POST['soluong'];
 	if(isset($_SESSION['giohang'][$idsp])){
 	$_SESSION['giohang'][$idsp]['slsp'] = $sl;
 	}
 	}
 	 
 if(isset($_GET['xoa'])){   /*cho <a herf ></a>*/
 	$idsp=$_GET['xoa'];
 	unset($_SESSION['giohang'][$idsp]);
 	
 }
 if(isset($_POST['thanhtoan'])){
 	$name=$_POST['name'];
 	$phone=$_POST['phone'];
 	$address=$_POST['diachi'];
 	$note=$_POST['note'];
 	$giaohang=$_POST['giaohang'];
 	$kh=mysqli_query($con,"INSERT INTO `ctdonhang`(`ctdonhang_tennguoinhan`, `ctdonhang_sdtnguoinhan`, `ctdonhang_diachinhan`, `ctdonhang_giaohang`, `ctdonhang_ghichu`) VALUES ('$name','$phone','$address','$giaohang','$note')");
 	if($kh){
 		$sql_ctdh=mysqli_query($con,"SELECT * from ctdonhang order by ctdonhang_id desc limit 1");
 		$row_ctdonhang=mysqli_fetch_array($sql_ctdh);
 		$ctdh_id=$row_ctdonhang['ctdonhang_id'];
 		
 	
 		$khachhang_id=$_SESSION['khachhang_id'];

 		foreach($_SESSION['giohang'] as $gh){
 			$spid=$gh['idsp'];
 			$sl=$gh['slsp'];
 			mysqli_query($con,"INSERT INTO `donhang`(`donhang_id`, `sanpham_id`, `khachhang_id`, `donhang_soluong`, `ctdonhang_id`) VALUES ('','$spid','$khachhang_id','$sl','$ctdh_id')");
 			mysqli_query($con,"UPDATE sanpham set sanpham_soluong=(sanpham_soluong-'$sl') where sanpham_id='$spid'");

 		       unset($gh);
 		}
 		echo '<script language="javascript">';
  echo 'alert(mua hàng thành công)';  //not showing an alert box.
  echo '</script>';
 	  $_SESSION['giohang']=array();

 	} 
 }	 
 ?>


<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng của bạn
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				
				<div class="table-responsive">
					<form action="" method="post">
					<table class="timetable_sub" >
						<thead >
							<tr >
								<th>Thứ tự</th>
								<th style="width: 300px;">Sản phẩm</th>
								<th style="width: 100px;">Số lượng</th>
								<th>Tên sp</th>

								<th>Giá</th>
								<th>Tổng</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$slsp=0;
							$tong=0; 
							foreach($_SESSION['giohang'] as $gh)
							{
								$slsp=$slsp+1;
								$tong=$tong+($gh['slsp']*$gh['giasp']);
								$idspsl=$gh['idsp'];
								$sl2=mysqli_fetch_array(mysqli_query($con,"SELECT sanpham_soluong from sanpham where sanpham_id='$idspsl' limit 1"));
								$max=$sl2['sanpham_soluong'];
							 ?>

							<tr class="rem1">
								<form action="" method="post">
								<td class="invert"><?php echo $slsp ?></td>
								<td class="invert-image">
									<a >
										<img src="images/<?php echo $gh['hasp'] ?>" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<input type="number" min="1" max="<?php echo $max ?>" name="soluong" value="<?php echo $gh['slsp'] ?>">
								</td>
								<td class="invert"><?php echo $gh['tensp'] ?></td>
								<input type="hidden" name="sanpham_id" value="<?php echo $gh['idsp'] ?>">
								<td class="invert">$<?php echo $gh['giasp'] ?></td>
								<td class="invert">$<?php echo $gh['giasp']*$gh['slsp'] ?></td>
								<td class="invert">
									<a class="btn btn-success" href="?quanly=giohang&xoa=<?php echo $gh['idsp']  ?>">xóa</a>
								</td>
							
								<td colspan="7"><input class="btn btn-success" type="submit" name="capnhapsoluong" value="sửa"></td>
							</form>
							</tr>
							<?php } ?>
							<!-- <tr><td colspan="7"><input class="btn btn-success" type="submit" name="capnhapsoluong" value="cập nhập giỏ hàng"></td></tr> -->
							<tr><td colspan="8">Tổng tiền : $<?php echo $tong  ?></td></tr>
						</tbody>
					</table>
					
				</div>
			</div>
			  
			
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Địa chỉ giao hàng</h4>
					<form action="" method="post" >
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Tên gười nhận" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input minlength="10" type="number" class="form-control" placeholder="Số điện thoại người nhận" name="phone" required="">
											</div>
										</div>
										
									</div>
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="diachi" placeholder="Địa chỉ nhận" required="">
									</div>
									<div class="controls form-group">
										<textarea class="form-control" placeholder="Ghi chú" name="note" required=""></textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Cách thức thanh toán</option>
											<option value="1">Chuyển khoản</option>
											<option value="0">Nhận song chả</option>
											

										</select>
									</div>
								<div>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%;" value="Thanh toán">
							
						</div>
					</div>
					</form>
					
				</div>
			</div>
		
		</div>
	</div>