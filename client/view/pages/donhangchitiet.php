<?php
 $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

// Lấy tên miền
$domain = $_SERVER['HTTP_HOST'];

// Lấy URI (phần sau tên miền)
$uri = $_SERVER['REQUEST_URI'];

// Kết hợp thành URL đầy đủ
$currentURL = $protocol . "://" . $domain . $uri;

$queryString = parse_url($currentURL, PHP_URL_QUERY);

// Khởi tạo một biến để lưu mảng
$data = array();

// Chuyển đổi chuỗi query string thành mảng
parse_str($queryString, $data);
array_shift($data);

$dataorder = array();
foreach ($data as $key) {
   updatedata($conn,"UPDATE `tbl_order` SET `confim`=1 WHERE order_code='$key'");
   $dataorderdetail = selectAll($conn,"SELECT * FROM `tbl_order` where  order_code='$key'");
   array_push($dataorder, $dataorderdetail);
}



?>


<style>
* {
   padding: 0;
   margin: 0;
   box-sizing: border-box;
   font-family: sans-serif;
}

.evaluate {
   width: 700px;
   padding: 20px;
   border-radius: 15px;
   border: 1px solid grey;
   margin: 0 auto;

}
</style>
<a href="index.php">
   <div class="back mx-[120px] mt-[32px]">
      <i class="fa-solid fa-arrow-left "> Quay Lai</i>
   </div>
</a>
<div class="flex justify-center">
   <span class="font-bold text-[28px]">Ghi nhận đơn hàng thành công.</span>
</div>
<div class="donhang flex justify-between w-[1100px]  mx-[auto]">

   <div class="">


      <div class="">
         <?php
         $count=0;
         foreach ($dataorder as $key) {
            $count++;
            ?>
         <p>Đơn <?php echo $count; ?></p>
         <div class="evaluate">
            <img src="<?php echo $key[0]['image'] ?>" class="mx-[auto]" width="319" height="180" alt="">
            <div class="flex justify-between border-b-[2px] py-[15px]">
               <div class="w-[45%] text-center">
                  <label for="" class="">Tên sản phẩm</label><br>
                  <p class="font-bold text-[22px]"><?php echo $key[0]['productname'] ?></p>
               </div>
               <div class="w-[45%] text-center">
                  <label for="">Số lượng</label><br>
                  <p class="font-bold text-[22px]"><?php echo $key[0]['quantity'] ?></p>
               </div>

            </div>
            <div class="flex justify-between border-b-[2px] py-[15px]">
               <div class="w-[45%] text-center">
                  <label for="" class="">Tổng tiền</label><br>
                  <p class="font-bold text-[22px]"><?php echo number_format( $key[0]['sum'], 0, ',', '.') . '₫'  ?></p>
               </div>
               <div class="w-[45%] text-center">
                  <label for="">Trạng thái</label><br>
                  <p class="font-bold text-[22px]"> Đã xác nhận</p>
               </div>
            </div>
            <div class="flex justify-between border-b-[2px] py-[15px]">
               <div class="w-[45%] text-center">
                  <label for="" class="">Tên khách hàng</label><br>
                  <p class="font-bold text-[22px]"><?php echo $key[0]['name'] ?></p>
               </div>
               <div class="w-[45%] text-center">
                  <label for="">Email</label><br>
                  <p class="font-bold text-[22px]"><?php echo $key[0]['email'] ?></p>
               </div>
            </div>
            <div class="flex justify-between py-[15px]">
               <div class="w-[45%] text-center">
                  <label for="" class="">Địa chỉ giao hàng</label><br>
                  <p class="font-bold text-[22px]"><?php echo $key[0]['address'] ?></p>
               </div>
               <div class="w-[45%] text-center">
                  <label for="">Số điện thoại</label><br>
                  <p class="font-bold text-[22px]"><?php echo $key[0]['phone_number'] ?></p>
               </div>
            </div>

         </div>



         <?php
         }
         
         ?>

      </div>

   </div>
   <div class="content-three  mt-[24px]">
      <div class="w-[300px] p-[15px] border border-[#c3c3c3] ">
         <div class="flex gap-[5px]">
            <img class="w-[24px] h-[24px]" src="../image/policy_product_image_1.webp" alt="" />
            <p>Giao hàng miễn phí toàn quốc</p>
         </div>
         <div class="flex">
            <img class="w-[24px] h-[24px]" src="../image/policy_product_image_3.webp" alt="" />
            <p>Trả góp qua thẻ tín dụng Visa, Master, JCB, CCCD</p>
         </div>
      </div>
      <div class="w-[300px] p-[15px] border border-[#c3c3c3] mt-[45px]">
         <h2 class="text-[18px] font-bold">Cam kết của chúng tôi:</h2>
         <hr class="mt-[10px]" />
         <h2 class="text-[20px] font-bold">
            CAM KẾT LUÔN BÁN GIÁ TỐT NHẤT
         </h2>
         <p>Ở đâu BÁN RẺ, chúng tôi <b>BÁN RẺ HƠN</b></p>
      </div>

   </div>

</div>

</div>
</body>

</html>
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