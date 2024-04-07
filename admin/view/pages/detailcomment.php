<?php



if(isset($_GET["id"])){
$id = $_GET['id'];
  $data = selectAll($conn,"SELECT * FROM `tbl_comment` where product_id=$id");

}
if (isset($_POST['item'])) {
  $selectedItems = $_POST['item'];
  print_r($selectedItems);
 
  foreach ($selectedItems as $item) {
    
    delete($conn,"DELETE FROM `tbl_comment` WHERE id=$item");
    header("Location:index.php?url=detailcomment");   
  }
}

if(isset($_GET['commentid'])){
   $idcomment = $_GET['commentid'];
  
   delete($conn,"DELETE FROM `tbl_comment` WHERE id=$idcomment");
   header("Location:index.php?url=detailcomment");
    
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
</style>


<div class="wrapper" style="width:70%">
   <h2 style="padding: 20px; border-radius:10px;color:green">CHI TIẾT BÌNH LUẬN</h2>
   <form method="post">

      <table id="customers">
         <tr>
            <th></th>
            <th>Nội dung </th>
            <th>Ngày BL </th>
            <th>Người BL </th>

            <th> </th>

         </tr>
         <?php
               if($data){
                  foreach ($data as $key ) {
                   
                
               ?>
         <tr>

            <td><input type="checkbox" name="item[]" value="<?php echo $key['id'] ?>"></td>
            <td><?php echo $key["content"] ?></td>
            <td><?php echo $key["date"] ?></td>
            <td><?php echo $key["custumer_id"] ?></td>

            <td> <button><a
                     href="?id=<?php echo $key['product_id'] ?>&commentid=<?php echo $key['id'] ?>">Xóa</a></button>
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

      </div>
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