
<?php
include("connect.php");
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if (!empty($_POST['q_name']) && !empty($_POST['q_day']) && !empty($_POST['q_day2'])) {
    $sql_search = " AND room = '" . $_POST['q_name'] . "' AND date_start >= '" . $_POST['q_day'] . "' AND date_start <= '" . $_POST['q_day2'] . "'";
} else {
    $sql_search = '';
}


$count_statusYES_rs = $conn->query("select count(status) FROM start_end Where status = 'ยังไม่เก็บเกี่ยว' $sql_search"); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $count_statusYES_rs->fetch_array()){  ?>
  <?php
  $count_statusYES = $row['count(status)'];?>
  <div class="card-deck">
  <div class="card bg-secondary">
      <div class="card-header text-secondary bg-light">จำนวนยังไม่เก็บทั้งหมด</div>
      <br><h2 class="card-text text-center text-white" ><?php echo ($count_statusYES); echo " ครั้ง";?></h2><br>
   </div>

  <?php
}
?>
<?php
$weigh_start_sum_rs = $conn->query("select sum(weigh_start) FROM start_end Where status = 'ยังไม่เก็บเกี่ยว'  $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $weigh_start_sum_rs->fetch_array()){  ?>
  <?php
  $sum_weigh_start = $row['sum(weigh_start)'];?>
    <div class="card bg-success ">
       <div class="card-header text-success bg-light">น้ำหนักที่นำเข้าทั้งหมด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($sum_weigh_start,2,'.',''); echo " กรัม";?></h2><br>
    </div>
    <?php
}
$weigh_start_avg_rs = $conn->query("select avg(weigh_start) FROM start_end Where status = 'ยังไม่เก็บเกี่ยว' $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $weigh_start_avg_rs->fetch_array()){  ?>
  <?php
  $avg_weigh_start = $row['avg(weigh_start)'];?>
    <div class="card bg-warning">
       <div class="card-header text-warning bg-light">น้ำหนักที่นำเข้าเฉลี่ยทั้งหมด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($avg_weigh_start,2,'.',''); echo " กรัม";?></h2><br>
    </div>
    </div>
  <?php
}?>
<br><br>
<?php
$min_weigh_rs = $conn->query("select room,weigh_start,date_start,status FROM start_end Where status = 'ยังไม่เก็บเกี่ยว' $sql_search AND weigh_start=(select min(weigh_start) from start_end Where status = 'ยังไม่เก็บเกี่ยว' $sql_search)  ");
while($row = $min_weigh_rs->fetch_array()){  ?>
  <?php
  $min_weigh_start = $row['weigh_start'];
  $room_weigh_start = $row['room'];
  $date_start = $row['date_start'];?>
  <div class="card-deck">
    <div class="card bg-info">
       <div class="card-header text-info bg-light">น้ำหนักที่นำเข้าน้อยที่สุด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($min_weigh_start,2,'.',''); echo " กรัม";?></h2><br>
       <div class="card-footer text-white">
         <?php echo "บ่อ: ", $room_weigh_start ," วันที่เริ่มเลี้ยง ", $date_start ; ?>
      </div>
    </div>
    <br>
  <?php
}
$max_weigh_rs = $conn->query("select room,weigh_start,date_start FROM start_end Where status = 'ยังไม่เก็บเกี่ยว' $sql_search AND weigh_start=(select max(weigh_start) from start_end Where status = 'ยังไม่เก็บเกี่ยว' $sql_search)  ");
while($row = $max_weigh_rs->fetch_array()){  ?>
  <?php
  $max_weigh_start = $row['weigh_start'];
  $room_weigh_start = $row['room'];
  $date_start = $row['date_start'];?>
    <div class="card bg-primary">
       <div class="card-header text-primary bg-light">น้ำหนักที่นำเข้ามากที่สุด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($max_weigh_start,2,'.',''); echo " กรัม";?></h2><br>
       <div class="card-footer text-white">
         <?php echo "บ่อ: ", $room_weigh_start ," วันที่เริ่มเลี้ยง ", $date_start ; ?>
      </div>
    </div>
    </div>
    <br>
  <?php
}
?>

<br><br>
