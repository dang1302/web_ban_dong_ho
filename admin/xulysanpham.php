<?php 

if(!isset($_SESSION['admin'])){
	header('Location: index.php');}
if(isset($_POST['themdanhmuc'])){
  $danhmuc=$_POST['danhmuc'];
  $th=$_POST['th'];
  $ten=$_POST['ten'];
  $gia=$_POST['gia'];
  $giakm=$_POST['giakm'];
  $soluong=$_POST['soluong'];
  $mota=$_POST['mota'];
  $anh=$_FILES['anh']['name'];
  $anh_tmp=$_FILES['anh']['tmp_name'];
  $anh2=$_FILES['anh2']['name'];
  $anh2_tmp=$_FILES['anh2']['tmp_name'];
  $anh3=$_FILES['anh3']['name'];
  $anh3_tmp=$_FILES['anh3']['tmp_name'];
  
    mysqli_query($con,"INSERT INTO `sanpham`(`sanpham_ten`, `sanpham_id`, `loai_id`, `sanpham_gia`, `sanpham_km`, `sanpham_soluong`, `sanpham_img`,`sanpham_img2`,`sanpham_img3`, `sanpham_mota`, `thuonghieu_id`) VALUES ('$ten','','$danhmuc','$gia','$giakm','$soluong','$anh','$anh2','$anh3','$mota','$th')");
  move_uploaded_file($anh_tmp,'../images/'.$anh);
  move_uploaded_file($anh2_tmp,'../images/'.$anh2);
  move_uploaded_file($anh3_tmp,'../images/'.$anh3);
  
 
}
if(isset($_POST['capnhap'])){
  $id=$_POST['id_update'];
  $danhmuc=$_POST['danhmuc'];
  $th=$_POST['th'];
  $ten=$_POST['ten'];
  $gia=$_POST['gia'];
  $giakm=$_POST['giakm'];
  $soluong=$_POST['soluong'];
  $mota=$_POST['mota'];
  $anh=$_FILES['anh']['name'];
  $anh_tmp=$_FILES['anh']['tmp_name'];
  $anh2=$_FILES['anh2']['name'];
  $anh2_tmp=$_FILES['anh2']['tmp_name'];
  $anh3=$_FILES['anh3']['name'];
  $anh3_tmp=$_FILES['anh3']['tmp_name'];
  
    mysqli_query($con,"UPDATE `sanpham` SET `sanpham_ten`='$ten',`loai_id`='$danhmuc',`thuonghieu_id`='$th',`sanpham_gia`='$gia',`sanpham_km`='$giakm',`sanpham_soluong`='$soluong',`sanpham_img`='$anh',`sanpham_img2`='$anh2',`sanpham_img3`='$anh3',`sanpham_mota`='$mota' WHERE sanpham_id='$id'");
  move_uploaded_file($anh_tmp,'../images/'.$anh);
  move_uploaded_file($anh2_tmp,'../images/'.$anh2);
  move_uploaded_file($anh3_tmp,'../images/'.$anh3);
  
  header('Location: http://localhost/bandienmay1/admin/dashboard.php?quanly=sanpham');
}
if(isset($_GET['xoa'])){
  $xoa=$_GET['xoa'];
  mysqli_query($con,"DELETE FROM `sanpham` WHERE sanpham_id=$xoa");}


 ?>


<br>
<div class="container">
  <div class="row">
    <?php
    if(isset($_GET['capnhap']))  {
      $capnhap=$_GET['capnhap'];
      $sql_sp=mysqli_query($con,"SELECT * FROM `sanpham` WHERE sanpham_id=$capnhap");
      $row_sp=mysqli_fetch_array($sql_sp);
      $loai=$row_sp['loai_id'];
      $thieu=$row_sp['thuonghieu_id'];


    }else{
      $capnhap='';
    }
    if($capnhap){  ?>
      <div class="col-md-4">
      <h4>C???p nh???p s???n ph???m</h4>
      
      <form action="" method="POST" enctype="multipart/form-data">
        <label>T??n s???n ph???m</label>
        <input type="hidden" name="id_update" class="form-control" value="<?php echo $row_sp['sanpham_id']  ?>">
        <input type="text" name="ten" class="form-control" value="<?php echo $row_sp['sanpham_ten']  ?>"><br>
        <label>Danh m???c</label>
        <select name="danhmuc" class="form-control">
          <option>Ch???n danh m???c</option>
          <?php  
          $select_danhmuc=mysqli_query($con,"SELECT * from loai");
          while($row_danhmuc=mysqli_fetch_array($select_danhmuc)){
            if($loai==$row_danhmuc['loai_id']){
          ?>
          <option selected value="<?php echo $row_danhmuc['loai_id'] ?>"><?php echo $row_danhmuc['loai_ten'] ?></option>
        <?php } else {?>
          <option value="<?php echo $row_danhmuc['loai_id'] ?>"><?php echo $row_danhmuc['loai_ten'] ?></option>
        <?php } }?>
        </select><br>
         <label>Th????ng hi???u</label>
        <select name="th" class="form-control">
          <option value="">Th????ng hi???u</option>
          <?php  
          $select_danhmuc=mysqli_query($con,"SELECT * from thuonghieu");
          while($row_danhmuc=mysqli_fetch_array($select_danhmuc)){
            if($thieu==$row_danhmuc['thuonghieu_id']){
          ?>
          <option selected value="<?php echo $row_danhmuc['thuonghieu_id'] ?>"><?php echo $row_danhmuc['thuonghieu_ten'] ?></option>
        <?php } else {?>
          <option value="<?php echo $row_danhmuc['thuonghieu_id'] ?>"><?php echo $row_danhmuc['thuonghieu_ten']  ?></option>
        <?php } }?>
        </select><br>
         <label>Gi?? s???n ph???m</label>
        <input type="number" name="gia" class="form-control" value="<?php echo $row_sp['sanpham_gia']  ?>"><br>
         <label>Gi?? khuy???n m??i</label>
        <input type="number" name="giakm" class="form-control" value="<?php echo $row_sp['sanpham_km']  ?>"><br>
         <label>S??? l?????ng</label>
        <input type="number" name="soluong" class="form-control" value="<?php echo $row_sp['sanpham_soluong']  ?>"><br>
         <label>???nh</label>
        <input type="file" name="anh" class="form-control" value="<?php echo $row_sp['sanpham_img'] ?>"><br>
        <label>???nh 2</label>
        <input type="file" name="anh2" class="form-control" value="<?php echo $row_sp['sanpham_img2'] ?>""><br>
        <label>???nh 3</label>
        <input type="file" name="anh3" class="form-control" value="<?php echo $row_sp['sanpham_img3'] ?>""><br>
         <label>M?? t???</label>
        <input type="text" name="mota" class="form-control" value="<?php echo $row_sp['sanpham_mota']  ?>"><br>
        <input type="submit" name="capnhap" class="btn btn-default" value="C???p nh???p">
      </form>
    </div> 
     <?php }else{
    ?>
    <div class="col-md-4">
      <h4>Th??m s???n ph???m</h4>
      
      <form action="" method="post" enctype="multipart/form-data">
        <label>T??n s???n ph???m</label>
        <input required="" type="text" name="ten" class="form-control" placeholder="t??n s???n ph???m"><br>
        <label>Danh m???c</label>
        <select name="danhmuc" class="form-control">
          <option value="">Ch???n danh m???c</option>
          <?php  
          $select_danhmuc=mysqli_query($con,"SELECT * from loai");
          while($row_danhmuc=mysqli_fetch_array($select_danhmuc)){
          ?>
          <option value="<?php echo $row_danhmuc['loai_id'] ?>"><?php echo $row_danhmuc['loai_ten'] ?></option>
        <?php } ?>
        </select><br>
        <label>Th????ng hi???u</label>
        <select name="th" class="form-control">
          <option value="" >Ch???n th????ng hi???u</option>
          <?php  
          $select_danhmuc=mysqli_query($con,"SELECT * from thuonghieu");
          while($row_danhmuc=mysqli_fetch_array($select_danhmuc)){
          ?>
          <option value="<?php echo $row_danhmuc['thuonghieu_id'] ?>"><?php echo $row_danhmuc['thuonghieu_ten'] ?></option>
        <?php } ?>
        </select><br>
         <label>Gi?? san ph???m</label>
        <input min="1" required="" type="number" name="gia" class="form-control" placeholder=""><br>
         <label>Gi?? khuy???n m??i</label>
        <input type="number" name="giakm" class="form-control" placeholder=""><br>
         <label>S??? l?????ng</label>
        <input min="1" required="" type="number" name="soluong" class="form-control" placeholder=""><br>
         <label>???nh</label>
        <input required="" type="file" name="anh" class="form-control" value=""><br>
        <label>???nh 2</label>
        <input type="file" name="anh2" class="form-control" value=""><br>
        <label>???nh 3</label>
        <input type="file" name="anh3" class="form-control" value=""><br>
         <label>M?? t???</label>
        <input type="text" name="mota" class="form-control" placeholder=""><br>
        <input type="submit" name="themdanhmuc" class="btn btn-default" value="Th??m">
      </form>
    </div> 
  <?php } ?>
    <div class="col-md-8">
      <h4>Danh s??ch s???n ph???m</h4>
      <?php
      $sql_selct=mysqli_query($con,"SELECT * from sanpham order by sanpham_id");
      ?>
      <table class="table table-bordered">
        <tr>
          <th>TT</th>
          <th>T??n </th>
          <th>Lo???i</th>
          <th>Th????ng hi???u</th>
          <th>S??? l?????ng </th>
          <th>H??nh ???nh </th>
          <th>Gi??  </th>
          <th>Gi?? km</th>
          <th>Qu???n l??</th>
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
            <?php echo $row_loai['sanpham_ten']  ?>
          </td>
          <td>
            <?php 
            $loai = $row_loai['loai_id'] ;
            $row_tl=mysqli_fetch_array(mysqli_query($con,"SELECT loai_ten from loai where loai_id = '$loai' limit 1"));
            $ktm=mysqli_num_rows(mysqli_query($con,"SELECT loai_ten from loai where loai_id = '$loai' limit 1"));
            if($ktm==1){
               echo $row_tl['loai_ten'];
            }else{
              echo '';
            }
           ?>
          </td>
          <td>
            <?php 
            $loai = $row_loai['thuonghieu_id'] ;
            $row_tl=mysqli_fetch_array(mysqli_query($con,"SELECT * from thuonghieu where thuonghieu_id = '$loai' limit 1"));
            $ktm=mysqli_num_rows(mysqli_query($con,"SELECT * from thuonghieu where thuonghieu_id = '$loai' limit 1"));
            if($ktm==1){
               echo $row_tl['thuonghieu_ten'];
            }else{
              echo '';
            }
           ?>
          </td>
          <td>
            <?php echo $row_loai['sanpham_soluong']  ?>
          </td>
          <td>
            <img width="50" height="50" src="../images/<?php echo $row_loai['sanpham_img'] ?>">
          </td>
          <td>
            <?php echo $row_loai['sanpham_gia']  ?>
          </td>
          <td>
            <?php echo $row_loai['sanpham_km']  ?>
          </td>

          <td> 

            <a class="btn btn-success" href="?quanly=sanpham&xoa=<?php echo $row_loai["sanpham_id"]  ?>">x??a</a>  
            <a class="btn btn-success" href="?quanly=sanpham&capnhap=<?php echo $row_loai["sanpham_id"]?>">x???a</a>  

          </td>
          

        </tr>

      <?php } ?>
      </table>
    </div>
  </div>
</div>
