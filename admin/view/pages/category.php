<?php

$datacategory = selectAll($conn, "SELECT * FROM `tbl_category`");
$validate = [];
if (isset($_POST["btn"])) {
   $category = $_POST["category"];
   if ($category === '') {
      $validate['error'] = "Danh mục không được để trống";
   } else {

      $flag = true;

      foreach ($datacategory as $key) {
         if ($key['categoryname'] === $category) {
            $flag = false;
         }
      }
      if (!$flag) {
         $validate['error'] = "Danh mục sản phẩm đã tồn tại";

      } else {
         insert($conn, "INSERT INTO `tbl_category`( `categoryname`) VALUES ('$category')");
      }
   }

}
if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $data = selectAll($conn, "SELECT * FROM `tbl_category` where id=$id");



}
if (isset($_POST["btnupdate"])) {

   $category = $_POST["category"];
   updatedata($conn, "UPDATE `tbl_category` SET `categoryname`='$category' WHERE id=$id");
   header("location:index.php?url=listcategory");
}
if (isset($_POST["btnlist"])) {
   header("location:index.php?url=listcategory");
}

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


<div class="wrapper" style="width:70%">
   <h2 style="padding: 20px; border-radius:10px;color:green">QUẢN LÝ LOẠI HÀNG</h2>
   <h3 style="font-size: 12px;color:red">
      <?php if (!empty($validate['error']))
               echo $validate['error']; ?>
   </h3>
   <form class="input" style="width: 100%;" method="post">
      <label for=""><b>Mã loại</b></label><br>
      <input type="text" placeholder="Auto Number" value="<?php if (!empty($data))
               echo $data[0]['id'] ?>" disabled>
      <br>
      <label for=""><b>Tên loại</b></label><br>
      <input type="text" name="category" value="<?php if (!empty($data))
               echo $data[0]['categoryname'] ?>">
      <div class="button">
         <?php
            if (!empty($data)) {
               ?>
         <button type="submit" name="btnupdate">Update</button>

         <?php
            } else {
               ?>
         <button type="submit" name="btn">Thêm mới</button>
         <?php
            }

            ?>
         <button>Nhập lại</button>
         <button type="submit" name="btnlist">Danh sách</button>
      </div>
   </form>

</div>

</div>