<?php

$data = selectAll($conn,"SELECT * FROM `tbl_category`");
error_reporting(0);

if(isset($_POST['btn'])){
    $dir = "../image/";
       $up_file = $dir . $_FILES['anh']['name'];
       if (move_uploaded_file($_FILES['anh']['tmp_name'], $up_file)) {
          
       }

      $name= $_POST['name'];
      $dongia= $_POST['dongia'];
       $giamgia= $_POST['giamgia'];
       $loai= $_POST['loai'];
       $radio= $_POST['radio'];
       $date= $_POST['date'];
       $soluong= $_POST['quantity'];
       $luotxem= 0;
       $des= $_POST['des'];

       $err = [];
       if($name===''){
         $err['name'] = "Không được để trống tên hàng hóa.";
       }
      
       if($dongia===''){
         $err['dongia'] = "Không được để trống đơn giá.";
       }else if(!($dongia>=0)){
             $err['dongia'] = "Đơn giá phải là số dương.";
       }
        if($giamgia===''){
         $err['giamgia'] = "Không được để trống giảm giá.";
       }else if(!($dongia>0)){
             $err['giamgia'] = "Giảm giá phải là từ 0 trở lên.";
       }
       if(!($soluong>0)){
         $err['quantity'] = "Số lượng phải là từ 0 trở lên.";
   }
        if(!($date>date("Y-m-d"))){
         $err['date'] = "phải lớn hơn ngày hiện tại";
       }
       if(empty($err)){

          insert($conn,"INSERT INTO `tbl_product`( `productname`, `image`, `price`, `saleprice`, `category_id`, `date`, `description`, `status`, `viewer`) VALUES ('$name','$up_file','$dongia','$giamgia','$loai','$date','$des','$radio','$luotxem')");
    }
       }

if(isset($_GET['id'])){
   $id = $_GET['id'];
   $dataupdate = selectAll($conn,"SELECT * FROM `tbl_product` where id=$id");


  
}

if(isset($_POST["btnupdate"])){

   $name= $_POST['name'];
      $dongia= $_POST['dongia'];
       $giamgia= $_POST['giamgia'];
       $loai= $_POST['loai'];
       $radio= $_POST['radio'];
       $date= $_POST['date'];
       $luotxem= 0;
       $des= $_POST['des'];
  
   updatedata($conn,"UPDATE `tbl_product` SET `productname`='$name',`price`='$dongia',`saleprice`='$giamgia',`category_id`='$loai',`date`='$date',`description`='$des',`status`='$radio',`viewer`='$luotxem' WHERE id=$id");
   header("location:index.php?url=listproduct");
}

if(isset($_POST["btnlist"])){
   header("location:index.php?url=listproduct");
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

.check {
   border: 1px solid grey;

   border-radius: 5px;
   display: flex;
   align-items: center;
   justify-content: center;
   height: 37px;
}
</style>



<div class="wrapper" style="margin-top:20px;width:70%">

   <h2 style="padding: 20px; border-radius:10px;color:green">QUẢN LÝ HÀNG HÓA</h2>
   <form class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>
      <div class="col-md-4">
         <label for="validationCustom01" class="form-label">Mã hàng hóa</label>
         <input type="text" class="form-control" id="validationCustom01"
            value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['id'] ?>" placeholder="Auto Number" disabled
            required>
         <div class="valid-feedback">
            Looks good!
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustom02" class="form-label">Tên hàng hóa</label>
         <input type="text" class="form-control" name="name"
            value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['productname'] ?>" id="validationCustom02"
            required>
         <div style="color:red">
            <?php if(!empty($err['name'])) echo $err['name']; ?>
         </div>
      </div>
      <div class="col-md-4">
         <label class="form-label">Đơn giá</label>
         <div class="input-group has-validation">

            <input type="number" class="form-control" name="dongia"
               value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['price'] ?>" id="validationCustom02" required>
         </div>
         <div style="color:red">
            <?php if(!empty($err['dongia'])) echo $err['dongia']; ?>
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustom01" class="form-label">Giảm giá</label>
         <input type="number" class="form-control" name="giamgia"
            value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['saleprice'] ?>" id="validationCustom01" required>
         <div style="color:red">
            <?php if(!empty($err['giamgia'])) echo $err['giamgia']; ?>
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustom01" class="form-label">Số lượng</label>
         <input type="number" class="form-control" name="quantity"
            value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['quantity'] ?>" id="validationCustom01" required>
         <div style="color:red">
            <?php if(!empty($err['quantity'])) echo $err['quantity']; ?>
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustom02" class="form-label">Ảnh hàng hóa</label>
         <input type="file" class="form-control" name="anh" aria-label="file example" required>
         <div class="valid-feedback">
            Không được để trống!
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustomUsername" class="form-label">Loại hàng</label>
         <div class="input-group has-validation">

            <select class="form-select" name="loai" aria-label="Default select example">
               <option>...Chọn Loại Hàng....</option>

               <?php
                     foreach ($data as $key ) {
                       ?>
               <option <?php if(!empty($dataupdate)&&$dataupdate[0]['category_id']==$key['id']) echo "selected" ?>
                  value="<?php echo $key['id'] ?>"><?php echo $key['categoryname'] ?></option>

               <?php
                     }
                     
                     ?>

            </select>
            <div class="invalid-feedback">
               Không được để trống!
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustom01" class="form-label">Hàng đạc biệt</label>
         <div class="check">
            <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="radio"
                  <?php if(!empty($dataupdate)&&$dataupdate[0]['status']==1) echo "checked" ?> id="inlineCheckbox1"
                  value="1">
               <label class="form-check-label" for="inlineCheckbox1">Đặc biệt</label>
            </div>
            <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="radio"
                  <?php if(!empty($dataupdate)&&$dataupdate[0]['status']==2) echo "checked" ?> id="inlineCheckbox2"
                  value="2">
               <label class="form-check-label" for="inlineCheckbox2">Bình thường</label>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <label for="validationCustom02" class="form-label">Ngày nhập </label>
         <input type="date" class="form-control" value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['date'] ?>"
            name="date" id="validationCustom01" required>
         <div style="color:red">
            <?php if(!empty($err['date'])) echo $err['date']; ?>
         </div>
      </div>
      <div class="col-md-4" hidden>
         <label for="validationCustomUsername" class="form-label">Số lượt xem </label>
         <div class="input-group has-validation">

            <input type="number" class="form-control"
               value="<?php if(!empty($dataupdate)) echo $dataupdate[0]['viewer'] ?>" name="luotxem" value="0"
               id="validationCustom01" disabled required>
            <div class="invalid-feedback">
               Không được để trống!
            </div>
         </div>
      </div>
      <div class="form-floating">

         <textarea id="basic-example" class="form-control" name="des" placeholder="Leave a comment here"
            id="floatingTextarea">
                <?php if(!empty($dataupdate)) echo $dataupdate[0]['description'] ?>
               </textarea>

      </div>
      <div class="button">

         <?php if(!empty($dataupdate)) {
                  ?>

         <button name="btnupdate">Update</button>

         <?php
               }else{
                  ?>
         <button name="btn" onclick="alert('Bạn đã thêm thành công')">Thêm mới</button>
         <?php
               } ?>
         <button>Nhập lại</button>
         <button type="submit" name="btnlist">Danh sách</button>
      </div>
   </form>

</div>

</div>


<script>
tinymce.init({
   selector: 'textarea#basic-example',
   height: 200,
   plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount'
   ],
   toolbar: 'undo redo | blocks | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
   content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
</script>