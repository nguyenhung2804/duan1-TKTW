<?php
// GLOBAL

require("../database/connect.php");
require("../service/crud.php");

session_start();
// MODELS




// HEADER

if(isset($_SESSION['admin'])) {
   require("../admin/view/layout/header.php");

// CONTENT
if(isset($_GET['url'])) {
    switch ($_GET['url']) {
        
        case 'category':
       require("../admin/view/pages/category.php");
        break;
        case 'comment':
       require("../admin/view/pages/comment.php");
        break;
        case 'custumer':
       require("../admin/view/pages/custumer.php");
        break;
        case 'detailcomment':
       require("../admin/view/pages/detailcomment.php");
        break;
         case 'detailimagecolor':
       require("../admin/view/pages/detailimagecolor.php");
        break;
         case 'detailsize':
       require("../admin/view/pages/detailsize.php");
        break;
        case 'detailstatistical':
       require("../admin/view/pages/detailstatistical.php");
        break;
         case 'listcategory':
       require("../admin/view/pages/listcategory.php");
        break;
         case 'listcustumer':
       require("../admin/view/pages/listcustumer.php");
        break;
         case 'listproduct':
       require("../admin/view/pages/listproduct.php");
        break;
         case 'order':
       require("../admin/view/pages/order.php");
        break;
          case 'product':
       require("../admin/view/pages/product.php");
        break;
         case 'statistical':
       require("../admin/view/pages/statistical.php");
        break;
       

    // THỐNG KÊ
    default:
        
        break;
}
// THÔNG KÊ
}else{
   require("../admin/view/pages/home.php");
    
}

// FOOTER
require("../admin/view/layout/footer.php");
}else{
  

   require("../admin/view/pages/login.php");
}


?>