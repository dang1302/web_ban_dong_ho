<?php 

if(!isset($_SESSION['admin'])){
	header('Location: index.php');}
if(isset($_POST['themthuonghieu'])){
  $thuonghieu=$_POST['thuonghieu'];
  mysqli_query($con,"INSERT INTO `thuonghieu`(`thuonghieu_id`, `thuonghieu_ten`) VALUES ('','$thuonghieu')");
}
if(isset($_GET['xoa'])){
  $xoa=$_GET['xoa'];
  mysqli_query($con,"DELETE FROM `thuonghieu` WHERE thuonghieu_id=$xoa");
 }

 ?>



<div class="container">
  <div class="row">
    <?php
    if(isset($_GET['capnhap'])&&isset($_GET['name']))  {
      $capnhap=$_GET['capnhap'];
      $name=$_GET['name'];
      if(isset($_POST['capnhapthuonghieu'])){
  $thuonghieu=$_POST['thuonghieu'];
  mysqli_query($con,"UPDATE `thuonghieu` SET`thuonghieu_ten`='$thuonghieu' WHERE thuonghieu_id=$capnhap");
  header('Location: http://localhost/bandienmay/admin/dashboard.php?quanly=thuonghieu');

}


    }else{
      $capnhap='';
    }
    if($capnhap){  ?>
      <div class="col-md-4">
      <h4>Cập nhập thương hiệu</h4>
      <label>Tên thương hiệu</label>
      <form action="" method="post">
        <input type="text" name="thuonghieu" class="form-control" placeholder="<?php echo $name  ?>"><br>
        <input type="submit" name="capnhapthuonghieu" class="btn btn-default" value="Xửa">
      </form>
    </div> 
     <?php }else{
    ?>
    <div class="col-md-4">
      <h4>Thêm thương hiệu</h4>
      <label>Tên thương hiệu</label>
      <form action="" method="post">
        <input required="" type="text" name="thuonghieu" class="form-control" placeholder="tên thương hiệu"><br>
        <input type="submit" name="themthuonghieu" class="btn btn-default" value="Thêm">
      </form>
    </div> 
  <?php } ?>
    <div class="col-md-8">
      <h4>Danh sách thương hiệu</h4>
      <?php
      $sql_selct=mysqli_query($con,"SELECT * from thuonghieu ");
      ?>
      <table class="table table-bordered">
        <tr>
          <th>Thứ tự</th>
          <th>Tên thương hiệu</th>
          <th>Quản lý</th>
        </tr>
        <?php 
        $i=0;
        while($row_thuonghieu=mysqli_fetch_array($sql_selct)){
          $i++;
        ?>
        <tr>
          <td>
            <?php echo $i  ?>
          </td>
          <td>
            <?php echo $row_thuonghieu['thuonghieu_ten']  ?>
          </td>
          <td> <a class="btn btn-success" href="?quanly=thuonghieu&xoa=<?php echo $row_thuonghieu["thuonghieu_id"]  ?>">Xóa</a>  
               <a class="btn btn-success" href="?quanly=thuonghieu&capnhap=<?php echo $row_thuonghieu["thuonghieu_id"]  ?>&name=<?php echo $row_thuonghieu["thuonghieu_ten"]  ?>">Xửa</a>  

          </td>
          

        </tr>

      <?php } ?>
      </table>
    </div>
  </div>
</div>
