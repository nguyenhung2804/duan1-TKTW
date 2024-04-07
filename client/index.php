<?php
// GLOBAL

require("../database/connect.php");
require("../service/crud.php");
// MODELS




// HEADER
require("../client/view/layout/header.php");

// CONTENT
if(isset($_GET['url'])) {
    switch ($_GET['url']) {
        
        case 'cart':
       require("../client/view/pages/giohang.php");
        break;
    //ORDER
        //danh sách đơn hàng
    case 'order':
       require("../client/view/pages/pay.php");
        break;

        case 'order-check':
           

       require("../client/view/pages/ordercheck.php");
        break;

        //chi tiết đơn hàng
    case 'order-detail':
          require("../client/view/pages/donhangchitiet.php");
        break;

        //thêm/chỉnh sửa đơn hàng
    case 'allorder':
       require("../client/view/pages/allorder.php");
        break;

          case 'detailorder':
       require("../client/view/pages/detailorder.php");
        break;


        //cập nhật trạng thái đơn hàng
    case 'order-update-status':
        # code...
        break;
        
        
        
    //CATEGORY  
    case 'category':


        if (isset($_GET['id'])) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

// Lấy tên miền
$domain = $_SERVER['HTTP_HOST'];

// Lấy URI (phần sau tên miền)
$uri = $_SERVER['REQUEST_URI'];

// Kết hợp thành URL đầy đủ
$currentURL = $protocol . "://" . $domain . $uri;
    $id = $_GET['id'];
     $itemsPerPage = 2;
     if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int)$_GET['page'];
} else {
    $currentPage = 1;
}
$startFrom = ($currentPage - 1) * $itemsPerPage;
    $data = selectAll($conn, "SELECT * FROM `tbl_product`  where category_id = $id LIMIT $startFrom, $itemsPerPage ");

    $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_product where category_id = $id");
    $totalPages = ceil($countSql[0]['total']/ $itemsPerPage);
   

   
}
        require("../client/view/pages/category.php");
        break; 
    

        
    //PRODUCT
    case 'product':
       require("../client/view/pages/detailproduct.php");
        break;
    

    // CUSTOMER
    case 'search':
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $datasearch = selectAll($conn,"SELECT * FROM tbl_product WHERE productname LIKE '%$search%'");
        }
        require("../client/view/pages/search.php");
        break; 
    case 'customer':
       
        break; 
    
    // COMMENT
    case 'comment':
      
        break;
    // CONTACT
    case 'contact':
      
        break;
    // ĐĂNG XUẤT
    case 'logout':
        
        break;

    // THỐNG KÊ
    default:
        
        break;
}
// THÔNG KÊ
}else{
   require("../client/view/pages/index.php");
    
}

// FOOTER
require("../client/view/layout/footer.php");
?>