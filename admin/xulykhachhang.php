<?php 

if(!isset($_SESSION['admin'])){
	header('Location: index.php');}

 ?>


<br>
<div class="container">
  
    <div class="">
      <h4>Danh sách khách hàng</h4>
      <?php
      $sql_selct=mysqli_query($con,"SELECT * FROM khachhang ");
      ?>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
          <th>Tên khách hàng</th>
          <th>Email</th>
          <th>Số điện thoại</th>
          <th>Địa chỉ</th>
          <th></th>
        </tr>
        <?php 
        $i=0;
        while($row_loai=mysqli_fetch_array($sql_selct)){
          $i++;
        ?>
        <tr>
          <td>
            <?php echo $i  ?>
          </td>
          <td>
            <?php echo $row_loai['khachhang_ten']  ?>
          </td>
           <td><?php echo $row_loai['khachhang_email'] ?></td>
          <td>
            <?php echo $row_loai['khachhang_sdt']  ?>
          </td>
          <td>
            <?php echo $row_loai['khachhang_diachi']  ?>
          </td>

          <td> 

            <a class="btn btn-success" href="?quanly=khachhang&xoa=<?php echo $row_loai["khachhang_id"] ?>&ten=<?php echo $row_loai["khachhang_ten"]  ?>">Lịch sử mua hàng</a>  
          </td>
          

        </tr>

      <?php } ?>
      </table>

      <br><br>

      <?php 
      if(isset($_GET['xoa'])&&isset($_GET['ten'])){
        $i=0;
        $id=$_GET['xoa'];
        $ten=$_GET['ten'];
        $sql_sp=mysqli_query($con,"SELECT ctdonhang_id,sanpham_ten,donhang_soluong,sanpham_gia,donhang_ngay FROM donhang,sanpham WHERE donhang.sanpham_id=sanpham.sanpham_id and khachhang_id='$id' ORDER BY donhang_ngay DESC;");
       
       ?>
       <h4>Lịch sử mua hàng : <?php echo $ten ?></h4>
        <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
          <th>Mã đơn hàng</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Giá</th>
          <th>Tổng tiền</th>
          <th>Ngày đặt</th>
        </tr>
        <?php while($row_sp=mysqli_fetch_array($sql_sp)){ $i=$i+1; ?>
          <tr>
           <td><?php echo $i ?></td>
           <td><?php echo $row_sp['ctdonhang_id'] ?></td>
           <td><?php echo $row_sp['sanpham_ten'] ?></td>
           <td><?php echo $row_sp['donhang_soluong'] ?></td>
           <td><?php echo $row_sp['sanpham_gia'] ?></td>
           <td><?php echo $row_sp['donhang_soluong']*$row_sp['sanpham_gia']  ?></td>
           <td><?php echo $row_sp['donhang_ngay'] ?></td>
          </tr>
        <?php  } ?>
      </table>
     <?php } ?>
    </div>
 
</div>
