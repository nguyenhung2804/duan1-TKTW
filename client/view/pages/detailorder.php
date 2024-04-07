<!-- MAIN CONTENT -->
<?php
if(isset($_GET['id'])){
   $id = $_GET['id'];
   $data= selectAll($conn,"SELECT * FROM `tbl_order` where id=$id");

   if(isset($_POST['quaylai'])){

      
     
   }

}

?>
<div class="main-content w-[1300px] mx-[auto]">
   <style>
   * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: sans-serif;
   }

   .evaluate {
      width: 1000px;
      padding: 20px;
      border-radius: 15px;
      border: 1px solid grey;
      margin: 0 auto;

   }
   </style>


   <div class="container">
      <h2 class="text-[30px] text-center my-[20px]">Chi Tiết Đơn Hàng</h2>
      <div class="evaluate">
         <img src="<?php echo $data[0]['image'] ?>" class="mx-[auto]" width="319" height="180" alt="">
         <div class="flex justify-between border-b-[2px] py-[15px]">
            <div class="w-[45%] text-center">
               <label for="" class="">Tên sản phẩm</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['productname'] ?></p>
            </div>
            <div class="w-[45%] text-center">
               <label for="">Số lượng</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['quantity'] ?></p>
            </div>

         </div>
         <div class="flex justify-between border-b-[2px] py-[15px]">
            <div class="w-[45%] text-center">
               <label for="" class="">Tổng tiền</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['sum'] ?></p>
            </div>
            <div class="w-[45%] text-center">
               <label for="">Trạng thái</label><br>
               <p class="font-bold text-[22px]"> <?php if( $data[0]['status']==0){ echo "Chờ duyệt";}elseif($data[0]['status']==1){
                  echo "Đang giao";
            }else {
                echo "Đã giao";
            } ?></p>
            </div>
         </div>
         <div class="flex justify-between border-b-[2px] py-[15px]">
            <div class="w-[45%] text-center">
               <label for="" class="">Tên khách hàng</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['name'] ?></p>
            </div>
            <div class="w-[45%] text-center">
               <label for="">Email</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['email'] ?></p>
            </div>
         </div>
         <div class="flex justify-between border-b-[2px] py-[15px]">
            <div class="w-[45%] text-center">
               <label for="" class="">Địa chỉ giao hàng</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['address'] ?></p>
            </div>
            <div class="w-[45%] text-center">
               <label for="">Số điện thoại</label><br>
               <p class="font-bold text-[22px]"><?php echo $data[0]['phone_number'] ?></p>
            </div>
         </div>
         <div class="flex justify-center py-[20px]">
            <button class="w-[100px] h-[30px] bg-[orange] rounded-md" onclick="goBack()">Quay lại</button>
         </div>
      </div>

      <script>
      function goBack() {
         window.history.back();
      }
      </script>

      <!-- FOOTER -->