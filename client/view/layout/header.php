<?php
ob_start();
session_start();
include '../PHPMailer-master/src/Exception.php';
include '../PHPMailer-master/src/PHPMailer.php';
include '../PHPMailer-master/src/SMTP.php';
$datafender = selectAll($conn, "SELECT * FROM `tbl_product` where category_id = 12 LIMIT 4");

$databang = selectAll($conn, "SELECT * FROM `tbl_product` where category_id = 13 LIMIT 4");



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Khởi tạo đối tượng PHPMailer
$mail = new PHPMailer(true);
// random mật khẩu 
function generateRandomString($length)
{
    $bytes = random_bytes($length);
    return bin2hex($bytes);
}
$err=array();
if (isset($_POST['btn'])) {
    $email = $_POST['email'];
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if(preg_match($pattern, $email)){
       $name = $_POST['name'];
   
    $checkuser = selectAll($conn,"SELECT * FROM `tbl_custumer` where email='$email'");
   
   if(!empty($checkuser)){
      $err["text"] = "Email đã tồn tại";
       $err["color"] = "red";


   }else{
       $randomString = generateRandomString(3);
    try {
        // Cấu hình thông tin mail server
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tucaph30153@fpt.edu.vn';
        $mail->Password = 'jasyignlxlxtlpgn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom('tucaph30153@fpt.edu.vn', 'Snake Sound');
        $mail->addAddress($email, 'name');

        // Thiết lập tiêu đề và nội dung email
        $mail->Subject = 'SnakeShould';
        $mail->Body = "
       
        Chào mừng bạn đến SnakeSound.
        Đây là mật khẩu của bạn:$randomString";

        // Gửi email
        $mail->send();
        $sql = "INSERT INTO `tbl_custumer`( `password`, `name`, `email`, `active`, `role`) VALUES ('$randomString','$name','$email','1','1')";
        insert($conn, $sql);
          $err["text"] = "Bạn đã đăng ký thành công. <br> Bạn vui lòng vào Email để lấy mật khẩu.";
       $err["color"] = "green";



    } catch (Exception $e) {
        echo "<script>alert('Email không đúng định dạng$mail->ErrorInfo')</script>";
    }

   }
    }else{
      $err['text'] = "Email không đúng định dạng";
       $err['color'] = "orange";
    }
   
   
}

if (isset($_POST['btn-login'])) {
    $email = $_POST['email'];
      $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
      if(preg_match($pattern, $email)){
         $password = $_POST['password'];

      $sql_login = "SELECT * FROM `tbl_custumer` where email='$email' and password='$password'";
      $data = selectAll($conn, $sql_login);
      if(!empty($data)){
         if (!empty($data)) {
           $section = json_encode($data[0]);
           $_SESSION['data'] = $section;
           $err['text'] = "Bạn đã đăng nhập thành công";
       $err['color'] = "green";

      }else{
          $err['text'] = "Tên tài khoản hoặc mật khẩu không chính xác";
       $err['color'] = "red";
      }


    }

      }else{
           $err['text'] = "Email không đúng định dạng";
       $err['color'] = "orange";
      }
    
}
if (isset($_SESSION['data'])) {
    $check = $_SESSION['data'];
    $check = json_decode($check, true);

}

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

if(isset($_POST['btn-logout'])){
    unset($_SESSION['data']);
    $check = null;
    $err['text'] = "Bạn đã đăng Xuất thành công";
       $err['color'] = "green";
       
}
if(isset($_POST['btn-search-order'])){
   $search = $_POST['searchorder'];
   header("Location:index.php?url=allorder&ordercode=$search");
}

if(isset($_POST['btn-search'])){
   $search = $_POST['search'];
   header("Location:index.php?url=search&search=$search");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Client</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pure-css-pagination@1.2.0/dist/pagination.min.css">


   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
   </script>

   <script>
   function showToast() {
      // Sử dụng hàm toastify để hiển thị thông báo Toast
      Toastify({
         text: "This is a toast message",
         backgroundColor: "#333",
         textColor: "#fff",
         duration: 3000
      }).showToast();
   }
   </script>
   <style>
   .w-\[50px\] {
      width: 42px !important;
   }

   .menu ul li a {
      display: block;
      transition: all 0.3s ease-in-out;
   }

   .menu ul li:hover a {
      transform: scale(1.1);
      color: red;
   }

   .image-zoom {
      overflow: hidden;
   }

   .image-zoom a img {
      display: block;
      transition: all 0.3s ease-in-out;
   }

   .image-zoom a:hover img {
      transform: scale(1.1);
   }

   .image-zoom a {
      position: relative;
      display: block;
   }

   .image-zoom a .name-category {
      position: absolute;
      color: white;
      font-weight: bold;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-size: 14px;
      bottom: 0px;
      left: 50%;
      transform: translateX(-50%);
      transition: all 0.3s ease-in-out;
   }

   .image-zoom a:hover .name-category {
      bottom: 40%;
   }

   .product-items a img {
      transition: all 0.3s ease-in-out;
   }

   .product-items a:hover img {
      transform: scale(1.1);
      display: block;
   }

   .login-form {
      position: absolute;
      top: 150px;
      left: 400px;

   }

   .modal-open {
      transition: all .5s;
      opacity: 0;
      transform: scale(.8);
      pointer-events: none;


   }

   .modal-user {
      transition: all .5s;
      opacity: 0;
      transform: scale(.8);
      pointer-events: none;
   }

   .modal-open i {
      position: absolute;
      top: 20px;
      right: 20px;
      color: red;
      font-size: 20px;
   }


   .active {
      opacity: 1;
      transform: scale(1);
      transition: all .5s;
      box-shadow: 0 0 10px grey;
      pointer-events: all;
   }

   .cart-count {
      position: absolute;
      right: 0;
      top: 50%;
      width: 20px;
      height: 20px;
      background: red;
      text-align: center;
      border-radius: 50%;
      line-height: 1.2;
      color: white;
   }

   .user {
      position: fixed;
      top: 64px;
      right: 280px;
   }

   .search_order {

      border: 1px solid grey;
      padding: 10px;
   }

   .search_order input {
      outline: none;
      border: none;

   }

   .search input {
      outline: none;
      height: 33px;
      border-radius: 5px;
   }

   .search input::placeholder {
      padding-left: 20px;
   }
   </style>
</head>


<body>
   <div class="">
      <div class="header  sticky top-[0px] z-10">
         <div class="modal-open login-form w-[728px] flex justify-between bg-[white] border-2 p-[16px] ">
            <i class="fa-solid fa-xmark"></i>
            <div class="login-left mx-[16px]">
               <form action="" method="post">
                  <h1 class="font-bold text-[24px] mb-[16px] my-[8px]">Đăng Nhập</h1>
                  <label class="font-bold mb-[10px] my-[8px]" for=""> Địa Chỉ Email</label> <br>
                  <input class="border boder-[grey] w-[300px] my-[8px]" type="text" name="email" id=""> <br>
                  <label class="font-bold mb-[10px] my-[8px]" for="">Mật Khẩu</label> <br>
                  <input class="border boder-[grey] w-[300px] my-[8px]" type="password" name="password"> <br>
                  <input type="checkbox" name="" id=""> Ghi nhớ mật khẩu? <br>
                  <button class="oke bg-[black] text-[white] text-[20px] w-[120px] my-[8px]" type="submit"
                     name="btn-login">Đăng Nhập</button> <br>
                  <a href=" ">Quên Mật Khẩu</a>
               </form>
            </div>
            <div class=" login-right mx-[16px] ">
               <form method="post">
                  <h1 class=" font-bold text-[24px] mb-[16px] my-[8px] ">Đăng Kí</h1>
                  <label class=" font-bold mb-[10px] my-[8px] " for=" ">Nhập Địa Chỉ Email</label><br>
                  <input class=" border boder-[grey] w-[300px] my-[8px] " type=" email" name="email" id=" "> <br>
                  <label class=" font-bold mb-[10px] my-[8px] " for=" ">Tên người dùng</label><br>
                  <input class=" border boder-[grey] w-[300px] my-[8px] " type=" text" name="name" id=" "> <br>
                  <span class=" font-bold ">Một mật khẩu sẽ được gửi đến địa chỉ email của bạn</span> <br>
                  <p>Thông tin cá nhân của bạn sẽ được sử dụng để tăng trải nghiệm sử dụng website, quản lý truy
                     cập vào
                     tài khoản của bạn, và cho các mục đích cụ thể khác được mô tả trong chính sách riêng tư.</p>
                  <button type="submit" class="oke bg-[black] text-[white] text-[20px] w-[120px] my-[8px] "
                     name="btn">Đăng
                     Kí</button>
               </form>
            </div>
         </div>
         <div class="modal-user user w-[200px] flex justify-between bg-[white] border-2 p-[16px] ">
            <form action="" method="post">
               <ul class="cursor-pointer">
                  <li class="flex items-center gap-[10px] my-[10px]"><i class="fa-regular fa-id-badge"></i>
                     <p>Profile</p>
                  </li>
                  <li class="flex items-center gap-[10px] my-[10px]"><i class="fa-solid fa-key"></i>
                     <p>Change Password</p>
                  </li>
                  <li class="flex items-center gap-[10px] my-[10px]"><i
                        class="fa-solid fa-arrow-right-from-bracket"></i>
                     <button class="oke" type="submit" name="btn-logout">Logout</button>
                  </li>
               </ul>

            </form>

         </div>
         <div class=" flex justify-center bg-[white]">
            <div class="support w-[1250px]   flex justify-between items-center ">

               <div class="logo w-[120px] ml-[40px]">
                  <img src="../image/snake_sound-removebg-preview.png" alt="">
               </div>
               <form method="post" class="search_order">
                  <input type="text" name="searchorder" placeholder="Tra cứu đơn hàng">
                  <button type="submit" name="btn-search-order"><i class="fa-solid fa-magnifying-glass"></i></button>
               </form>
               <div class="flex items-center gap-[30px]">

                  <div class="support-icon">
                     <img class="w-[50px]" src="../image/icon-tu-van.webp" alt="">
                  </div>
                  <div class="support-title">
                     <span>Hỗ trợ 24/7</span> <br>
                     <span class="text-[red]">0973.1188.35</span>
                  </div>
                  <?php
                  if(!empty($check)){
                     ?>
                  <a href="index.php?url=allorder">
                     <div class="donhang flex items-center gap-[8px]">
                        <span>Đơn hàng</span>
                        <i class="fa-solid fa-truck-fast"></i>
                     </div>
                  </a>

                  <?php
                  }
                  ?>

                  <?php
                        if (!empty($check)) {
                            ?>
                  <div class="profile  flex">
                     <span>Hello
                        <?php echo $check['name'] ?>
                     </span>
                     <i class="fa-regular fa-user flex justify-between items-center ml-[16px]"></i>
                  </div>

                  <?php
                        } else {

                            ?>
                  <div class="open login  flex">
                     <span>Đăng nhập / Đăng ký </span>
                     <i class="fa-regular fa-user flex justify-between items-center ml-[16px]"></i>
                  </div>
                  <?php
                        }

                        ?>
                  <div class="cart-title ">
                     <span> Giỏ hàng</span>

                  </div>
                  <a href="index.php?url=cart">
                     <div class="cart-icon relative">
                        <img class="w-[50px]" src="../image/icon-gio-hang.webp" alt="">
                        <?php
                                if (!empty($cart)) {
                                    ?>
                        <p class="cart-count">
                           <?php echo count($cart) ?>
                        </p>
                        <?php
                                } else {
                                    ?>
                        <p class="cart-count">0</p>
                        <?php
                                }

                                ?>

                     </div>
                  </a>

               </div>
            </div>

         </div>
         <div class="navbar flex justify-between items-center bg-[black]  h-[50px] ">
            <div class="menu flex justify-between items-center ml-[165px]">
               <ul class="flex justify-between gap-[24px]">
                  <li class="text-white ">
                     <a href="index.php">Trang Chủ</a>
                  </li>
                  <li class="text-white ">
                     <a href="gioithieu.html">Giới Thiệu</a>
                  </li>
                  <li class="text-white ">
                     <a href="baohanh.html">Bảo Hành</a>
                  </li>
                  <li class="text-white ">
                     <a href="contact.html">Liên Hệ</a>
                  </li>
               </ul>
            </div>
            <form method="post" class="search flex justify-between mr-[100px] items-center ">
               <input class="w-[400px]" type="text"
                  style="box-shadow: inset 2px 2px 5px #BABECC, inset -5px -5px 10px #FFF;" name="search" id=""
                  placeholder="Tìm kiếm sản phẩm, danh, mục...">
               <button type="submit" name="btn-search"><img class=" w-[50px]" src="../image/icon-search.png"
                     alt=""></button>
            </form>
         </div>
      </div>
      <script>
      let oke = document.querySelector(".oke");
      oke.addEventListener("click", showToast());

      function showToast() {
         // Sử dụng hàm toastify để hiển thị thông báo Toast

         Toastify({
            text: '<?php echo $err['text'] ?>',
            backgroundColor: '<?php echo $err['color'] ?>',
            textColor: "#fff",
            duration: 3000,
            escapeMarkup: false
         }).showToast();
      }
      </script>