<?php

$data = selectAll($conn,"SELECT  tbl_category.categoryname, COUNT(*) AS count,MAX(tbl_product.price) AS max, MIN(tbl_product.price) AS min,AVG(tbl_product.price)as tb   FROM `tbl_product`  INNER JOIN tbl_category on `tbl_product`.category_id=tbl_category.id group by category_id");

$mon1 = selectAll($conn,"SELECT * FROM tbl_order WHERE MONTH(creat_at) = 4 AND YEAR(creat_at) = 2023 and status=2");
$tong1 =0;
foreach ($mon1 as $key ) {
   $tong1+=$key['sum'];
}

$mon2 = selectAll($conn,"SELECT * FROM tbl_order WHERE MONTH(creat_at) = 5 AND YEAR(creat_at) = 2023 and status=2");
$tong2 =0;
foreach ($mon2 as $key ) {
   $tong2+=$key['sum'];
}
$mon3 = selectAll($conn,"SELECT * FROM tbl_order WHERE MONTH(creat_at) = 6 AND YEAR(creat_at) = 2023 and status=2");
$tong3 =0;
foreach ($mon3 as $key ) {
   $tong3+=$key['sum'];
}
$mon4 = selectAll($conn,"SELECT * FROM tbl_order WHERE MONTH(creat_at) = 7 AND YEAR(creat_at) = 2023 and status=2");
$tong4 =0;
foreach ($mon4 as $key ) {
   $tong4+=$key['sum'];
}
$mon5 = selectAll($conn,"SELECT * FROM tbl_order WHERE MONTH(creat_at) = 8 AND YEAR(creat_at) = 2023 and status=2");
$tong5 =0;
foreach ($mon5 as $key ) {
   $tong5+=$key['sum'];
}


$mon6 = selectAll($conn,"SELECT * FROM tbl_order WHERE MONTH(creat_at) = 9 AND YEAR(creat_at) = 2023 and status=2");
$tong6 =0;
foreach ($mon6 as $key ) {
   $tong6+=$key['sum'];
}
$staticalall = [$tong1,$tong2,$tong3,$tong4,$tong5,$tong6];

$jsonDatastatis = json_encode($staticalall);








?>
<?php

$datacate= array(
    array('Task', 'Hours per Day'),);
    $product = selectAll($conn,"SELECT  tbl_category.categoryname, COUNT(*) AS count,MAX(tbl_product.price) AS max, MIN(tbl_product.price) AS min,AVG(tbl_product.price)as tb   FROM `tbl_product`  INNER JOIN tbl_category on `tbl_product`.category_id=tbl_category.id group by category_id");
    foreach ($product as $key) {
      array_push($datacate,array("$key[categoryname]",+$key['count']));

      
    }
    

$jsonData = json_encode($datacate);




?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {
   'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
   var data = google.visualization.arrayToDataTable(<?php echo $jsonData ?>);

   var options = {
      title: 'Tỉ lệ hàng hóa',
      pieHole: 0.4,
      is3D: true
   };

   var chart = new google.visualization.PieChart(document.getElementById('piechart'));
   chart.draw(data, options);
}
</script>

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
   margin-top: 20px;
   background: white;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="wrapper" style="width:70%">
   <h2 style="padding: 20px; border-radius:10px;color:green">THỐNG KÊ TỪNG LOẠI HÀNG</h2>
   <table id="customers">
      <tr>
         <th>Loại hàng</th>
         <th>Số lượng </th>
         <th>Giá cao nhất </th>
         <th>Giá thấp nhất</th>
         <th>Giá trung bình</th>
      </tr>
      <?php
            foreach ($data as $key ) {
                $max = number_format($key['max'], 0, ',', '.') . '₫';
                $min = number_format($key['min'], 0, ',', '.') . '₫';
                $tb = number_format($key['tb'], 0, ',', '.') . '₫';
              ?>
      <tr>
         <td><?php echo $key['categoryname'] ?> </td>
         <td><?php echo $key['count'] ?></td>
         <td><?php echo $max ?></td>
         <td><?php echo $min ?></td>
         <td><?php echo $tb ?></td>
      </tr>

      <?php
            }
            
            ?>

   </table>
   <h2 style="text-align: center; margin:20px;">Thống kê biểu đồ</h2>
   <div class="wrapper" style="width:100% ;display:flex;">


      <div class="width:50%;">

         <div id="piechart" style="width: 400px; height: 300px;margin:0 auto;"></div>
         <p style="text-align:center;">Tỷ lệ hàng hóa</p>
      </div>
      <div style="width: 50%; text-align:center;  margin: auto">
         <canvas style="height: 300px;" id="revenueChart"></canvas>
         <p style="margin-top: 80px; ">Doanh số đơn hàng trong 6 tháng gần nhất</p>
      </div>


   </div>

</div>

</div>
<script>
// Dữ liệu thống kê
const data = {
   labels: [
      "Tháng 4",
      "Tháng 5",
      "Tháng 6",
      "Tháng 7",
      "Tháng 8",
      "Tháng 9",
   ],
   datasets: [{
      label: "Doanh thu (VNĐ)",
      backgroundColor: "rgba(75, 192, 192, 0.2)",
      borderColor: "rgba(75, 192, 192, 1)",
      borderWidth: 1,
      data: <?php echo $jsonDatastatis; ?>,
   }, ],
};

// Cấu hình biểu đồ
const config = {
   type: "line", // Loại biểu đồ (line, bar, pie, ...)
   data: data,
   options: {
      responsive: true,
      scales: {
         y: {
            beginAtZero: true,
         },
      },
   },
};

// Tạo biểu đồ
const revenueChart = new Chart(
   document.getElementById("revenueChart"),
   config
);
</script>