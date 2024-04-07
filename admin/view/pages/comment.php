<?php

$data = selectAll($conn,"SELECT  tbl_comment.content, tbl_comment.date ,tbl_comment.product_id,tbl_product.productname, COUNT(*) AS comment_count,MAX(tbl_comment.date) AS latest_date, MIN(tbl_comment.date) AS oldest_date  FROM `tbl_comment`  INNER JOIN tbl_product on `tbl_comment`.product_id=tbl_product.id group by product_id");
// echo "<pre>";
// print_r($data);
// echo "</pre>";



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
   <h2 style="padding: 20px; border-radius:10px;color:green">QUẢN LÝ BÌNH LUẬN</h2>
   <table id="customers">
      <tr>
         <th>Hàng hóa</th>
         <th>Số bình luận</th>
         <th>Mới nhất</th>
         <th>Cũ nhất</th>
         <th></th>
      </tr>
      <?php
            foreach ($data as $key ) {
              ?>
      <tr>
         <td><?php echo $key['productname'] ?></td>
         <td><?php echo $key['comment_count'] ?></td>
         <td><?php echo $key['latest_date'] ?></td>
         <td><?php echo $key['oldest_date'] ?></td>
         <td><button><a href="index.php?url=detailcomment&id=<?php echo $key['product_id'] ?>">Chi tiết</a></button>
         </td>
      </tr>
      <?php
            }
            
            ?>


   </table>

</div>

</div>