<!-- <div class="banner">
            <img src="/image/banner.webp" alt="">
        </div> -->
<div class="content ">
   <!-- <div class="product-category flex justify-between items-center mx-[350px]">
                <div class="image-zoom mr-[16px] rounded-xl">
                    <a href="">
                        <img class="w-[400px] h-[200px]" src="/image/menu-loa-fender.webp" alt="">
                        <div class="name-category">Loa Fender</div>
                    </a>
                </div>
                <div class="image-zoom ml-[16px] rounded-xl">
                    <a href="">
                        <img class="w-[400px] h-[200px]" src="/image/banner-bang-olufsen.jpg" alt="">
                        <div class="name-category">Loa Bang & Olufsen</div>
                    </a>
                </div>
            </div> -->
   <div class="title-product ml-[180px] my-[32px]">
      <h1 class="uppercase text-[24px] font-bold-700">
         <?php echo $_GET['name'] ?>
      </h1>
   </div>
   <div class="product grid grid-cols-4 gap-8 place-items-center w-[1200px] mx-[180px]">


      <?php
        foreach ($data as $item) {
          $price = number_format($item['price'], 0, ',', '.') . '₫';
          $saleprice = number_format($item['saleprice'], 0, ',', '.') . '₫';
            ?>


      <div class="product-items border border-antique-300 w-[300px] ">
         <a href="index.php?url=product&id=<?php echo $item['id'] ?>">

            <img class="w-[200px] h-[181px] flex items-center p-[8px] m-[48px]" src="<?php echo $item['image'] ?>"
               alt="">
            <p class="text-center mt-[32px]">
               <?php echo $item['productname'] ?>
            </p>
            <del class=" flex justify-center">
               <?php echo $price ?>
            </del>
            <span class="text-[red] flex justify-center font-bold">
               <?php echo $saleprice ?>
            </span>
         </a>
      </div>



      <?php
        }


        ?>




   </div>
   <style>
   .containerpagi {

      padding: 16px;
      border-radius: 3px;

      text-align: center;
      width: 34% !important;
      margin: 0 auto;
      margin-top: 40px;
   }

   .pagination {
      display: flex;
      list-style: none;
      justify-content: center;
   }

   .pagination li {

      margin: 0px 5px;
      background: #dde1e7;
      border-radius: 3px;
      box-shadow: -3px -3px 7px #ffffff73, 3px 3px 5px rgba(94, 104, 121, 0.288);
   }

   .pagination li a {
      font-size: 18px;
      text-decoration: none;
      color: #4d3252;
      height: 40px;
      width: 45px;
      display: block;
      line-height: 42px;
   }



   .pagination li.active {
      box-shadow: inset -3px -3px 7px #ffffff73,
         inset 3px 3px 5px rgba(94, 104, 121, 0.288);
   }

   .pagination li.active a {
      font-size: 17px;
      color: #6f6cde;
   }

   .pagination li:first-child {
      margin: 0 15px 0 0;
   }

   .pagination li:last-child {
      margin: 0 0 0 15px;
   }
   </style>
   <div class="containerpagi">
      <ul class="pagination">
         <?php
         for ($i=1; $i <= $totalPages; $i++) { 
           ?>
         <li class='<?php if($currentPage==$i) echo "active" ?>'>
            <?php echo "<a href='$currentURL&page=$i'> $i </a>" ?></li>
         <?php

         }

         ?>



      </ul>
   </div>
   <script>
   var liElements = document.querySelectorAll(".pagination li");
   var liElementschild = document.querySelector(".pagination li:first-child");


   // Lặp qua từng phần tử <li> và thêm sự kiện click
   liElements.forEach(function(li) {
      li.addEventListener("click", function() {
         // Xóa lớp 'active' của tất cả các phần tử <li>
         liElements.forEach(function(el) {
            el.classList.remove("active");
         });

         // Thêm lớp 'active' cho phần tử <li> được click
         this.classList.add("active");
      });
   });
   </script>
</div>
<div class="banner-bot grid grid-cols-3 gap-8 place-items-center w-[1200px]  mt-[32px] mx-[180px]">
   <div class="border rounded-md"><img class="ww-[367px] h-[367px]" src="../image/banner-devialet.webp" alt="">
   </div>
   <div class="border rounded-md"><img class="ww-[367px] h-[367px]" src="../image/banner-bang-olufsen.webp" alt="">
   </div>
   <div class="border rounded-md"><img class="ww-[367px] h-[367px]" src="../image/banner-bose.webp" alt=""></div>
</div>