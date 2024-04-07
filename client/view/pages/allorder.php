<?php



if (isset($_GET['ordercode'])) {
   $ordercode = $_GET['ordercode'];
   $dataorder = selectAll($conn, "SELECT * FROM `tbl_order` where order_code='$ordercode'");

} else {

   if (!empty($check)) {
      $email = $check['email'];
      $dataorder = selectAll($conn, "SELECT * FROM `tbl_order` where email='$email'");


   }
}

if (isset($_POST['deleteorder'])) {


   $id = $_POST['id'];
   delete($conn, "DELETE FROM `tbl_order` WHERE id=$id");
   $dataorder = array_filter($dataorder, function ($product) use ($id) {
      return $product['id'] != $id;
   });

}

ob_end_flush();

?>



<style>
.modal-order {
   position: fixed;
   top: 0;
   left: 0;
   background: rgba(0, 0, 0, .5);
   width: 100%;
   height: 100vh;
   display: flex;
   justify-content: center;
   align-items: center;
   opacity: 0;
   pointer-events: none;
}

.active {
   opacity: 1;
   transform: scale(1);
   transition: all .5s;
   box-shadow: 0 0 10px grey;
   pointer-events: all;
}

.modal-order-item {
   width: 400px;
   height: 200px;
   background: white;
   box-shadow: 0 0 10px grey;
   padding: 20px;
}
</style>
<h2 class="text-[30px] text-center my-[20px]">Đơn Hàng</h2>
<div class=" w-[1300px] h-[500px]  mx-[auto] flex mt-[50px] justify-between">
   <form method="POST" class=" w-[950px] mx-[auto] " style="overflow-y: scroll;">
      <ul class="flex font-bold border-b-[3px] border-[#ececec] py-[10px] ">
         <li class=" mr-[250px]">
            Sản phẩm</li>

         <li class="mr-[130px]">Email</li>

         <li class="mr-[100px]">Status</li>
         <li class="mr-[110px]">Tổng</li>
         <li class="mr-[0px]">Action</li>
      </ul>

      <?php
      if (!empty($dataorder)) {
         $tongALlcart = 0;

         foreach ($dataorder as $item) {
            $price = number_format($item['sum'], 0, ',', '.') . '₫';
            $price1 = number_format(($item['sum'] / $item['quantity']), 0, ',', '.') . '₫';
          
            ?>


      <ul class="py-[30px] flex items-center border-b-[2px] border-[#ececec]">
         <li class="flex items-center gap-[10px]"><button type="submit" name="btn-delete"
               value="<?php echo $item['id'] ?>"><i class="fa-regular fa-circle-xmark"></i></button>
            <img width="75" height="75" src="<?php echo $item['image'] ?>" alt="">
            <p class="w-[133px]">
               <?php echo $item['productname'] ?>
            </p>
         </li>


         <li class="ml-[20px]   font-bold">
            <?php echo $item['email'] ?>
         </li>

         <li class="ml-[45px] w-[120px] font-bold">
            <?php if ($item['status'] == 0) {
                        echo "Chờ duyệt";
                     } elseif ($item['status'] == 1) {
                        echo "Đang giao";
                     } else {
                        echo "Đã giao";
                     } ?>
         </li>

         <li class="ml-[22px] font-bold">
            <?php echo $price ?>
         </li>

         <?php
                  if ($item['confim'] == 1) {
                     ?>
         <li class="ml-[50px] flex gap-2 font-bold">
            <?php
                        if ($item['status'] == 2) {
                           ?>
            <button class="w-[80px] h-[30px] bg-[grey] text-white">Đánh giá</button>
            <?php
                        } else {

                           ?>
            <?php
                        if($item['status'] != 1){

                            ?>
            <div>
               <input type="text" class="valuedelete" value="<?php echo $item['id'] ?>" name="id" hidden>


               <p
                  class="modalcheck-open w-[50px] h-[30px] bg-[red] text-white text-center text-[15px] rounded-md pt-[3px] ">
                  Hủy</p>







            </div>

            <?php
                        }
                        ?>




            <a href="index.php?url=detailorder&id=<?php echo $item['id'] ?>">

               <p class="w-[70px] h-[30px] bg-[green] text-white text-center text-[15px] rounded-md pt-[3px]">
                  Chi tiết
               </p>

            </a>
            <?php
                        }

                        ?>

         </li>

         <?php
                  } else {
                     ?>
         <li class="ml-[22px] font-bold">
            <p>Chưa xác nhận Email</p>
         </li>

         <?php
                  }

                  ?>


      </ul>












      <?php
         }

      } else {
         ?>

      <h2 class="mt-[50px] text-center text-[20px] font-bold">Bạn chưa có sản phẩm nào trong giỏ hàng </h2>

      <?php
      }
      ?>





   </form>
   <div class="content-three">
      <div class="w-[252px] p-[15px] border border-[#c3c3c3] ">
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

   </div>




</div>


<div class="modal-order">
   <div class="modal-order-item">
      <h3 class="mb-[15px]">Hủy đơn hàng</h3>
      <hr>
      <p class="mt-[20px]">Bạn có thực sự muốn hủy đơn hàng.</p>

      <form method="post" class="flex justify-end ">
         <div class=" flex justify-end mt-[30px]">
            <input type="text" class="values" style="opacity: 0;" name="id">
            <button type="submit" name="deleteorder"
               class="deleteorder w-[60px] h-[30px] bg-[red] text-white">Yes</button>
            <p class="closedelete w-[60px] h-[30px] text-center leading-8 cursor-pointer">No</p>

         </div>
      </form>
   </div>

</div>



<script>
let opendelete = document.querySelectorAll(".modalcheck-open");
let valuedelete = document.querySelectorAll(".valuedelete");
let deleteoerder = document.querySelector(".modal-order");
let closedelete = document.querySelector(".closedelete");
let values = document.querySelector(".values");

opendelete.forEach((item, index) => {
   return item.addEventListener("click", function() {

      deleteoerder.classList.toggle("active");
      values.value = valuedelete[index].value




   })
})


closedelete.addEventListener("click", function() {

   deleteoerder.classList.remove("active")
})
</script>

<script>
let minus = document.querySelectorAll(".minus");
let plus = document.querySelectorAll(".plus");
let value = document.querySelectorAll(".value");

plus.forEach((item, index) => {

   return item.addEventListener("click", function(e) {
      console.log(value[index])
      let count = value[index].value;
      value[index].value = Number(count) + 1;
   });
})


minus.forEach((item, index) => {

   return item.addEventListener("click", function(e) {

      let count = value[index].value;
      if (Number(count) === 1) {
         value[index].value = 1;
      } else {
         value[index].value = Number(count) - 1;
      }
   });
})
</script>
<script>
let deleteorder = document.querySelector(".deleteorder");
deleteorder.addEventListener("click", function(e) {


   localStorage.setItem("toastMessage", "Bạn xóa đơn hàng thành công")
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