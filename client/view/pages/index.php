<?php
// require("../database/connect.php");
// require("../service/crud.php");
// require("./header.php")

   ?>
<div class="banner">
    <img src="../image/banner.webp" alt="">
</div>
<div class="content ">

    <div class="line flex justify-center items-center gap-[30px]">
        <div class="line-color  h-[2px] w-[400px] bg-[grey]"></div>
        <div class="title uppercase text-center my-[64px] text-[32px]">Danh mục sản phẩm</div>
        <div class="line-color h-[2px] w-[400px] bg-[grey]"></div>
    </div>


    <div class="product-category flex justify-between items-center mx-[350px]">
        <div class="image-zoom mr-[16px] rounded-xl">
            <a href="index.php?url=category&name=Loa Fender&id=12">
                <img class="w-[400px] h-[200px]" src="../image/menu-loa-fender.webp" alt="">
                <div class="name-category">Loa Fender</div>
            </a>
        </div>
        <div class="image-zoom ml-[16px] rounded-xl">
            <a href="index.php?url=category&name=Loa Bang & Olufsen&id=13">
                <img class="w-[400px] h-[200px]" src="../image/banner-bang-olufsen.jpg" alt="">
                <div class="name-category">Loa Bang & Olufsen</div>
            </a>
        </div>
    </div>
    <div class="title-product ml-[180px] my-[32px]">
        <h1 class="uppercase text-[24px] font-bold-700">Loa Fender</h1>
    </div>
    <div class="product grid grid-cols-4 gap-8 place-items-center w-[1200px] mx-[180px]">
        <?php
      foreach ($datafender as $item) {
         $price = number_format($item['price'], 0, ',', '.') . '₫';
          $saleprice = number_format($item['saleprice'], 0, ',', '.') . '₫';
         ?>

        <div class="product-items border border-antique-300 w-[300px] py-[20px]">
            <a href="index.php?url=product&id=<?php echo $item['id'] ?>">

                <img class="w-[200px] h-[181px] flex items-center p-[8px] m-[48px]" src="<?php echo $item['image'] ?>"
                    alt="">
                <p class="text-center font-bold mt-[32px]">
                    <?php echo $item['productname'] ?>
                </p>
                <del class="text-[grey] flex justify-center">
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
    <div class="title-product ml-[180px] my-[32px]">
        <h1 class="uppercase text-[24px] font-bold-700">Loa Bang & Harman</h1>
    </div>
    <div class="product grid grid-cols-4 gap-8 place-items-center w-[1200px] mx-[180px]">
        <?php
      foreach ($databang as $item) {
         $price = number_format($item['price'], 0, ',', '.') . '₫';
          $saleprice = number_format($item['saleprice'], 0, ',', '.') . '₫';
         ?>

        <div class="product-items border border-antique-300 w-[300px] py-[20px]">
            <a href="index.php?url=product&id=<?php echo $item['id'] ?>">

                <img class="w-[200px] h-[181px] flex items-center p-[8px] m-[48px]" src="<?php echo $item['image'] ?>"
                    alt="">
                <p class="text-center mt-[32px]">
                    <?php echo $item['productname'] ?>
                </p>
                <del class="text-[grey] flex justify-center">
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
</div>
<div class="banner-bot grid grid-cols-3 gap-8 place-items-center w-[1200px]  mt-[32px] mx-[180px]">
    <div class="border rounded-md"><img class="rounded-md w-[367px] h-[367px]" src="../image/banner-devialet.webp"
            alt="">
    </div>
    <div class="border rounded-md"><img class="rounded-md w-[367px] h-[367px]" src="../image/banner-bang-olufsen.webp"
            alt="">
    </div>
    <div class="border rounded-md"><img class="rounded-md w-[367px] h-[367px]" src="../image/banner-bose.webp" alt="">
    </div>
</div>