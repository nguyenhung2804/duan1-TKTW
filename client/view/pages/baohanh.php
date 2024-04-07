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
    <div class="container">
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
                            <a href="index.html">Trang Chủ</a></li>
                        <li class="text-white ">
                            <a href="gioithieu.html">Giới Thiệu</a></li>
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
        <div class="title text-[32px] font-bold-700 my-[32px] mx-[150px]">
            <h1>Chính Sách Bảo Hành</h1>
        </div>
        <div class="content w-[1200px] ">

            <div class="chinhsach mx-[150px]">
                <p>
                    Tất cả các sản phẩm bán ra từ marshallvietnam.vn sẽ được bảo hành 12 tháng theo quy định của Marshall với <b>số điện thoại</b> đã mua hàng hoặc dựa vào <b>phiếu xuất kho</b> kiêm bảo hành. <br> Mọi thông tin về bảo hành quý khách vui
                    lòng liên hệ: <br> Người nhận: MARSHALL VIỆT NAM <br> <b>Điện thoại</b>: 0922.758.666 <br> <b>Email</b>: info@marshallvietnam.vn <br> <b>Đia chỉ</b>: 180D Thái Thịnh, Láng Hạ, Đống Đa, Hà Nội <br> <b>I. Quy định bảo hành</b> <br> Tất
                    cả các sản phẩm sẽ được bảo hành 1 đổi 1 nếu phát sinh lỗi từ nhà sản xuất trong vòng 12 tháng (Còn nguyên thùng, hộp, phụ kiện, sách và những thứ kèm theo Loa). Sẽ đổi mới ngay khi khách hàng mang loa tới và xách định được lỗi (chậm
                    trễ 1-2 ngày) Trường hợp không còn đầy đủ thùng, hộp, phụ kiện, sách và những thứ kèm theo Loa thì sẽ bảo hành theo quy định của Marshall 3-5 ngày có thể sẽ lâu hơn phụ thuộc vào tình trạng loa Khi bảo hành cần có phiếu xuất kho kiêm
                    bảo hành hoặc mã đơn hàng hoặc số điện thoại đã mua hàng. Sản phẩm còn nguyên vẹn không bị vào nước, không bị va đập, không bị tháo rời, không bị tác động từ người dùng <br> <b>II. Từ chối bảo hành</b>. <br> sản phẩm bị vào nước. <br>                    Sản phẩm không còn nguyên vẹn hình dạng ban đầu. <br> Sản phẩm bị va đập mạnh. <br> Sản phẩm không check được thông tin đã bán hàng (SĐT, mã đơn hàng…) <br> Sản phẩm bị tác động bởi người sử dụng. <br> <b>III. Thời gian & cách thức bảo hành.</b>                    <br> Khi phát sinh lỗi sản phẩm cần bảo hành quý khách vui lòng liên hệ số điện thoại hỗ trợ bảo hành 0922.758.666 hoặc email info@Marshallvietnam.vn để được tư vấn hướng dẫn bảo hành. Quý khách cần cung cấp thông tin về sản phẩm,
                    số đơn hàng, phiếu xuất kho kiêm bảo hành. Quý khách ở nội thành Hà Nội mang sản phẩm trực tiếp tới Marshallvietnam.vn sẽ được bảo hành đổi mới sản phẩm ngay. Nếu quý khách ở ngoại thành Hà Nội & tỉnh khác thì sẽ gửi sản phẩm qua đường
                    chuyển phát (Viettel Post, Giaohangtietkiem, Giaohangnhanh, VNPT, EMS, DHL…) về Phukienvang thời gian bảo hành sẽ từ 2-7 ngày. Khi nhận được sản phẩm Marshall Việt Nam sẽ kiểm tra nếu đủ điều kiện sẽ đổi mới và thông báo và gửi lại
                    quý khách qua đường chuyển phát (chi phí quý khách hàng sẽ thanh toán) Quý khách vui lòng đóng gói sản phẩm rồi gửi chuyển phát nhanh qua (Viettel Post, Giaohangtietkiem, giaohangnhanh, VNPT, EMS, DHL, J&T…) về Marshall Việt Nam theo
                    địa chỉ: <br> Người nhận: MARSHALL VIỆT NAM <br> Điện thoại: 0922.758.666 <br> Đia chỉ: 180D Thái Thịnh, Láng Hạ, Đống Đa, Hà Nội <br> Nội dung: Bảo hành đơn hàng số (#1234…) <br> <b>IV. Chi phí bảo hành</b> <br> Marshall Việt Nam
                    sẽ bảo hành miễn phí khi quý khách mang hàng trực tiếp tới Đia chỉ: 180D Thái Thịnh, Láng Hạ, Đống Đa, Hà Nội Quý khách bảo hành qua đường chuyển phát sẽ chịu mọi chi phí vận chuyển do bên vận chuyển quy định.
                </p>
            </div>
        </div>
        <div class="footer w-[100%] text-white bg-[#757575] mt-[32px] flex justify-center">
            <div class="footer-support mx-[16px]">
                <a href="">Tin Tức</a> <br>
                <a href="">Thanh Toán</a> <br>
                <a href="">Giao Hàng</a> <br>
                <a href="">Bảo Hành</a>
            </div>
            <div class="footer-company mx-[16px] py-[16px] ml-[200px]">
                <p>CÔNG TY CỔ PHẦN MOCATO VIỆT NAM <br> - Hotline: 0973.1188.35 <br> - ĐC: 180D Thái Thịnh, P.Láng Hạ, Q.Đống Đa, TP.Hà Nội</p>
            </div>

        </div>
    </div>
</body>

</html>