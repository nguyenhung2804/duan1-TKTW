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
      <h1 class="uppercase text-[24px] text-center font-bold-700">
         Từ khóa bạn tìm kiếm : <?php echo $search ?>

      </h1>
      <p class="text-center text-[grey]">Tìm thấy <?php echo count($datasearch) ?> sản phẩm</p>
   </div>
   <div class="product grid grid-cols-4 gap-8 place-items-center w-[1200px] mx-[180px]">


      <?php
        foreach ($datasearch as $item) {
            ?>


      <div class="product-items border border-antique-300 w-[300px] ">
         <a href="index.php?url=product&id=<?php echo $item['id'] ?>">

            <img class="w-[200px] h-[181px] flex items-center p-[8px] m-[48px]" src="<?php echo $item['image'] ?>"
               alt="">
            <p class="text-center mt-[32px]">
               <?php echo $item['productname'] ?>
            </p>
            <del class=" flex justify-center">
               <?php echo $item['price'] ?>
            </del>
            <span class="text-[red] flex justify-center font-bold">
               <?php echo $item['saleprice'] ?>
            </span>
         </a>
      </div>



      <?php
        }


        ?>




   </div>


</div>
<div class="banner-bot grid grid-cols-3 gap-8 place-items-center w-[1200px]  mt-[32px] mx-[180px]">
   <div class="border rounded-md"><img class="ww-[367px] h-[367px]" src="../image/banner-devialet.webp" alt="">
   </div>
   <div class="border rounded-md"><img class="ww-[367px] h-[367px]" src="../image/banner-bang-olufsen.webp" alt="">
   </div>
   <div class="border rounded-md"><img class="ww-[367px] h-[367px]" src="../image/banner-bose.webp" alt=""></div>
</div>