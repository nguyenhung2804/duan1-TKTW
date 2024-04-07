<?php

// error_reporting(0);


$err = array();
if (isset($_GET['id'])) {



   $id = $_GET['id'];
   $color = selectAll($conn, "SELECT color FROM `tbl_detailimage` where product_id=$id GROUP BY color");
   $colorone = $color[0]['color'];
   $imagecolor = selectAll($conn, "SELECT image FROM `tbl_detailimage` where product_id=$id and color='$colorone'");





   $datadetail = selectAll($conn, "SELECT * FROM `tbl_product` WHERE id=$id");
   $price = number_format($datadetail[0]['price'], 0, ',', '.') . '₫';
   $saleprice = number_format($datadetail[0]['saleprice'], 0, ',', '.') . '₫';
   $tietkiem = $datadetail[0]['price'] - $datadetail[0]['saleprice'];
   $tietkiemfomat = number_format($tietkiem, 0, ',', '.') . '₫';
   $category_id = $datadetail[0]['category_id'];
   $sanphamlienquan = selectAll($conn, "SELECT * FROM `tbl_product` WHERE category_id=$category_id");
   $sanphamlienquan = array_filter($sanphamlienquan, function ($product) use ($id) {
      return $product['id'] != $id;
   });
   $category = selectAll($conn, "SELECT * FROM `tbl_category`");
   $err = array();

   
   if (isset($_POST['btn_cart'])) {
      $quantity = $_POST['quantity'];


     


         $price = $datadetail[0]['saleprice'] * $quantity;

         $productname = $datadetail[0]['productname'];

         $image = $datadetail[0]['image'];
         $product_id = $datadetail[0]['id'];


         $arr = array();
         if (!isset($_SESSION['cart'])) {

            $_SESSION['cart'] = $arr;

         }
         $product = array(
            'id' => $product_id,
            'name' => $productname,
            'price' => $price,
            'priceone' => $datadetail[0]['saleprice'],
            // Giá sản phẩm
            'quantity' => $quantity,
            // Số lượng sản phẩm
            'image' => $image // Đường dẫn ảnh sản phẩm
         );


         // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng thì tăng số lượng
         if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;


         } else {
            $_SESSION['cart'][$product_id] = $product;
            $_SESSION['toastMessage'] = "da them than hcong";

         }
         header("Location:index.php?url=product&id=$id");
      




   }




}
if (isset($_GET['color'])) {
   $colorone = urldecode($_GET['color']);

   $imagecolor = selectAll($conn, "SELECT image FROM `tbl_detailimage` where product_id=$id and color='$colorone'");

}





?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>


<!-- MAIN CONTENT -->
<div class="main-content w-[1300px] mx-[auto]">
   <style>
   * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: sans-serif;
   }

   p {
      margin-bottom: 20px;
   }

   img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
   }

   .container-slider {
      margin: 50px auto;


      display: flex;
      flex-direction: column-reverse;
   }

   .main {
      position: relative;
      height: 513px;
   }

   .control {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      font-size: 30px;
      color: rgb(134, 55, 55);
      cursor: pointer;
      text-shadow: 0 0 5px grey;
   }

   .prev {
      left: 8px;
   }

   .next {
      right: 8px;
   }

   .img-wrap {
      width: 100%;
      height: 100%;
   }

   .list-img {
      display: flex;
   }

   .list-img div {
      cursor: pointer;
      padding: 2px;
      margin-bottom: 20px;
      margin-right: 40px;
      background-color: #bbb;
   }

   .list-img div:last-child {
      margin-right: 0;
   }

   .list-img div img {
      width: 80px;
      height: 80px;
   }

   .img-wrap {
      width: 455px;
      height: 455px;

      box-shadow: 0 0 10px #bbb;
   }

   .list-img div.active {
      background-color: rgb(220, 86, 86);
   }

   .container-flex {
      display: flex;
      justify-content: space-between;
   }

   .content-right {
      width: 439px;
   }

   .content-right h2 {
      margin-top: 45px;
      font-size: 28px;
   }

   .content-right-brand {
      display: flex;
      justify-content: space-between;
      color: grey;
      font-size: 18px;
   }

   .cost {
      color: red;
      font-size: 33px;
   }

   .content-right-price {
      display: flex;
      gap: 30px;
      color: grey;
      font-size: 18px;
   }

   .content-right-add {
      display: flex;
      justify-content: space-between;
   }

   .content-right-add-left {
      display: flex;
      align-items: center;
      width: 150px;
   }

   .content-right-add-left button {
      width: 50px;
      height: 50px;
      border: none;
   }

   .content-right-add-left input {
      width: 50px;
      height: 50px;
      border: none;
      outline: none;
      padding-left: 19px;
      font-size: 20px;
      background: #f0f0f0;
   }

   .content-right-add-right button {
      width: 291px;
      height: 50px;
      border: none;
      font-size: 17px;
      color: white;
      background: red;
   }

   .content-right-whitlist {
      display: flex;
      color: red;
      align-items: center;
      font-size: 20px;
      margin: 15px 0;
   }

   .content-right-whitlist p {
      margin-bottom: 0 !important;
   }

   .content-right-whitlist i {
      font-size: 25px;
   }

   .content-right-suppost {
      cursor: pointer;
      position: relative;
      max-height: 500px;
      overflow: hidden;
      transition: all 0.5s;
   }

   .content-right-suppost-flex {
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   .content-right-suppost-flex:hover p {
      color: red;
   }

   .content-right-suppost-flex p {
      font-weight: 700;
   }

   .content-right-suppost-flex {
      transition: all 0.5s;
   }

   .content-right-suppost button {
      border: none;
      background: red;
      width: 180px;
      height: 36px;
      color: white;
   }

   .toggle {
      max-height: 5000px;
   }

   .footer-about img {
      width: 74px !important;
      height: 56px !important;
   }

   .productrelate-title {
      margin: 40px 0;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 30px;
   }

   .line {
      width: 400px;
      height: 1px;
      background-color: grey;
   }

   .tns-outer {
      position: relative;
   }

   .tns-controls {
      width: 110%;
      position: absolute;
      top: 50%;
      left: -5%;
      z-index: 10;
      display: flex;
      justify-content: space-between;
   }

   .tns-controls button {
      width: 60px;
      height: 30px;

      border: none;
   }

   .tns-nav {
      display: none;
   }

   .rotate {
      transform: rotate(180deg);
      transition: all 0.5s;
   }

   hr {
      margin-bottom: 30px;
   }

   .minus,
   .plus {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 50px;
      height: 50px;
      margin: 0;
   }

   .activecolor {
      border: 1px solid grey;
      border-radius: 50%;
      padding: 3px;
   }

   .adddes {
      position: absolute;
      display: flex;
      bottom: 0;
      width: 150px;
      height: 43px;

      color: green;
      text-align: center;
      align-items: center;

      gap: 5px;
      width: 110%;
      background: white;

      box-shadow: -19px -22px 19px white;
   }

   .adddes p {
      margin: 0;
      margin-left: 15px;
   }

   .evaluate {
      padding: 47px;
      width: 100%;
      border: 1px solid grey;
      border-radius: 15px;

   }

   .jq-ry-container {
      z-index: 0;
   }

   .evaluate h2 {
      font-weight: 700;
   }

   .rating {
      display: inline-block;
   }

   .rating input {
      display: none;
   }

   .rating label {
      float: right;
      font-size: 35px;
      color: #ccc;
   }

   .rating label:before {
      content: "\2605";
   }

   .rating input:checked~label {
      color: #e74c3c;
   }

   .evaluate_flex {
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 20px;
   }

   .evaluate_flex p {
      margin: 0;
      margin-top: 5px;
   }



   .evaluate_child input {
      margin-right: 15px;
      width: 200px;
      height: 30px;
      padding: 10px;
      outline: none;
      border-bottom: 1px solid grey;
   }

   .evaluate_child button {
      margin-left: 35px;
      height: 30px;
      background: black;
      color: white;
      border-radius: 5px;
      border: none;
      padding: 0 10px;
   }

   .tns-liveregion {
      display: none;
   }

   #tns1 {

      margin: 0 auto;
   }
   </style>


   <div class="container">
      <div class="container-flex">
         <div class="content-left">
            <div class="container-slider">
               <div class="list-img">
                  <?php
                  foreach ($imagecolor as $key) {
                     ?>

                  <div>
                     <img src="<?php echo $key['image'] ?>" alt="" />
                  </div>
                  <?php

                  }
                  ?>


               </div>
               <div class="main">
                  <span class="control prev">
                     <i class="fa-solid fa-chevron-left"></i>
                  </span>
                  <span class="control next">
                     <i class="fa-solid fa-chevron-right"></i>
                  </span>
                  <div class="img-wrap">
                     <img src="<?php echo $datadetail[0]['image'] ?>" alt="" />
                  </div>
               </div>
            </div>
         </div>
         <div class="content-right">
            <h2>
               <?php echo $datadetail[0]['productname'] ?>
            </h2>
            <div class="content-right-brand">
               <p>Mã sản phẩm: PVN12</p>
               <div id="rating"></div>
            </div>
            <hr />
            <p class="cost">
               <?php echo $saleprice ?>
            </p>
            <div class="content-right-price">
               <p>Giá thị trường: <del>
                     <?php echo $price ?>
                  </del></p>
               <p>Tiết kiệm:
                  <?php echo $tietkiemfomat ?>
               </p>
            </div>
            <hr />
            <?php
            if ($datadetail[0]['quantity'] == 0) {
               ?>
            <h2 class="text-center">Hết hàng</h2>
            <?php
            } else {
               ?>
            <div class="flex justify-between items-center mb-[10px]">

               <p>Số lượng:
                  <?php echo $datadetail[0]['quantity'] ?>
               </p>
               <div class="flex gap-[10px] items-center">

                  <?php
                     foreach ($color as $key) {
                        $encode = urlencode($key['color']);
                        ?>
                  <a href="index.php?url=product&id=<?php echo $datadetail[0]['id'] ?>&color=<?php echo $encode ?>">
                     <div class="<?php if ($colorone == $key['color'])
                              echo "activecolor" ?> ">
                        <div class="bg-[<?php echo $key['color'] ?>] w-[30px] h-[30px] rounded-[50%]">

                        </div>

                     </div>

                  </a>
                  <?php
                     }


                     ?>
               </div>


            </div>
            <form method="POST" class="content-right-add">
               <div class="content-right-add-left">
                  <p class="minus">
                     <i class="fa-solid fa-minus"></i>
                  </p>
                  <input class="quantity" type="number" name="quantity" value="1" min="1"
                     max="<?php echo $datadetail[0]['quantity'] ?>" />
                  <p class="plus"><i class="fa-solid fa-plus"></i></p>
               </div>
               <div class="content-right-add-right">
                  <button type="submit" class="add_cart" name="btn_cart">THÊM VÀO GIỎ</button>
               </div>
            </form>
            <?php
            }
            ?>


            <div class="content-right-suppost">
               <div class="content-right-suppost-flex mt-[15px]">
                  <p class="text-[15px] m-0">GIAO HÀNG TOÀN QUỐC</p>

               </div>
               <div class="decription text-[12px] text-[grey]">
                  1. Thanh toán trực tiếp tại cửa hàng: <br />


                  2. Thanh toán khi mua hàng online qua website và ứng dụng của
                  NUTY:<br />

                  Thanh toán bằng tiền mặt khi nhận hàng (COD).<br />
                  Thanh toán trực tuyến (Internet Banking, VNPAY-QR, Ví điện tử
                  VNPAY, Visa - Miễn phí thanh toán) qua cổng thanh toán
                  VNPAY.<br />
                  3. Các bước thực hiện đối với từng phương thức thanh toán qua
                  cổng thanh toán VNPAY:
               </div>
            </div>

         </div>
         <div class="content-three">
            <div class="w-[252px] p-[15px] border border-[#c3c3c3] mt-[45px]">
               <div class="flex gap-[5px]">
                  <img class="w-[24px] h-[24px]" src="../image/policy_product_image_1.webp" alt="" />
                  <p>Giao hàng miễn phí toàn quốc</p>
               </div>
               <div class="flex">
                  <img class="w-[24px] h-[24px]" src="../image/policy_product_image_3.webp" alt="" />
                  <p>Trả góp qua thẻ tín dụng Visa, Master, JCB, CCCD</p>
               </div>
            </div>
            <div class="w-[252px] p-[15px] border border-[#c3c3c3] mt-[45px]">
               <h2 class="text-[18px] font-bold">Cam kết của chúng tôi:</h2>
               <hr class="mt-[10px]" />
               <h2 class="text-[20px] font-bold">
                  CAM KẾT LUÔN BÁN GIÁ TỐT NHẤT
               </h2>
               <p>Ở đâu BÁN RẺ, chúng tôi <b>BÁN RẺ HƠN</b></p>
            </div>
            <div class="w-[252px] p-[15px] border border-[#c3c3c3] mt-[45px]">
               <h2 class="text-[18px] font-bold">Danh mục sản phẩm</h2>
               <hr class="mt-[10px]" />
               <ul>
                  <?php
                  foreach ($category as $item) {
                     ?>
                  <li class="h-[30px] border border-[#c3c3c3] uppercase leading-[1] mb-[5px] p-[5px]">
                     <a href="category.php?name=<?php echo $item['categoryname'] ?>&id=<?php echo $item['id'] ?>">
                        <?php echo $item['categoryname'] ?>
                     </a>
                  </li>

                  <?php
                  }

                  ?>


               </ul>
            </div>
         </div>
      </div>
      <div class="suppost w-[1000px]">
         <div class="content-right-suppost desallchild">
            <div class="content-right-suppost-flex ">
               <p>MÔ TẢ SẢN PHẨM</p>
               <div class="adddes">
                  <p>Xem thêm</p>
                  <i class="fa-solid fa-chevron-down"></i>
               </div>
            </div>
            <div class="description ">
               <?php echo $datadetail[0]['description'] ?>
            </div>
         </div>



         <div class="evaluate">
            <h2>Đánh giá sản phẩm</h2>

            <form action="" method="post">
               <div class="form-floating">
                  <textarea class="resize-none rounded-md border w-[100%] p-[15px]" placeholder="Comment"></textarea>

               </div>
               <div class="evaluate_child">
                  <div class="evaluate_flex flex">
                     <p>Đánh giá</p>
                     <div class="rating">
                        <input type="radio" name="star" id="star5" value="5" /><label for="star5"></label>
                        <input type="radio" name="star" id="star4" value="4" /><label for="star4"></label>
                        <input type="radio" name="star" id="star3" value="3" /><label for="star3"></label>
                        <input type="radio" name="star" id="star2" value="2" /><label for="star2"></label>
                        <input type="radio" name="star" id="star1" value="1" /><label for="star1"></label>
                     </div>
                  </div>

                  <input type="text" placeholder="Mời nhập tên" />
                  <input type="text" placeholder="Mời nhập Phone" />
                  <button type="submit" class="float-right">
                     Gửi Đánh Giá
                  </button>
               </div>
         </div>
         </form>
      </div>
   </div>

   <div class="productrelate">
      <div class="productrelate-title">
         <div class="line"></div>
         <h2>SẢN PHẨM LIÊN QUAN</h2>
         <div class="line"></div>
      </div>
      <div class="my-slider" style="display: flex; gap: 15px">
         <?php
         foreach ($sanphamlienquan as $item) {
            ?>

         <div class="product-items border border-antique-300 w-[300px]">
            <a href=""><img class="w-[200px] h-[181px] flex items-center p-[8px]" src="<?php echo $item['image'] ?>"
                  alt="" /></a>
            <p class="text-center mt-[32px]">
               <?php echo $item['productname'] ?>
            </p>
            <del class="flex justify-center">
               <?php echo $item['price'] ?>
            </del>
            <span class="text-[red] flex justify-center font-bold">
               <?php echo $item['saleprice'] ?>
            </span>
         </div>

         <?php


         }


         ?>

      </div>
   </div>
</div>
</div>

<!-- FOOTER -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
let listDivImg = document.querySelectorAll(".list-img div");
let next = document.querySelector(".next");
let prev = document.querySelector(".prev");
let imgWrap = document.querySelector(".img-wrap img");

let currentIndex = 0;

setCurrent(currentIndex);

function setCurrent(index) {
   currentIndex = index;
   imgWrap.src = listDivImg[currentIndex].querySelector("img").src;

   // remove all active img
   listDivImg.forEach((item) => {
      item.classList.remove("active");
   });

   // set active
   listDivImg[currentIndex].classList.add("active");
}

listDivImg.forEach((img, index) => {
   img.addEventListener("click", (e) => {
      setCurrent(index);
   });
});

next.addEventListener("click", () => {
   if (currentIndex == listDivImg.length - 1) {
      currentIndex = 0;
   } else currentIndex++;

   setCurrent(currentIndex);
});

prev.addEventListener("click", () => {
   if (currentIndex == 0) currentIndex = listDivImg.length - 1;
   else currentIndex--;

   setCurrent(currentIndex);
});

// description
let desall = document.querySelector(".adddes");
let p = document.querySelector(".adddes p");
let desallchild = document.querySelector(".desallchild");
let check = document.querySelector(".fa-chevron-down");

let count = 1;
desall.addEventListener("click", function() {
   count++;
   if (count % 2 == 0) {
      p.innerHTML = "Thu gọn"
   } else {
      p.innerHTML = "Xem thêm"
   }
   check.classList.toggle("rotate");
   desallchild.classList.toggle("toggle");
});
let minus = document.querySelector(".minus");
let plus = document.querySelector(".plus");
let value = document.querySelector(".quantity");
plus.addEventListener("click", function(e) {
   let count = value.value;
   value.value = Number(count) + 1;
});
minus.addEventListener("click", function(e) {
   let count = value.value;
   if (Number(count) === 1) {
      value.value = 1;
   } else {
      value.value = Number(count) - 1;
   }
});

const inputElement = document.querySelector(".quantity");


inputElement.addEventListener("input", function() {
   const currentValue = parseInt(inputElement.value);
   const maxValue = parseInt(inputElement.getAttribute("max"));


   if (currentValue >= maxValue) {


      inputElement.value = maxValue;
      Toastify({
         text: "Bạn không thể chọn vượt quá sô lượng",
         backgroundColor: 'green',
         textColor: "#fff",
         duration: 3000
      }).showToast();

   }
});




var slider = document.querySelector(".my-slider");
var tns = tns({
   container: slider,
   loop: false,
   responsive: {
      350: {
         items: 2,
      },
      500: {
         items: 6,
      },
   },
   swipeAngle: false,
   speed: 400,
});
</script>




<script>
let cart = document.querySelector(".add_cart");
cart.addEventListener("click", function() {

   localStorage.setItem("toastMessage", "Bạn đã thêm vào giỏ hàng thành công")
})
</script>









<script>
$(function() {
   $("#rating").rateYo({
      starWidth: "20px", // Độ rộng của sao
      rating: 3.5, // Giá trị rating mặc định
      fullStar: true, // Cho phép chọn nửa sao
      onSet: function(rating, rateYoInstance) {
         console.log("Đánh giá: " + rating);
      },
   });
});
</script>
<script>
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

      }, 1000)
   }
});
</script>