<?php

$data = selectAll($conn, "SELECT id,productname FROM `tbl_product`");

$validate = [];
if (isset($_POST["btn"])) {
   $id = $_POST['id'];
   $color = $_POST['color'];
    $fileCount = count($_FILES['files']['name']);


     for ($i = 0; $i < $fileCount; $i++) {
           

       $dir = "../image/";
       $up_file = $dir . $_FILES['files']['name'][$i];
            
            move_uploaded_file($_FILES['files']['tmp_name'][$i], $up_file);
            insert($conn,"INSERT INTO `tbl_detailimage`( `product_id`, `image`, `color`) VALUES ('$id','$up_file','$color')");
        }
   

}
// if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//    $data = selectAll($conn, "SELECT * FROM `tbl_category` where id=$id");



// }
// if (isset($_POST["btnupdate"])) {

//    $category = $_POST["category"];
//    updatedata($conn, "UPDATE `tbl_category` SET `categoryname`='$category' WHERE id=$id");
//    header("location:listcategory.php");
// }
// if (isset($_POST["btnlist"])) {
//    header("location:listcategory.php");
// }

?>
<style>
* {

   margin: 0;
   padding: 0;
   box-sizing: border-box;
}

ul {
   padding-left: 0 !important;
}

p {

   margin-bottom: 0 !important;
}

.container {
   width: 1300px;
   margin: 0 auto;
}

.headermenu ul {
   display: flex;
   gap: 18px;
   align-items: center;
}

.headermenu ul li {


   list-style: none;

}

.headermenu ul li a {
   color: white;
   text-decoration: none;


}

.headeractive {
   font-size: 20px;
}

.input input {
   width: 100%;
}

.button {
   display: flex;
   gap: 10px;
   margin-top: 20px;
}

.button button {
   width: 100px;
   height: 40px;
   border-radius: 5px;

   background: white;
}
</style>


<div class="wrapper" style="margin-top:20px;width:70%">
   <h2 style="padding: 20px;border-radius:10px;color:green">QUẢN LÝ ẢNH CHi TIẾT</h2>
   <h3 style="font-size: 12px;color:red">
      <?php if (!empty($validate['error']))
               echo $validate['error']; ?>
   </h3>
   <form class="input" style="width: 100%;" method="post" enctype="multipart/form-data">

      <label for=""><b>Chọn sản phẩm</b></label><br>
      <select class="form-select" name="id" aria-label="Default select example">
         <option selected>Open this Product</option>
         <?php
  
  foreach ($data as $key ) {
   ?>
         <option value="<?php echo $key['id'] ?>"><?php echo $key['productname'] ?></option>

         <?php
  }
  ?>
      </select>
      <label for=""><b>Chọn ảnh</b></label><br>
      <input type="file" name="files[]" multiple>

      <div class="" style="width: 100px;">
         <label for=""><b>Chọn Màu</b></label><br>
         <input type="color" name="color">

      </div>
      <div class="button">


         <button type="submit" name="btn">Thêm mới</button>



         <button>Nhập lại</button>
         <button type="submit" name="btnlist">Danh sách</button>
      </div>

</div>

</form>

</div>

</div>