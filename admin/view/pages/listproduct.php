<?php




$itemsPerPage = 5;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
   $currentPage = (int)$_GET['page'];
} else {
   $currentPage = 1;
}
$startFrom = ($currentPage - 1) * $itemsPerPage;
$data  = selectAll($conn,"SELECT * FROM `tbl_product`  LIMIT $startFrom, $itemsPerPage");
 $countSql = selectAll($conn,"SELECT COUNT(*) as total FROM tbl_product ");
    $totalPages = ceil($countSql[0]['total']/ $itemsPerPage);


if (isset($_POST["btnadd"])) {

   header("Location:index.php?url=product");

}
if (isset($_POST['item'])) {
   $selectedItems = $_POST['item'];
   print_r($selectedItems);

   foreach ($selectedItems as $items) {

      delete($conn, "DELETE FROM `tbl_product` WHERE id=$items");
      header("Location:index.php?url=listproduct");
   }
}


if (isset($_POST['deleteorder'])) {


   $id = $_POST['id'];
  delete($conn, "DELETE FROM `tbl_product` WHERE id=$id");
   header("Location:index.php?url=listproduct");
  
}
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

.input input {
   width: 100%;
}

.button {
   display: flex;
   gap: 10px;
   margin-top: 20px;
}

.button button {
   width: 100px;
   height: 40px;
   border-radius: 5px;

   background: white;
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
   width: 70px;
   height: 30px;
   border-radius: 5px;
   color: black;

}

button a {
   text-decoration: none;
   color: black;
}

.button button {
   width: 150px;
   height: 40px;
   border-radius: 5px;

   background: white;
}

.button div {
   width: 150px;
   height: 40px;
   border-radius: 5px;
   border: 2px solid black;
   background: white;
   text-align: center;
   line-height: 36px;
}

.modal-order {
   position: fixed;
   top: 0;
   left: 0;
   background: rgba(0, 0, 0, .5);
   width: 100%;
   height: 100vh;
   display: flex;
   justify-content: center;
   align-items: center;
   opacity: 0;
   pointer-events: none;
}

.active {
   opacity: 1;
   transform: scale(1);
   transition: all .5s;
   box-shadow: 0 0 10px grey;
   pointer-events: all;
}

.modal-order-item {
   width: 400px;
   height: 200px;
   background: white;
   box-shadow: 0 0 10px grey;
   padding: 20px;
}
</style>


<div class="wrapper" style="width:70%">
   <h2 style="padding: 20px; border-radius:10px;color:green">QUẢN LÝ LOẠI HÀNG</h2>
   <form method="post">

      <table id="customers">
         <tr>
            <th></th>
            <th>STT </th>
            <th>Ảnh</th>
            <th>Tên HH </th>
            <th>Đơn giá </th>
            <th>Giảm giá </th>
            <th>Số lượng</th>
            <th> </th>

         </tr>
         <?php
               if ($data) {
                  $i=0;
                  foreach ($data as $key) {
                     $i++;
                     $price = number_format($key['price'], 0, ',', '.') . '₫';
                     $saleprice = number_format((($key['price'] - $key['saleprice']) / $key['price']) * 100,2);

                     ?>
         <tr>

            <td><input type="checkbox" name="item[]" value="<?php echo $key['id'] ?>"></td>
            <td>
               <?php echo $i ?>
            </td>
            <td>
               <img src=" <?php echo $key['image'] ?>" width="50" height="50" alt="">
            </td>
            <td>
               <?php echo $key["productname"] ?>
            </td>
            <td>
               <?php echo $price ?>
            </td>
            <td>
               <?php echo $saleprice ?>%
            </td>
            <td>
               <?php echo $key["quantity"] ?>
            </td>
            <td><button><a href="index.php?url=product&id=<?php echo $key['id'] ?>">Sửa</a></button>
               <div>
                  <input type="text" class="valuedelete" value="<?php echo $key['id'] ?>" name="id" hidden>



                  <p style="width: 70px; height:30px;background:red ;border-radius:10px; text-align:center;line-height:2"
                     class="modalcheck-open">Xóa</p>


               </div>
            </td>

         </tr>
         <?php
                  }
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
               <?php echo "<a href='index.php?url=listproduct&page=$i'> $i </a>" ?></li>
            <?php

         }

         ?>



         </ul>
      </div>
      <div class="button">
         <div onclick="handleclick()">Chọn tất cả</div>
         <div onclick="handleclose()">Bỏ chọn tất cả</div>
         <button type="submit" name="btndelete">Xóa các mục chọn</button>
         <button type="submit" name="btnadd">Nhập thêm</button>
      </div>

</div>
<div class="modal-order">
   <div class="modal-order-item">
      <h3 class="mb-[15px]">Hủy đơn hàng</h3>
      <hr>
      <p class="mt-[20px]">Bạn có thực sự muốn hủy đơn hàng.</p>

      <form method="post" class="flex justify-end ">
         <div class=" flex justify-end mt-[30px]">
            <input type="text" name="id" style="opacity: 0;" class="values">
            <div class="" style="display: flex; align-item:center;float:right;margin-top:20px;">
               <button type="submit"
                  style="width: 60px; height:30px;background:red;border-radius:10px; text-align:center;color:white;" ;
                  name="deleteorder" class="deleteorder ">Yes</button>
               <p class="closedelete "
                  style="width: 60px; height:30px;background:grey;border-radius:10px; text-align:center;line-height:2;color:white;margin-left:15px;">
                  No</p>

            </div>


         </div>
      </form>
   </div>

</div>

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

</form>

</div>

</div>
<script>
function handleclick() {
   var checkboxes = document.querySelectorAll('input[type="checkbox"][name="item[]"]');

   checkboxes.forEach(function(item) {

      item.checked = true
   });
}

function handleclose() {
   var checkboxes = document.querySelectorAll('input[type="checkbox"][name="item[]"]');

   checkboxes.forEach(function(item) {
      item.checked = false
   });
}
</script>
<script>
let opendelete = document.querySelectorAll(".modalcheck-open");
let valuedelete = document.querySelectorAll(".valuedelete");
let deleteoerder = document.querySelector(".modal-order");
let closedelete = document.querySelector(".closedelete");
let values = document.querySelector(".values");

opendelete.forEach((item, index) => {
   return item.addEventListener("click", function() {

      deleteoerder.classList.toggle("active");
      values.value = valuedelete[index].value




   })
})


closedelete.addEventListener("click", function() {

   deleteoerder.classList.remove("active")
})
</script>