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
                            <a href="#">Giới Thiệu</a></li>
                        <li class="text-white ">
                            <a href="baohanh.html">Bảo Hành</a></li>
                        <li class="text-white ">
                            <a href="contact.html">Liên Hệ</a></li>
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
        <div class="w-[1140px] mx-[auto]">
            <div class="title-top flex justify-center items-center gap-8">
                <div class="line-color h-[2px] w-[400px] bg-[grey]"></div>
                <h1 class="font-bold text-[24px]">Giới Thiệu Về Chúng Tôi</h1>
                <div class="line-color h-[2px] w-[400px] bg-[grey]"></div>
            </div>
            <div class="">
                <p>Xuất phát từ những người yêu âm nhạc và thiết bị âm thanh đến từ hãng âm thanh danh tiếng Marshall của Anh Quốc. Từ những cảm hứng đó. Chúng tôi, những người yêu thích trải nghiệm, yêu thích những chuyến đi, yêu thích nghệ thuật và âm nhạc đã tạo ra <b>MARSHALL VIỆT NAM</b>.  </p> <br>
                <p><b>MARSHALL VIỆT NAM</b>, mong muốn đem đến những sản phẩm đẹp, chất lượng cùng những câu chuyện và những trải nghiệm mới mẻ cho khách hàng của mình với dịch vụ tốt nhất.</p>

            </div>
            <div class="my-[32px]">
                <img src="/image/lienhe.webp" alt="">
            </div>
            <div class="title-top flex justify-center items-center gap-8">
                <div class="line-color h-[2px] w-[400px] bg-[grey]"></div>
                <h1 class="font-bold text-[24px]">Giới Thiệu Về Marshall</h1>
                <div class="line-color h-[2px] w-[400px] bg-[grey]"></div>
            </div>
            <div class="mt-[16px]">
                <p>Marshall là một công ty Anh quốc chuyên phát triển và sản xuất các sản phẩm âm thanh như tai nghe, loa, amplifier chất lượng cao.</p>
                <p>Công ty được thành lập bởi ông Jim Marshall tại Bletchley, Milton Keynes. Trong những năm 1980 và 1990, Marshall cho ra đời các sản phẩm chất lượng cao như các dòng JCM900, dòng 6100LE hay 6100LM, gây được tiếng vang đáng chú ý. Cùng thời điểm đó, phiên bản amplifier đặc biệt của Marshall là Silver Jubilee 2555 cũng góp mặt trên thị trường.</p><br>
                <p>Âm thanh của Marshall đã làm rung chuyển các sân khấu trên toàn thế giới trong hơn nửa thế kỷ. Và bây giờ bạn có thể nâng cao trải nghiệm âm nhạc của bạn với những loa Marshall hiện đại.</p><br>
                <p>Sau hơn 55 năm phát triển và gặt hái vô số thành công trong lĩnh vực thiết bị âm thanh chuyên nghiệp. Giờ đây, Marshall lại hướng sang thị trường âm thanh gia đình bằng những sản phẩm hiện đại, đạt chất lượng cao và không hề đánh mất bản sắc độc đáo của mình…</p><br>
                <p>Những chiếc loa Marshall như Emberton, Stockwell, Kilburn, Tufton, Acton, Stanmore và Woburn chỉ khác nhau về kích thước và công suất, còn lại đều thừa hưởng gần như chất Marshall: sở hữu logo vàng đầy tự hào trên bề mặt, hệ thống điều chỉnh volume, bass, treb cổ điển, bề ngoài đơn giản nhưng tinh tế.</p>
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