<?php

include("connect.php");
// get page number
// if page is empty return  $_GET['page'] else return 1 ;
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if ( !empty($_POST['q_day']) && !empty($_POST['q_day2'])) {
    $sql_search = " where day >= '" . $_POST['q_day'] . "' AND day <= '" . $_POST['q_day2'] . "'";
} else {
    $sql_search = '';
}

$rs = $conn->query("select count(temp) as num FROM dht22 $sql_search ");
// echo $sql_search;
$totalRow =  $rs->fetch_array()['num'];
$rowPerPage = 10;  // show 8 rows per a page
// calulate number of Pages
if ($totalRow == 0)
    $totalPage = 1;
else
    $totalPage = ceil($totalRow / $rowPerPage); // ceil หารแล้วปัดเศษขึ้น
// calculate Start row
$startRow = ($page - 1) * $rowPerPage;

$Next_Page = $page+1;
// query
$rs = $conn->query("select * from dht22 $sql_search ORDER by id DESC limit $startRow,$rowPerPage "); // limit เริ่มที่ , จำนวนที่ต้องการแสดง
//echo $conn->error ; // for check error ;
?>
<table class="table">
    <tr>
        <th><p1 class="ex">บ่อ</p1></th>
        <th><p1 class="ex">อุณหภูมิ</p1></th>
        <th>ความชื้น</th>
        <th>วันเวลา</th>
    </tr>
    <?php
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_array()) {
    ?>
            <tr>
                <td><?php echo $row['room']; ?></td>
                <td><?php echo $row['temp']; ?></td>
                <td>
                    <?php echo $row['humi']; ?></td>
                <td>
                    <?php echo $row['day']; ?></td>
                <td>


                <td>
                    <a href="#" class="btn btn-outline-danger" onclick="javascript:del('<?php echo $row['id']; ?>');"><i class='fa fa-trash'></i></a>
                </td>
            </tr>
    <?php
        }
    }
    ?>
</table>
<!-- bootstrap pagination -->
<ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" href="#"><?php echo 'หน้าที่ ', $page; echo ' : ';  ?>&laquo;</a></li>
    <?php
    for ($i = 1; $i <= $totalPage; $i++) {
    ?>
        <li class="page-item" <?php echo ($i == $page) ? 'class="page-item"' : '' ?>><a class="page-link" href="javascript:show(<?php echo $i; ?>)"><?php echo $i; ?></a></li>

    <?php
    }
    ?>
</ul>
<br>
<div id="container" style="height: 370px; width: 100%;"></div><br>

<?php
//get total rows Temp-----------------------------------------------------------------------------
$rs1 = $conn->query("select avg(temp) FROM dht22 $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs1->fetch_array()){  ?>
  <?php
  $avg_temp = $row['avg(temp)'];
  //echo number_format($avg_temp,2,'.','');?>
  <div class="card-deck">
    <div class="card bg-secondary">
       <div class="card-header text-secondary bg-light">อุณหภูมิเฉลี่ย</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($avg_temp,2,'.',''); echo " °C";?></h2><br>
    </div>

  <?php
}
$rs_min = $conn->query("select min(temp) FROM dht22 $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs_min->fetch_array()){  ?>
  <?php
  $min_temp = $row['min(temp)'];
  //echo number_format($avg_temp,2,'.','');?>
    <div class="card bg-info">
      <div class="card-header text-info bg-light">อุณหภูมิน้อยที่สุด</div>
      <br><h2 class="card-text text-center text-white" ><?php echo number_format($min_temp,2,'.',''); echo " °C";?></h2><br>
    </div>
  <?php
}
$rs_min = $conn->query("select max(temp) FROM dht22 $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs_min->fetch_array()){  ?>
  <?php
  $max_temp = $row['max(temp)'];
  //echo number_format($avg_temp,2,'.','');?>
    <div class="card bg-warning">
      <div class="card-header text-warning bg-light">อุณหภูมิมากที่สุด</div>
      <br><h2 class="card-text text-center text-white" ><?php echo number_format($max_temp,2,'.',''); echo " °C";?></h2><br>
    </div>
  </div>
  <br>
  <?php
}
?>
<?php

   $rs = $conn->query("select * from dht22 $sql_search ORDER by id DESC limit 10 ");

   $humi = array();
   $temp = array();
   $day = array();
   while ($row = $rs->fetch_array()) {
   	 array_push($humi,$row["humi"]);
     array_push($day,$row["day"]);
     array_push($temp,$row["temp"]);
   }
?>
<script type="text/javascript">
$(function show(page) {
  $('#container').highcharts(
    {
    chart: {
      type: 'line'
    },
    title: {
      text: 'อุณหภูมิ'
    },
    xAxis: {
      title: {
        text: 'วันที่และเวลา'
      } ,
      categories: ['<?= implode("','", $day); ?>']
    },
    yAxis: {
      title: {
        text: 'อุณหภูมิและความชื้น'
      },
    },
    series: [{
      name: 'อุณหภูมิ',
      data: [<?= implode(',', $temp) ?>],
      color: '#119B9D',
    },
      {
      name: 'ความชื้น',
      data: [<?= implode(',', $humi) ?>],
      color: '#FF7F50',
      }]

  });
});
</script>
<!--//get total rows Temp----------------------------------------------------------------------------->

<?php
//get total rows Temp-----------------------------------------------------------------------------
$rs2 = $conn->query("select avg(humi) FROM dht22 $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs2->fetch_array()){  ?>
  <?php
  $avg_humi = $row['avg(humi)'];
  //echo number_format($avg_temp,2,'.','');?>
  <div class="card-deck">
    <div class="card bg-dark">
       <div class="card-header text-dark bg-light">ความชื้นเฉลี่ย</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($avg_humi,2,'.',''); echo " °C";?></h2><br>
    </div>

  <?php
}
$rs_min = $conn->query("select min(humi) FROM dht22 $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs_min->fetch_array()){  ?>
  <?php
  $min_humi = $row['min(humi)'];
  //echo number_format($avg_temp,2,'.','');?>
    <div class="card bg-primary">
      <div class="card-header text-primary bg-light">ความชื้นน้อยที่สุด</div>
      <br><h2 class="card-text text-center text-white" ><?php echo number_format($min_humi,2,'.',''); echo " °C";?></h2><br>
    </div>
  <?php
}
$rs_min = $conn->query("select max(humi) FROM dht22 $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs_min->fetch_array()){  ?>
  <?php
  $max_humi = $row['max(humi)'];
  //echo number_format($avg_temp,2,'.','');?>
    <div class="card bg-danger">
      <div class="card-header text-danger bg-light">ความชื้นมากที่สุด</div>
      <br><h2 class="card-text text-center text-white" ><?php echo number_format($max_humi,2,'.',''); echo " °C";?></h2><br>
    </div>
  </div>
  <br>
  <?php
}
?>
<!--//get total rows Temp----------------------------------------------------------------------------->
