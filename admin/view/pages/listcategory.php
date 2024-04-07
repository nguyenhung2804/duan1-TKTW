<?php

$data = selectAll($conn, "SELECT * FROM `tbl_category` where hidden=0");

if (isset($_POST["btnadd"])) {

   header("Location:index.php?url=category");

}
if (isset($_POST['item'])) {
   $selectedItems = $_POST['item'];
   print_r($selectedItems);

   foreach ($selectedItems as $items) {

      delete($conn, "DELETE FROM `tbl_category` WHERE id=$items");
      header("Location:index.php?url=listcategory");
   }
}


if (isset($_POST['deleteorder'])) {


   $id = $_POST['id'];
   delete($conn, "UPDATE `tbl_category` SET `hidden`='1' WHERE id=$id");
    header("Location:index.php?url=listcategory");
  
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
            <th>Mã loại </th>
            <th>Tên loại </th>
            <th></th>

         </tr>
         <?php
               if ($data) {
                  foreach ($data as $key) {


                     ?>
         <tr>

            <td><input type="checkbox" name="item[]" value="<?php echo $key['id'] ?>"></td>
            <td>
               <?php echo $key["id"] ?>
            </td>
            <td>
               <?php echo $key["categoryname"] ?>
            </td>
            <td style="display: flex; align-item:center;">
               <p
                  style="width: 70px; height:30px;background:yellow ;border-radius:10px; text-align:center;line-height:2">
                  <a href="index.php?url=category&id=<?php echo $key['id'] ?>">Sửa</a>
               </p>
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
      <div class="button">
         <div onclick="handleclick()">Chọn tất cả</div>
         <div onclick="handleclose()">Bỏ chọn tất cả</div>
         <button type="submit" name="btndelete">Xóa các mục chọn</button>
         <button type="submit" name="btnadd">Nhập thêm</button>
      </div>
   </form>

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