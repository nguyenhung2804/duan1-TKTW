<?php


$itemsPerPage = 3;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
   $currentPage = (int)$_GET['page'];
} else {
   $currentPage = 1;
}
$startFrom = ($currentPage - 1) * $itemsPerPage;
$data  = selectAll($conn,"SELECT * FROM `tbl_order` where confim=0  LIMIT $startFrom, $itemsPerPage");
 $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_order where confim=0 ");
    $totalPages = ceil($countSql[0]['total']/ $itemsPerPage);

   
   $toast = array();
    if(isset($_POST['xacnhan'])){
         $id= $_POST['name1'];
         $check = $_GET['check'];
         updatedata($conn,"UPDATE `tbl_order` SET `status`=1 WHERE id=$id");
        $toast['text'] = "Bạn đã xác nhận đơn hàng";
         header("Location:index.php?url=order&page=$currentPage&check=".$check);
         
    }
    if(isset($_POST['danggiao'])){
       $id= $_POST['name2'];
        $check = $_GET['check'];
         updatedata($conn,"UPDATE `tbl_order` SET `status`=2 WHERE id=$id");
          $toast['text'] = "Bạn đã chuyển trạng thái đơn hàng đơn hàng";
          header("Location:index.php?url=order&page=$currentPage&check=".$check);
      
    }
    if(isset($_GET['check'])){
      if($_GET['check']=="0"){
       $data  = selectAll($conn,"SELECT * FROM `tbl_order` where confim=0  LIMIT $startFrom, $itemsPerPage");
 $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_order where confim=0 ");
 
      }
    }

    if(isset($_GET['check'])){
      if($_GET['check']=="1"){
         $data  = selectAll($conn,"SELECT * FROM `tbl_order` where status=0 and confim=1   LIMIT $startFrom, $itemsPerPage");
 $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_order where status=0 and confim=1 ");
 
      }
    }
    
     if(isset($_GET['check'])){
      if($_GET['check']=="2"){
         $data  = selectAll($conn,"SELECT * FROM `tbl_order` where status=1  LIMIT $startFrom, $itemsPerPage");
         $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_order where status=1 ");
         
      }
    }
    if(isset($_GET['check'])){
      if($_GET['check']=="3"){
         $data  = selectAll($conn,"SELECT * FROM `tbl_order` where status=2  LIMIT $startFrom, $itemsPerPage");
 $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_order where status=2 ");
 
      }
    }
    $totalPages = ceil($countSql[0]['total']/ $itemsPerPage);
   $check = $_GET['check'];

   

    
?>
<style>
* {

   margin: 0;
   padding: 0;
   box-sizing: border-box;
}

ul {
   padding-left: 0 !important;
}

p {

   margin-bottom: 0 !important;
}

.container {
   width: 1300px;
   margin: 0 auto;
}

.headermenu ul {
   display: flex;
   gap: 18px;
   align-items: center;
}

.headermenu ul li {


   list-style: none;

}

.headermenu ul li a {
   color: white;
   text-decoration: none;


}

.headeractive {
   font-size: 20px;
}

#customers {
   font-family: Arial, Helvetica, sans-serif;
   border-collapse: collapse;
   width: 100%;
}

#customers td,
#customers th {
   border: 1px solid #ddd;
   padding: 8px;
}


#customers th {
   padding-top: 12px;
   padding-bottom: 12px;
   text-align: left;
   background-color: #d6cdc5;
   color: black;
}

button {
   width: 100px;
   height: 40px;
   border-radius: 5px;

   background: white;
}
</style>


<div class="wrapper" style="width:70%">
   <h2 style="padding: 20px; border-radius:10px;color:green">QUẢN LÝ ĐƠN HÀNG</h2>
   <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">


         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="# " role="button" data-bs-toggle="dropdown"
                     aria-expanded="false">
                     Trạng thái
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="<?php  echo "index.php?url=order&page=$currentPage&check=0" ?>">
                           Đơn
                           hàng khách hàng chưa xác thực</a></li>
                     <li><a class="dropdown-item" href="<?php  echo "index.php?url=order&page=$currentPage&check=1" ?>">
                           Đơn
                           hàng khách hàng
                           đã xác thực</a></li>
                     <li><a class="dropdown-item" href="<?php  echo "index.php?url=order&page=$currentPage&check=2" ?>">
                           Đơn
                           hàng đang
                           giao</a></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <li><a class="dropdown-item"
                           href="<?php  echo "index.php?url=order&page=$currentPage&check=3" ?>">Đơn
                           hàng đã giao</a>
                     </li>
                  </ul>
               </li>

            </ul>
            <form class="d-flex" role="search">
               <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
               <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
         </div>
      </div>
   </nav>
   <h3 style="text-align: center;margin-top:20px;"><?php
         if(isset($_GET['check'])){
 if($_GET['check']=="1"){
echo "Đơn hàng khách hàng đã xác thực.";
         }elseif($_GET['check']=="0"){
echo "Đơn hàng khách hàng chưa xác thực.";
         }
         elseif($_GET['check']=="2"){
echo "Đơn hàng đang giao.";
         }elseif($_GET['check']=="3"){
echo "Đơn hàng đã giao .";
         } 
         }else{
 echo "Đơn hàng khách hàng chưa xác thực.";
         }
           ?></h3>
   <table id="customers">
      <tr>
         <th>Mã đơn</th>
         <th>Tên sản phẩm</th>
         <th>Số lượng</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Address</th>
         <th>name</th>
         <th>Tổng</th>
         <?php
               
              

               if(!isset($_GET['check'])|| $_GET['check']==0){

               }else{

               ?>
         <th>Action</th>
         <?php
               }
               ?>


      </tr>
      <?php
            foreach ($data as $key ) {
              ?>
      <tr>
         <td><?php echo $key['order_code'] ?></td>
         <td><?php echo $key['productname'] ?></td>
         <td><?php echo $key['quantity'] ?></td>
         <td><?php echo $key['email'] ?></td>
         <td><?php echo $key['phone_number'] ?></td>
         <td><?php echo $key['address'] ?></td>
         <td><?php echo $key['name'] ?></td>
         <td><?php echo number_format($key['sum'], 0, ',', '.') . '₫' ; ?></td>


         <?php  
              
              if($key['status'] ==0){

               if(!isset($_GET['check'])|| $_GET['check']==0){

               }else{

              
               ?>

         <td>

            <form method="post">
               <input type="text" name="name1" value="<?php echo $key['id'] ?>" hidden>
               <button type="submit" class="oneorder btn btn-primary" name="xacnhan">Đang giao</button>
            </form>
         </td>

         <?php
                }
              }else if($key['status'] ==1){
               ?>
         <td>

            <form method="post">
               <input type="text" name="name2" value="<?php echo $key['id'] ?>" hidden>
               <button type="submit" class="twoorder btn btn-warning" name="danggiao">Hoàn tất</button>
            </form>
         </td>

         <?php
              }else{
               ?>
         <td>
            <form method="post"> <button type="submit" class="btn btn-success" name="thanhcong">Xóa đơn</button></form>
         </td>


         <?php
              }
              ?>

      </tr>
      <?php
            }
            
            ?>


   </table>
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

            <?php echo "<a href='index.php?url=order&page=$i&check=$check'> $i </a>" ?></li>
         <?php

         }

         ?>



      </ul>
   </div>

</div>

</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
let twoorder = document.querySelectorAll(".twoorder");

twoorder.forEach(item => {
   return item.addEventListener("click", function() {

      localStorage.setItem("toastMessage", "Bạn đã chuyển trạng thái thành công");
   })
})

let oneorder = document.querySelectorAll(".oneorder");


oneorder.forEach(item => {
   return item.addEventListener("click", function() {

      localStorage.setItem("toastMessage", "Bạn đã xác nhận đơn hàng thành công");
   })
})
</script>
<script>
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

      }, 1000)
   }
});
</script>

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