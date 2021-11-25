<?php 


if(isset($_GET['xoa'])){
  $xoa=$_GET['xoa'];
  mysqli_query($con,"DELETE FROM `donhang` WHERE ctdonhang_id=$xoa");
  mysqli_query($con,"DELETE FROM `ctdonhang` WHERE ctdonhang_id=$xoa");
}


 ?>


<br>
<div class="container">
 
    <div class="col-md-9">
      <h4 class="mb-sm-4 mb-3">Xem đơn hàng</h4>
      <?php
      $id=$_SESSION['khachhang_id'];
      $sql_selct=mysqli_query($con,"SELECT ctdonhang_id,sum(sanpham_gia*donhang_soluong) as tong,donhang_tinhtrang,donhang_ngay from khachhang,donhang,sanpham WHERE khachhang.khachhang_id=donhang.khachhang_id and donhang.sanpham_id=sanpham.sanpham_id and donhang.khachhang_id='$id' GROUP by ctdonhang_id,donhang_tinhtrang;");
      ?>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
          <th>Mã hàng</th>
          <th>Tình trạng đơn</th>
          <th>Tổng tiền</th>
          <th>Ngày đặt  </th>
          <th></th>
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
            <?php echo $row_loai['ctdonhang_id']  ?>
          </td>
           <td><?php if($row_loai['donhang_tinhtrang']==0){
            echo 'chưa sử lý';
           }else{
            echo 'đã sử lý';
           } ?></td>
          <td>
            <?php echo $row_loai['tong']  ?>
          </td>
          <td>
            <?php echo $row_loai['donhang_ngay']  ?>
          </td>

          <td> 
            <?php if($row_loai['donhang_tinhtrang']==0) {?>
            <a style="padding-right:10px" class="btn btn-success" href="?quanly=xemdonhang&xoa=<?php echo $row_loai["ctdonhang_id"]  ?>">Xóa</a>  <?php } ?>
          </td>
          <td>
            <label> </label>
            <a style="padding-left:10px;" class="btn btn-success" href="?quanly=xemdonhang&capnhap=<?php echo $row_loai["ctdonhang_id"]?>">Xem</a>  

          </td>
          

        </tr>

      <?php } ?>
      </table>
    </div>

     <div class="row">
    <?php
    if(isset($_GET['capnhap']))  {
      $capnhap=$_GET['capnhap'];
     
      $sql_sp=mysqli_query($con,"SELECT ctdonhang_id,khachhang_ten,sanpham_ten,donhang_soluong,sanpham_gia,donhang_ngay FROM donhang,sanpham,khachhang WHERE donhang.sanpham_id=sanpham.sanpham_id and donhang.khachhang_id=khachhang.khachhang_id and ctdonhang_id='$capnhap'");
      $i=0;
    }else{
      $capnhap='';
    }
    if($capnhap){  ?>
      <div class="col-md-9">
       <h4 class="mb-sm-4 mb-3">Chi tiết đơn hàng : <?php echo $capnhap ?> </h4>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
        
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
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
      
    </div>
  <?php } else{?>
  <?php } ?>
  </div>
</div>
