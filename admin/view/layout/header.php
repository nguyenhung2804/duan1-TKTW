<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <script src="../tinymce/js/tinymce/tinymce.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

   <title>Document</title>
   <style>
   .container {
      display: flex;
      justify-content: space-between;
      max-width: 100%;

   }

   .headeractive a {
      font-size: 20px;
      color: red !important;
   }

   .headermenu ul li {
      padding: 10px 20px;

   }

   .headermenu ul li a {
      color: black;
   }

   .headermenu {
      background-image: url('../image/bg.jpg');
      background-repeat: no-repeat;
      background-size: 100% 100%;
   }
   </style>

</head>

<?php 
error_reporting(0);
$query = $_GET['url'];
if(!isset($query)){
   $query = "home";
}


if(isset($_POST['btn-logout'])){
   unset($_SESSION['admin']);
   header("location:index.php");
}


?>

<body>
   <div class="container">
      <header style="width: 30%;">

         <div class="headermenu" style="display:flex; width: 90%;border-radius:10px;height:100vh">
            <ul style="display: block; margin:40px auto">
               <li><img src="../image/logo.png" alt=""></li>
               <li class="<?php if($query=="home") {echo "headeractive";}else{ echo "";} ?>"><a style="color:black;"
                     href="index.php">Trang chủ</a></li>
               <li class="<?php if($query=="category") {echo "headeractive";}else{ echo "";} ?>"><a style="color:black;"
                     href="index.php?url=category">Loại hàng </a></li>
               <li class="<?php if($query=="product") {echo "headeractive";}else{ echo "";} ?>"><a style="color:black;"
                     href="index.php?url=product">Hàng hóa </a></li>
               <li class="<?php if($query=="custumer") {echo "headeractive";}else{ echo "";} ?>"><a style="color:black;"
                     href="index.php?url=custumer">Khách hàng </a></li>
               <li class="<?php if($query=="order") {echo "headeractive";}else{ echo "";} ?>"><a style="color:black;"
                     href="index.php?url=order">Đơn hàng </a></li>
               <li class="<?php if($query=="comment") {echo "headeractive";}else{ echo "";} ?>"><a style="color:black;"
                     href="index.php?url=comment">Bình luận </a></li>
               <li class="<?php if($query=="statistical") {echo "headeractive";}else{ echo "";} ?>"><a
                     style="color:black;" href="index.php?url=statistical">Thống kê </a></li>
               <li class="<?php if($query=="detailimagecolor") {echo "headeractive";}else{ echo "";} ?>"><a
                     style="color:black;" href="index.php?url=detailimagecolor">Ảnh và màu </a></li>
               <li class="" style="padding: 0;">
                  <form method="post">
                     <button style="color:black; width:100%;" type="submit" name="btn-logout">Đăng Xuất</button>

                  </form>
               </li>



            </ul>
         </div>
      </header>