<?php

if (isset($_SESSION['order'])) {
   $order = $_SESSION['order'];
}

if (!empty($order)) {
   foreach ($order as $key) {
      $code = $key['codeorder'];
      $id = $key['id'];
      $username = $key['username'];
      $productname = $key['name'];
      $quantity = $key['quantity'];
      $address = $key['address'];
      $email = $key['email'];
      $phone = $key['phone'];
      $tong = $key['priceone'] * $key['quantity'];
      $image = $key['image'];

      updatedata($conn, "UPDATE `tbl_product` SET `quantity`=quantity- $quantity WHERE id=$id");
      insert($conn, "INSERT INTO `tbl_order`( `order_code`, `name`, `productname`, `quantity`, `sum`, `address`, `email`, `phone_number`,`image`) VALUES ('$code','$username','$productname','$quantity','$tong','$address','$email','$phone','$image')");


      unset($_SESSION['order']);
      unset($_SESSION['cart']);
   }
}


?>



<div class="back mx-[120px] mt-[32px]">
   <a href="index.php">
      <i class="fa-solid fa-arrow-left "> Quay Lai</i>
   </a>

</div>


<div class="container">

   <!-- logo -->
   <div class="checkout-done-logo d-flex justify-content-center m-5 align-content-center"><img src="img/logo 1.svg"
         alt=""></div>
   <div class="checkout-done flex ">


      <div class="checkout-done-infor w-[60%]">
         <!-- lời cảm ơn -->
         <div class="flex items-center mb-5">
            <div><i style="font-size: 80px; color:rgb(157, 193, 104);" class="fa-solid fa-circle-check"></i></div>
            <div class="thankyou-text text-[40px] font-bold ">
               <h1>Cảm ơn bạn đã </br> đặt hàng!
            </div>
         </div>
         <div class="checkout-infor-text">
            <div class="d-flex gap-5">
               <div class="checkout-infor-text-left">
                  <!-- thông tin vận chuyển -->
                  <div>
                     <h4 class="text-[23px] font-bold">Thông tin nhận hàng</h4>
                     <p class="font-medium text-[18px] mt-[15px]">Tên khách hàng </p>
                     <p><?= $order[0]['username'] ?></p>
                     <p class="font-medium text-[18px] mt-[15px]">Email </p>
                     <p><?= $order[0]['email'] ?></p>
                     <p class="font-medium text-[18px] mt-[15px]">Phone Number </p>
                     <p><?= $order[0]['phone'] ?></p>
                     <p class="font-medium text-[18px] mt-[15px]">Address </p>
                     <p><?= $order[0]['address'] ?></p>


                  </div>

               </div>

               <div class="checkout-infor-text-right">
                  <!-- phương thức thanh toán -->
                  <div class="">
                     <h4 class="text-[23px] font-bold mt-[15px]">Phương thức thanh toán</h4>
                     <p>Thanh toán khi nhận hàng</p>
                  </div>
                  <!-- phương thức vận chuyển -->
                  <div class="mt-4">
                     <h4 class="text-[23px] font-bold mt-[15px]">Phương thức vận chuyển</h4>
                     <p>giao hàng tận nơi</p>
                  </div>
                  <!-- cửa hàng -->
                  <div class="donhang flex justify-center  mx-[auto]">
                     <div class="">

                        <div class="flex justify-center">
                           <h4 class="text-[23px] font-bold mt-[15px]">Bạn cần vào Email này để xác nhận đơn hàng</h4>

                        </div>


                        <div class="flex ">
                           <img width="100px" src="../image/checkmail.jpg" alt="">
                        </div>



                     </div>
                  </div>

               </div>
            </div>
            <!-- quay về trang chủ -->


         </div>

      </div>
      <!-- sản phẩm đặt hàng -->
      <div class="order bg-light p-3 w-[40%]">
         <div>
            <p class="fw-bold">Đơn hàng #<?= $order[0]['codeorder'] ?> </p>
         </div>
         <hr>
         <!-- item 1 -->
         <?php 
                    $totalPrice = 0;
                   
                    if(isset($order)) {
                        foreach($order as $index => $item){
                           
                           

                    ?>
         <div class="row align-items-center w-100 mt-4">
            <div class="col-3"><img class="w-100" src="<?php echo $item['image'] ?>" alt=""> <span
                  class="position-relative text-light px-2 border border-danger rounded-circle bg-danger"
                  style="bottom: 100px;"><?=$item['quantity']?></span></div>
            <div class="col border-2 border rounded-2 shadow ">
               <span class="fs-5 fw-medium">
                  <?=$item['name']?>
               </span>
               <div class="d-flex gap-2 align-items-center">
                  <span class="fs-6 text-danger fw-bold ">
                     <?php echo number_format(  $item['priceone'], 0, ',', '.') . '₫' ?><span>đ</span>
                  </span>
                  <span class=" text-secondary" style="font-size: 12px; font-style: italic;">
                     <span>x</span>
                     <?php echo $item['quantity'] ?>
                  </span>

               </div>

            </div>
         </div>
         <hr>
         <?php }} ?>


         <hr>

         <!-- chi tiết số tiền thanh toán -->
         <div class="order-pricing">
            <!-- tổng các mặt hàng -->
            <div class="order-pricing-total" style="display: grid;
    grid-template-columns: 30% 30%;
    gap: 214px;margin:20px 0">
               <div><span>Tạm tính</span></div>
               <div><span><?= number_format($order[0]['price'], 0, ',', '.') ?> <span
                        class="text-decoration-underline">đ</span></span></div>
            </div>


            <hr>

            <!-- tổng thể -->
            <div class="order-pricing-final" style="display: grid;
    grid-template-columns: 30% 30%;
    gap: 214px;margin:20px 0">
               <div><span>Tổng cộng</span></div>
               <div><span><?= number_format($order[0]['price'], 0, ',', '.') ?></span> <span
                     class="text-decoration-underline">đ</span></div>
            </div>
         </div>
      </div>
   </div>

</div>

</div>

<script>
let open_modal = document.querySelector(" .open");
let modal = document.querySelector(".modal-open");
let
   close_modal = document.querySelector(".modal-open i")
open_modal.addEventListener("click", function() {
   modal.classList.toggle("active");
})
close_modal.addEventListener("click", function() {
   modal.classList.remove("active")
})
</script>