<?php

error_reporting(0);
if(isset($_POST['btn'])){
    $dir = "../image/";
       $up_file = $dir . $_FILES['anh']['name'];
       if (move_uploaded_file($_FILES['anh']['tmp_name'], $up_file)) {
          
       }
       

      $makh= $_POST['makh'];
      $name= $_POST['name'];
       $password1= $_POST['password1'];
       $password2= $_POST['password2'];
       $email= $_POST['email'];
       $kichhoat= $_POST['kichhoat'];
       $vaitro= $_POST['vaitro'];
         $err=[];
       if($makh===''){
         $err['makh'] = "Mã khách hàng không được bỏ trống.";
       }
       
       if($name===''){
         $err['name'] = "Họ và tên không được bỏ trống";
       }
       
       if($email===''){
         $err['email'] = "Email không được bỏ trống";
        
         
       }else  if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)){
            $err['email'] = "Email không đúng định dạng";
         }
    
       if($password1===''&&$password2===''){
          $err['password'] = "mật khẩu không được để trống";
          
         
       }else  if(strlen($password1)<3){
         $err['password'] = "Mật khẩu ít nhất 3 ký tự.";
       }else if(!($password1===$password2)){
               $err['password'] = "mật khẩu phải trúng khớp";
          }
       if(empty($err)){

          insert($conn,"INSERT INTO `tbl_custumer`(`makh`, `password`, `name`, `image`, `email`, `active`, `role`) VALUES ('$makh','$password2','$name','$up_file','$email','$kichhoat','$vaitro')");
    }
      }


if(isset($_GET['id'])){
   $id = $_GET['id'];
   $data = selectAll($conn,"SELECT * FROM `tbl_custumer` where makh='$id'");


  
}

if(isset($_POST["btnupdate"])){

    $makh= $_POST['makh'];
      $name= $_POST['name'];
       $email= $_POST['email'];
       $kichhoat= $_POST['kichhoat'];
       $vaitro= $_POST['vaitro'];
  
   updatedata($conn,"UPDATE `tbl_custumer` SET `makh`='$makh',`name`='$name',`email`='$email',`active`='$kichhoat',`role`='$vaitro' WHERE makh='$id'");
   header("location:index.php?url=listcustumer");
}
if(isset($_POST["btnlist"])){
   header("location:index.php?url=listcustumer");
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


<div class="wrapper" style="width:70%">
   <h2 style="padding: 20px; border-radius:10px;color:green">QUẢN LÝ KHÁCH HÀNG</h2>
   <form class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>

      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Mã khách hàng</label>
         <input type="text" class="form-control" name="makh" value="<?php if(!empty($data)) echo $data[0]['makh'] ?>"
            id="validationCustom03" required>
         <div style="color:red">
            <?php if(!empty($err['makh'])) echo $err['makh']; ?>
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Họ và Tên</label>
         <input type="text" class="form-control" name="name" value="<?php if(!empty($data)) echo $data[0]['name'] ?>"
            id="validationCustom03" required>
         <div style="color:red">
            <?php if(!empty($err['name'])) echo $err['name']; ?>
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Mật khẩu</label>
         <input type="password" class="form-control" name="password1"
            value="<?php if(!empty($data)) echo $data[0]['password'] ?>" <?php if(!empty($data)) echo "disabled" ?>
            id="validationCustom03" required>
         <div style="color:red">
            <?php if(!empty($err['password'])) echo $err['password']; ?>
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Xác nhận mật khẩu</label>
         <input type="password" class="form-control" name="password2"
            value="<?php if(!empty($data)) echo $data[0]['password'] ?>" <?php if(!empty($data)) echo "disabled" ?>
            id="validationCustom03" required>
         <div style="color:red">
            <?php if(!empty($err['password'])) echo $err['password']; ?>
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Địa chỉ Email</label>
         <input type="text" class="form-control" name="email" value="<?php if(!empty($data)) echo $data[0]['email'] ?>"
            id="validationCustom03" required>
         <div style="color:red">
            <?php if(!empty($err['email'])) echo $err['email']; ?>
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Hình ảnh</label>
         <input type="file" class="form-control" name="anh" id="validationCustom03" required>
         <div class="invalid-feedback">
            Please provide a valid city.
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Kích hoạt</label>
         <div class="check">
            <div class="form-check form-check-inline">
               <input class="form-check-input" name="kichhoat"
                  <?php if(!empty($data)&&$data[0]['active']==1) echo "checked" ?> type="radio" value="1">
               <label class="form-check-label" for="inlineCheckbox1">Chưa kích hoạt</label>
            </div>
            <div class="form-check form-check-inline">
               <input class="form-check-input" name="kichhoat" type="radio"
                  <?php if(!empty($data)&&$data[0]['active']==2) echo "checked" ?> value="2">
               <label class="form-check-label" for="inlineCheckbox2">Kích hoạt</label>
            </div>
         </div>
         <div class="invalid-feedback">
            Please provide a valid city.
         </div>
      </div>
      <div class="col-md-6">
         <label for="validationCustom03" class="form-label">Vai trò</label>
         <div class="check">
            <div class="form-check form-check-inline">
               <input class="form-check-input" name="vaitro"
                  <?php if(!empty($data)&&$data[0]['role']==1) echo "checked" ?> type="radio" value="1">
               <label class="form-check-label" for="inlineCheckbox1">Khách hàng</label>
            </div>
            <div class="form-check form-check-inline">
               <input class="form-check-input" name="vaitro"
                  <?php if(!empty($data)&&$data[0]['role']==2) echo "checked" ?> type="radio" value="2">
               <label class="form-check-label" for="inlineCheckbox2">Nhân viên</label>
            </div>
         </div>
         <div class="invalid-feedback">
            Please provide a valid city.
         </div>
      </div>
      <div class="button">
         <?php if(!empty($data)) {
                  ?>

         <button name="btnupdate">Update</button>

         <?php
               }else{
                  ?>
         <button name="btn">Thêm mới</button>
         <?php
               } ?>
         <button>Nhập lại</button>
         <button type="submit" name="btnlist">Danh sách</button>
      </div>



   </form>
</div>

</div>