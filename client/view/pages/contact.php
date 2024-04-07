<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css">
    <style>
        .menu ul li a {
            display: block;
            transition: all 0.3s ease-in-out;
        }
        
        .menu ul li:hover a {
            transform: scale(1.1);
            color: red;
        }
        
        .image-zoom {
            overflow: hidden;
        }
        
        .image-zoom a img {
            display: block;
            transition: all 0.3s ease-in-out;
        }
        
        .image-zoom a:hover img {
            transform: scale(1.1);
        }
        
        .image-zoom a {
            position: relative;
            display: block;
        }
        
        .image-zoom a .name-category {
            position: absolute;
            color: white;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 14px;
            bottom: 0px;
            left: 50%;
            transform: translateX(-50%);
            transition: all 0.3s ease-in-out;
        }
        
        .image-zoom a:hover .name-category {
            bottom: 40%;
        }
        
        .product-items a img {
            transition: all 0.3s ease-in-out;
        }
        
        .product-items a:hover img {
            transform: scale(1.1);
            display: block;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="header  sticky top-[0px] z-10">
            <div class=" flex justify-center bg-[white]">
                <div class="support w-[1250px]   flex justify-between items-center ">

                    <div class="logo w-[120px] ml-[40px]">
                        <img src="/image/snake_sound-removebg-preview.png" alt="">
                    </div>
                    <div class="flex items-center gap-[30px]">

                        <div class="support-icon">
                            <img class="w-[50px]" src="/image/icon-tu-van.webp" alt="">
                        </div>
                        <div class="support-title">
                            <span>Hỗ trợ 24/7</span> <br>
                            <span class="text-[red]">0973.1188.35</span>
                        </div>
                        <div class="login  flex">
                            <span>Đăng nhập / Đăng ký </span>
                            <i class="fa-regular fa-user flex justify-between items-center ml-[16px]"></i>
                        </div>
                        <div class="cart-title ">
                            <span> Giỏ hàng</span>
                        </div>
                        <div class="cart-icon">
                            <img class="w-[50px]" src="/image/icon-gio-hang.webp" alt="">
                        </div>
                    </div>
                </div>

            </div>
            <div class="navbar flex justify-between items-center bg-[black]  h-[50px] ">
                <div class="menu flex justify-between items-center ml-[165px]">
                    <ul class="flex justify-between gap-[24px]">
                        <li class="text-white ">
                            <a href="index.php">Trang Chủ</a></li>
                        <li class="text-white ">
                            <a href="gioithieu.html">Giới Thiệu</a></li>
                        <li class="text-white ">
                            <a href="baohanh.html">Bảo Hành</a></li>
                        <li class="text-white ">
                            <a href="">Liên Hệ</a></li>
                    </ul>
                </div>
                <div class="search flex justify-between mr-[100px] items-center ">
                    <input class="w-[400px]" type="text" name="" id="" placeholder="Tìm kiếm sản phẩm, danh, mục...">
                    <button type="submit"><a href=""><img class="w-[50px]" src="/image/icon-search.png" alt=""></a></button>
                </div>
            </div>
        </div>
        <!-- <div class="banner">
            <img src="/image/banner.webp" alt="">
        </div> -->
        <div class="">
            <div class="banner flex justify-center items-center m-[auto]">
                <img src="/image/lienhe.webp" alt="">
            </div>
            <div class="content flex justify-between my-[16px]">
                <div class="content-left w-[555px] ml-[132px]">
                    <p>Địa chỉ: 180D Thái Thịnh, Láng Hạ, Đống Đa, TP. Hà Nội. </p> 
                    <p>Điện thoại: 0973.118.835</p>
                    <input class="w-[421px] h-[38px] border-2 border-[grey]" type="text" name="" id="" placeholder="Số Điện Thoại...">
                    <button class="bg-[black] text-[white] h-[38px] rounded-sm">Đăng Kí Tư Vấn</button>
                </div>
                <div class="content-right w-[555px]  mr-[132px]">
                    <h3 class="text-[24px] font-bold">Liên Hệ</h3>
                    <p>Bạn vui lòng điền đầy đủ thông tin và nội dung đề xuất của bạn vào biểu mẫu dưới đây, sau đó gửi cho chúng tôi, chúng tôi sẽ liên hệ với bạn ngay sau khi nhận được thông tin của bạn.</p>
                    <input  class="w-[244px] h-[38px] border-2 border-[grey] my-[8px] w-[421px]" type="text" name="" id="" placeholder="Tên của bạn ..."><br>
                    <input  class="w-[244px] h-[38px] border-2 border-[grey] my-[8px] w-[421px]" type="text" name="" id="" placeholder="Số điện thoại ..."><br>
                    <input  class="w-[244px] h-[38px] border-2 border-[grey] my-[8px] w-[421px] p-[50px]" type="text" name="" id="" placeholder="Nội dung liên hệ ..."><br>
                    <button class="bg-[black] text-[white] h-[38px] rounded-sm">Gửi Liên Hệ</button>
                </div>
            </div>
        </div>
        <div class="footer w-[100%] bg-red-100 mt-[32px] flex justify-center">
            <div class="footer-support mx-[16px]">
                <a href="">Tin Tức</a> <br>
                <a href="">Thanh Toán</a> <br>
                <a href="">Giao Hàng</a> <br>
                <a href="baohanh.html">Bảo Hành</a>
            </div>
            <div class="footer-company mx-[16px] py-[16px] ml-[200px]">
                <p>CÔNG TY CỔ PHẦN MOCATO VIỆT NAM <br> - Hotline: 0973.1188.35 <br> - ĐC: 180D Thái Thịnh, P.Láng Hạ, Q.Đống Đa, TP.Hà Nội</p>
            </div>

        </div>
    </div>
</body>

</html>