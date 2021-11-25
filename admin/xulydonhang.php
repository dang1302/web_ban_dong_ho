<?php 

if(!isset($_SESSION['admin'])){
	header('Location: index.php');}

if(isset($_POST['capnhap'])){
  $mahang=$_POST['mahang'];
  $tr=$_POST['tinhtrang'];
  mysqli_query($con,"UPDATE `donhang` SET`donhang_tinhtrang`='$tr' WHERE ctdonhang_id='$mahang'");
  header('Location: http://localhost/bandienmay/admin/dashboard.php?quanly=donhang');
}
if(isset($_GET['xoa'])){
  $xoa=$_GET['xoa'];
  mysqli_query($con,"DELETE FROM `donhang` WHERE ctdonhang_id=$xoa");}


 ?>


<br>
<div class="container">
  <div class="row">
    <?php
    if(isset($_GET['capnhap']) && isset($_GET['tkh']))  {
      $capnhap=$_GET['capnhap'];
      $tkh=$_GET['tkh'];
      $sql_sp=mysqli_query($con,"SELECT ctdonhang_id,khachhang_ten,sanpham_ten,donhang_soluong,sanpham_gia,donhang_ngay FROM donhang,sanpham,khachhang WHERE donhang.sanpham_id=sanpham.sanpham_id and donhang.khachhang_id=khachhang.khachhang_id and ctdonhang_id='$capnhap'");
      $i=0;
    }else{
      $capnhap='';
    }
    if($capnhap){  ?>
      <div class="col-md-6">
       <h4>Xem chi tiết đơn hàng : <?php echo $capnhap ?> - <?php echo $tkh ?></h4>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
        
          <th>Tên sản phẩm</th>
          <th>Tố lượng</th>
          <th>Giá</th>
          <th>Tổng tiền</th>
          <th>Ngày đặt</th>
        </tr>
        <?php while($row_sp=mysqli_fetch_array($sql_sp)){ $i=$i+1; ?>
          <tr>
           <td><?php echo $i ?></td>
           <td><?php echo $row_sp['sanpham_ten'] ?></td>
           <td><?php echo $row_sp['donhang_soluong'] ?></td>
           <td><?php echo $row_sp['sanpham_gia'] ?></td>
           <td><?php echo $row_sp['donhang_soluong']*$row_sp['sanpham_gia']  ?></td>
           <td><?php echo $row_sp['donhang_ngay'] ?></td>
          </tr>
        <?php  } ?>
      </table>
      <form action="" method="POST">
      <select class="form-group" name="tinhtrang">
        <option value="1">Đã sử lý</option>
        <option value="0">Chưa sử lý</option>
      </select>
      <input type="hidden" name="mahang" value="<?php echo $capnhap ?>">
      <input type="submit" name="capnhap" value="Cập Nhập" class="btn btn-success">
    </form>
    </div>
  <?php } else{?>
    <div class="col-md-6">
      <h4>Xem chi tiết đơn hàng</h4>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Giá</th>
          <th>Tổng tiền</th>
          <th>Ngày đặt</th>
        </tr>
        
      </table>
    </div>
  <?php } ?>
    <div class="col-md-6">
      <h4>Danh sách đơn hàng</h4>
      <?php
      $sql_selct=mysqli_query($con,"SELECT ctdonhang_id,donhang_tinhtrang,  khachhang_ten,  donhang_ngay FROM donhang, sanpham, khachhang WHERE donhang.sanpham_id = sanpham.sanpham_id AND donhang.khachhang_id = khachhang.khachhang_id GROUP by ctdonhang_id,khachhang_ten,donhang_ngay,donhang_tinhtrang order by ctdonhang_id ");
      ?>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
          <th>Mã hàng</th>
          <th>Tình trạng đơn</th>
          <th>Tên khách hàng</th>
          <th>Ngày đặt  </th>
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
            <?php echo $row_loai['ctdonhang_id']  ?>
          </td>
           <td><?php if($row_loai['donhang_tinhtrang']==0){
            echo 'Chưa sử lý';
           }else{
            echo 'Đã sử lý';
           } ?></td>
          <td>
            <?php echo $row_loai['khachhang_ten']  ?>
          </td>
          <td>
            <?php echo $row_loai['donhang_ngay']  ?>
          </td>

          <td> 
            
            <a class="btn btn-success" href="?quanly=donhang&xoa=<?php echo $row_loai["ctdonhang_id"]  ?>">Xóa</a>  
            <a class="btn btn-success" href="?quanly=donhang&capnhap=<?php echo $row_loai["ctdonhang_id"]?>&tkh=<?php echo $row_loai["khachhang_ten"]?>">Xửa</a>  

          </td>
          

        </tr>

      <?php } ?>
      </table>
    </div>
  </div>
</div>
