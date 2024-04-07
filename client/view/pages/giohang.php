<?php

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

if (isset($_POST['btn-update'])) {
    $quantity = $_POST['value'];
    $index = 0;
    $id = array();
    foreach ($cart as $key) {
        array_push($id, $key['id']);


    }
    for ($i = 0; $i < count($quantity); $i++) {
        $_SESSION['cart'][$id[$i]]['quantity'] = $quantity[$i];
    }
    header("Location:index.php?url=cart");



}
if (isset($_POST['btn-delete'])) {
    $id = $_POST['btn-delete'];
    unset($cart[$id]);
    $_SESSION['cart'] = $cart;


}

ob_end_flush();

?>




<div class=" w-[1162px] h-[500px]  mx-[auto] flex mt-[50px] justify-between">
   <form method="POST" class="content-left w-[700px] " style="overflow-y: scroll;">
      <ul class="flex font-bold border-b-[3px] border-[#ececec] py-[10px] ">
         <li class="mr-[300px]">
            Sản phẩm</li>
         <li class="mr-[100px]">Giá</li>
         <li class="mr-[70px]">Số lượng</li>
         <li class="mr-[0px]">Tổng</li>
      </ul>

      <?php
        if (!empty($cart)) {
            $tongALlcart = 0;

            foreach ($cart as $item) {
                $tong = $item['priceone'] * $item['quantity'];

                $price = number_format($tong, 0, ',', '.') . '₫';
                $price1 = number_format($item['priceone'], 0, ',', '.') . '₫';
                $tongALlcart += $tong;
                $tongALlcartconvert = number_format($tongALlcart, 0, ',', '.') . '₫';
                ?>
      <ul class="py-[30px] flex items-center border-b-[2px] border-[#ececec]">
         <li class="flex items-center gap-[10px]"><button type="submit" name="btn-delete"
               value="<?php echo $item['id'] ?>"><i class="fa-regular fa-circle-xmark"></i></button>
            <img width="75" height="75" src="<?php echo $item['image'] ?>" alt="">
            <p class="w-[155px]">
               <?php echo $item['name'] ?>
            </p>
         </li>
         <li class="ml-[80px] font-bold">
            <?php echo $price1 ?>
         </li>
         <li class="ml-[80px]">
            <div class="h-[36px] w-[78px] border border-[grey] flex items-center justify-center">
               <p class="minus pr-[8px] h-[100%] border-r-[1px] border-[grey]">-</p>
               <input class="value w-[20px] ml-[10px]" type="text " name="value[]"
                  value="<?php echo $item['quantity'] ?>">
               <p class="plus pl-[5px] h-[100%] border-l-[1px] border-[grey]">+</p>
            </div>
         </li>
         <li class="ml-[50px] font-bold">
            <?php echo $price ?>
         </li>
      </ul>


      <?php
            }

        } else {
            ?>

      <h2 class="mt-[50px] text-center text-[20px] font-bold">Bạn chưa có sản phẩm nào trong giỏ hàng </h2>

      <?php
        }
        ?>
      <div class=" mt-[15px] flex gap-[10px]">
         <a href="index.php">

            <p class="w-[208px] h-[34px] border-[2px] border-[black]"><i class="fa-solid fa-arrow-left-long"></i>
               Tiếp tục xem sản phẩm</p>
         </a>
         <button type="submit" style="display:none;" name="btn-update"
            class="hiddencart update_cart font-bold w-[208px] bg-[grey] h-[34px] text-white">CẬP NHẬT
            GIỎ HÀNG</button>

      </div>


   </form>
   <div class="content-right w-[439px] mt-[13px] ">
      <h3 class="font-bold">
         TỔNG SỐ LƯỢNG</h3>
      <hr class="mt-[12px] h-[3px] bg-[grey]">
      <div class=" flex justify-between items-center mt-[10px] pb-[5px] border-b-[1px] border-[#ececec]">
         <p>Tổng phụ</p>
         <?php
            if (!empty($cart)) {


                ?>
         <p class="font-bold">8.900.000₫</p>
         <?php
            } else {
                ?>
         <p class="font-bold">0₫</p>
         <?php
            }
            ?>

      </div>
      <div class=" flex justify-between items-center mt-[10px] pb-[5px] border-b-[2px] border-[#ececec]">
         <p class="text-[20px]">
            Tổng </p>
         <?php
            if (!empty($cart)) {


                ?>
         <p class="font-bold">
            <?php echo $tongALlcartconvert ?>
         </p>
         <?php
            } else {
                ?>
         <p class="font-bold">0₫</p>
         <?php
            }
            ?>
      </div>
      <a href="index.php?url=order">

         <button class="mt-[15px] w-[100%] h-[59px] bg-[red] rounded text-white">MUA NGAY <br> <span
               class="text-[12px]">Giao Tận Nơi Hoặc Nhận Tại Cửa Hàng
            </span></button>

      </a>
   </div>
</div>





<script>
let minus = document.querySelectorAll(".minus");
let plus = document.querySelectorAll(".plus");
let value = document.querySelectorAll(".value");
let hidden = document.querySelector(".hiddencart");



plus.forEach((item, index) => {

   return item.addEventListener("click", function(e) {

      let count = value[index].value;
      value[index].value = Number(count) + 1;

      hidden.style.display = "block";
   });
})


minus.forEach((item, index) => {

   return item.addEventListener("click", function(e) {

      let count = value[index].value;
      if (Number(count) === 1) {
         value[index].value = 1;
      } else {
         value[index].value = Number(count) - 1;
         hidden.style.display = "block";
      }
   });
})
</script>
<script>
let update = document.querySelector(".update_cart");
update.addEventListener("click", function() {

   localStorage.setItem("toastMessage", "Bạn đã update thành công")
})
// Hiển thị toast message sau khi trang đã tải lại

document.addEventListener("DOMContentLoaded", function() {
   var toastMessage = localStorage.getItem('toastMessage');

   if (toastMessage) {

      Toastify({
         text: toastMessage,
         backgroundColor: 'green',
         textColor: "#fff",
         duration: 3000
      }).showToast();
      setTimeout(() => {
         localStorage.removeItem('toastMessage'); // Xóa thông báo đã hiển thị khỏi localStorage

      }, 3000)
   }
});
</script>