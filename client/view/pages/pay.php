<?php




if (isset($_SESSION['cart'])) {
   $cart = $_SESSION['cart'];
}

$err = array();
if (isset($_POST['btn-order'])) {

   $arr = array();
   if (!isset($_SESSION['order'])) {
      $_SESSION['order'] = $arr;

   }
   $pattern = '/^(\+\d{1,3}\s?)?(\(\d{1,}\))?\s?[\d\- ]{5,}$/';
   $patternemail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

   $username = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['thon'] . "-" . $_POST['xa'] . "-" . $_POST['huyen'] . "-" . $_POST['tinh'];


   if ($username == "") {
      $err['name'] = "Không được để trống";
   }

   if ($email == "") {
      $err['email'] = "Không được để trống";
   } else if (preg_match($patternemail, $email)) {

   } else {
      $err['email'] = "Email không đúng định dạng";
   }

   if ($phone == "") {
      $err['phone'] = "Không được để trống";

   } else if (preg_match($pattern, $phone)) {

   } else {
      $err['phone'] = "Không đúng định dạng số điện thoại";
   }

   if ($_POST['thon'] == "") {
      $err['thon'] = "Không được để trống";
   }
   if ($_POST['xa'] == "") {
      $err['xa'] = "Không được để trống";
   }
   if ($_POST['huyen'] == "") {
      $err['huyen'] = "Không được để trống";
   }
   if ($_POST['tinh'] == "") {
      $err['tinh'] = "Không được để trống";
   }


   if (empty($err)) {
      $codeorder = array();
      foreach ($cart as $key) {
         $randomString = generateRandomString(2);

         $product = array(
            'id' => $key['id'],
            'codeorder' => $randomString,
            'name' => $key['name'],
            'username' => $username,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'price' => $key['price'],
            'priceone' => $key['priceone'],
            // Giá sản phẩm
            'quantity' => $key['quantity'],
            // Số lượng sản phẩm
            'image' => $key['image'] // Đường dẫn ảnh sản phẩm
         );

         array_push($arr, $product);
         array_push($codeorder, $randomString);
      }

      $str = "";
      $queryString = http_build_query($codeorder);
      foreach ($arr as $key) {
         $name = $key['name'];
         $quantity = $key['quantity'];
         $tong = $key['priceone'] * $key['quantity'];
         $price = number_format($tong, 0, ',', '.') . '₫';

         $str = $str . "<tr>
            <td>" . $key['codeorder'] . "</td>
            <td>" . $name . "</td>
            <td>" . $quantity . "</td>
             <td>" . $price . "</td>
         </tr>";
      }

      try {
         $_SESSION['order'] = $arr;
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
         $mail->isHTML(true);
         $mail->Body = "
        <h1>Bạn vui lòng xác nhận đơn hàng .</h1>
        
        Đây là thông tin đơn hàng của bạn:<br>
        <table style=' font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;'>
         <tr style=' border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>
            <th>Mã Đơn hàng </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Tổng</th>
         </tr>
        " . $str . "

      </table>
        Bạn vui lòng bấm vào đây để xác nhận đơn hàng <a href='http://localhost/duan1tktw/client/index.php?url=order-detail&" . $queryString . "'>Click Here</a>
        "
         ;

         // Gửi email
         $mail->send();
         header("Location:index.php?url=order-check");



      } catch (Exception $e) {
         echo "<script>alert('Email không đúng định dạng$mail->ErrorInfo')</script>";
      }
   }




}
ob_end_flush();

?>
<style>
.login-form {
   position: absolute;
   top: 150px;
   left: 400px;
}

.modal-open {
   transition: all .5s;
   opacity: 0;
   transform: scale(.8);


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
}
</style>
<a href="index.php">
   <div class="back mx-[120px] mt-[32px]">
      <i class="fa-solid fa-arrow-left "> Quay Lai</i>
   </div>
</a>

<div class="pay flex justify-center mx-[auto]">

   <div class="box-pay border-2 border-[grey] w-[1220px] mt-[48px]">
      <?php
      $tongall = 0;
      foreach ($cart as $key) {
         $tong = $key['priceone'] * $key['quantity'];
         $tongall += $tong;

         $price1 = number_format( $tong, 0, ',', '.') . '₫';
        
         ?>
      <div>
         <div class="box-items flex justify-between items-center   ">
            <div class="image w-[83px] h-[83px] mx-[16px] mt-[16px]">
               <img src="<?php echo $key['image'] ?>" alt="">
            </div>
            <div class="name-product mx-[16px] w-[250px]">
               <p class="font-bold">
                  <?php echo $key['name'] ?>
               </p>
            </div>
            <div class="add-quantity flex mx-[16px]">

               <p class="border-2 border-[grey] px-[4px] w-[105px]"> <span class="font-bold">Quantity:</span>
                  <?php echo $key['quantity'] ?>
               </p>

            </div>
            <div class="price mx-[16px] w-[150px]">
               <p> <span class="font-bold">Price:</span>
                  <?php echo $price1 ?>
               </p>
            </div>

         </div>
         <div class="line-color p-[16px]">
            <hr>
         </div>

      </div>


      <?php
      }

      ?>


      <div class="sum flex justify-end p-[16px]">
         <p><b>Tổng ( <?php echo count($cart) ?>) sản phẩm: </b> <span class="text-[red] text-[20px]">
               <?php echo  number_format( $tongall, 0, ',', '.') . '₫' ?>
            </span></p>
      </div>
   </div>
</div>
<div class=" mx-[120px] mt-[32px]">
   <h3 class="font-bold text-[20px]">Thông tin khách hàng</h3>
</div>
<form method="POST" action="">
   <div class=" flex justify-center mx-[auto] border-2 border-[grey] w-[1220px] mt-[16px] ">
      <div class="grid grid-cols-2 gap-4">
         <div class="w-[600px] p-[16px]">
            <label for="">Họ và tên </label> <br>
            <input class="p-[10px]" type="text" name="name" value="<?php if (isset($_POST['name'])) {
               echo $_POST['name'];
            } else {
               echo "";
            } ?>" id="" placeholder="Nguyen Van A">
            <hr>
            <?php if (!empty($err['name'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['name'] ?>
            </p>
            <?php
            } ?>
         </div>
         <div class="w-[600px] p-[16px] grid grid-colum ">
            <label for="">Số điện thoại</label>
            <input class="p-[10px]" type="text" name="phone" value="<?php if (isset($phone)) {
               echo $phone;
            } else {
               echo "";
            } ?>" id="" placeholder="0123456789">

            <hr>
            <?php if (!empty($err['phone'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['phone'] ?>
            </p>
            <?php
            } ?>

         </div>
         <div class="w-[1220px] p-[16px] grid grid-colum ">
            <label for="">Email</label>
            <input class="p-[10px]" type="email" name="email" id="" value="<?php if (isset($email)) {
               echo $email;
            } else {
               echo "";
            } ?>" placeholder="abc@gmail.com">
            <hr>
            <?php if (!empty($err['email'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['email'] ?>
            </p>
            <?php
            } ?>
         </div>
      </div>
   </div>
   <div class=" mx-[120px] mt-[32px]">
      <h3 class="font-bold text-[20px]">Yêu cầu nhận hàng</h3>
   </div>
   <div class=" flex justify-center mx-[auto] border-2 border-[grey] w-[1220px] mt-[16px] ">
      <div class="grid grid-cols-2 gap-4">
         <div class="w-[600px] p-[16px]">
            <label for="">Tỉnh/Thành phố </label> <br>
            <input class="p-[10px]" type="text" name="tinh" id="" value="<?php if (isset($_POST['tinh'])) {
               echo $_POST['tinh'];
            } else {
               echo "";
            } ?>" placeholder="Tỉnh/Thành phố ">
            <hr>
            <?php if (!empty($err['tinh'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['tinh'] ?>
            </p>
            <?php
            } ?>
         </div>
         <div class="w-[600px] p-[16px] grid grid-colum ">
            <label for="">Quận/Huyện</label>
            <input class="p-[10px]" type="text" name="huyen" id="" value="<?php if (isset($_POST['huyen'])) {
               echo $_POST['huyen'];
            } else {
               echo "";
            } ?>" placeholder="Quận/Huyện">
            <hr>
            <?php if (!empty($err['huyen'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['huyen'] ?>
            </p>
            <?php
            } ?>
         </div>
         <div class="w-[600px] p-[16px] grid grid-colum ">
            <label for="">Phường/Xã</label>
            <input class="p-[10px]" type="text" name="xa" id="" value="<?php if (isset($_POST['xa'])) {
               echo $_POST['xa'];
            } else {
               echo "";
            } ?>" placeholder="Phường/Xã">
            <hr>
            <?php if (!empty($err['xa'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['xa'] ?>
            </p>
            <?php
            } ?>
         </div>
         <div class="w-[600px] p-[16px] grid grid-colum ">
            <label for="">Đường/Thôn xóm</label>
            <input class="p-[10px]" type="text" name="thon" id="" value="<?php if (isset($_POST['thon'])) {
               echo $_POST['thon'];
            } else {
               echo "";
            } ?>" placeholder="Đường/Thôn xóm">
            <hr>
            <?php if (!empty($err['thon'])) {
               ?>
            <p class="text-[red]">
               <?php echo $err['thon'] ?>
            </p>
            <?php
            } ?>
         </div>
      </div>
   </div>
   <div class="w-[1220px] mx-[auto] flex justify-end">
      <button type="submit" name="btn-order"
         class="w-[260px] h-[45px] bg-[#006e96] text-white border rounded-md mt-[16px] mb-[32px]">Tiếp
         Tục</button>
   </div>

</form>
<div class="modal-open login-form w-[728px] flex justify-between bg-[white] border-2 p-[16px] ">
   <i class="fa-solid fa-xmark"></i>
   <div class="login-left mx-[16px]">
      <div>
         <h1 class="font-bold text-[24px] mb-[16px] my-[8px]">Đăng Nhập</h1>
         <label class="font-bold mb-[10px] my-[8px]" for="">Tên Tài Khoản Hoặc Địa Chỉ Email</label> <br>
         <input class="border boder-[grey] w-[300px] my-[8px]" type="text" name="" id=""> <br>
         <label class="font-bold mb-[10px] my-[8px]" for="">Mật Khẩu</label> <br>
         <input class="border boder-[grey] w-[300px] my-[8px]" type="password"> <br>
         <input type="checkbox" name="" id=""> Ghi nhớ mật khẩu? <br>
         <button class=" bg-[black] text-[white] text-[20px] w-[120px] my-[8px] ">Đăng Nhập</button> <br>
         <a href=" ">Quên Mật Khẩu</a>
      </div>
   </div>
   <div class=" login-right mx-[16px] ">
      <div>
         <h1 class=" font-bold text-[24px] mb-[16px] my-[8px] ">Đăng Kí</h1>
         <label class=" font-bold mb-[10px] my-[8px] " for=" ">Nhập Địa Chỉ Email</label><br>
         <input class=" border boder-[grey] w-[300px] my-[8px] " type=" text " name=" " id=" "> <br>
         <span class=" font-bold ">Một mật khẩu sẽ được gửi đến địa chỉ email của bạn</span> <br>
         <p>Thông tin cá nhân của bạn sẽ được sử dụng để tăng trải nghiệm sử dụng website, quản lý truy cập
            vào tài khoản của bạn, và cho các mục đích cụ thể khác được mô tả trong chính sách riêng tư.</p>
         <button class=" bg-[black] text-[white] text-[20px] w-[120px] my-[8px] ">Đăng
            Kí</button>
      </div>
   </div>
</div>

</div>