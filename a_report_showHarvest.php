
<?php
include("connect.php");
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
if (!empty($_POST['q_name']) && !empty($_POST['q_day']) && !empty($_POST['q_day2'])) {
    $sql_search = " AND room = '" . $_POST['q_name'] . "' AND date_start >= '" . $_POST['q_day'] . "' AND date_start <= '" . $_POST['q_day2'] . "'";
} else {
    $sql_search = '';
}

//------------------------------------------------------------------------------------------------------------------------------------------
$count_statusYES_rs = $conn->query("select count(status) FROM start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search"); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $count_statusYES_rs->fetch_array()){  ?>
  <?php
  $count_statusYES = $row['count(status)'];?>
  <div class="card-deck">
  <div class="card bg-secondary">
      <div class="card-header text-secondary bg-light">จำนวนเก็บแล้วทั้งหมด</div>
      <br><h2 class="card-text text-center text-white" ><?php echo ($count_statusYES); echo " ครั้ง";?></h2><br>
   </div>

  <?php
}
?>
<?php
$weigh_end_sum_rs = $conn->query("select sum(weigh_end) FROM start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search   "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $weigh_end_sum_rs->fetch_array()){  ?>
  <?php
  $sum_end_start = $row['sum(weigh_end)'];?>
    <div class="card bg-success ">
       <div class="card-header text-success bg-light">น้ำหนักที่เก็บแล้วทั้งหมด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($sum_end_start,2,'.',''); echo " กรัม";?></h2><br>
    </div>
    <?php
}
$weigh_end_avg_rs = $conn->query("select avg(weigh_end) FROM start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $weigh_end_avg_rs->fetch_array()){  ?>
  <?php
  $avg_weigh_end = $row['avg(weigh_end)'];?>
    <div class="card bg-primary">
       <div class="card-header text-primary bg-light">น้ำหนักที่เก็บเฉลี่ย</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($avg_weigh_end,2,'.',''); echo " กรัม";?></h2><br>
    </div>
    </div>
  <?php
}?>
<br><br>
<?php
$min_weigh_rs = $conn->query("select room,weigh_end,date_end FROM start_end where status = 'เก็บเกี่ยวแล้ว' $sql_search AND weigh_end=(select min(weigh_end) from start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search  )  ");
while($row = $min_weigh_rs->fetch_array()){  ?>
  <?php
  $min_weigh_end = $row['weigh_end'];
  $room_weigh_end = $row['room'];
  $date_weigh_end = $row['date_end'];?>
  <div class="card-deck">
    <div class="card bg-info">
       <div class="card-header text-info bg-light">น้ำหนักที่เก็บน้อยที่สุด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($min_weigh_end,2,'.',''); echo " กรัม";?></h2><br>
       <div class="card-footer text-white">
         <?php echo "บ่อ: ", $room_weigh_end ," วันที่เก็บ ", $date_weigh_end ; ?>
      </div>
      </div>

  <?php
}
$max_weigh_rs = $conn->query("select room,weigh_end,date_end FROM start_end where status = 'เก็บเกี่ยวแล้ว' $sql_search AND weigh_end=(select max(weigh_end) from start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search )  ");
while($row = $max_weigh_rs->fetch_array()){  ?>
  <?php
  $max_weigh_end = $row['weigh_end'];
  $room_weigh_end = $row['room'];
  $date_weigh_end = $row['date_end'];?>
    <div class="card bg-warning">
       <div class="card-header text-warning bg-light">น้ำหนักที่เก็บมากที่สุด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($max_weigh_end,2,'.',''); echo " กรัม";?></h2><br>
       <div class="card-footer text-white">
         <?php echo "บ่อ: ", $room_weigh_end ," วันที่เก็บ ", $date_weigh_end; ?>
      </div>
    </div>
    </div>
    <br><br>
  <?php
}
?>

<!------------------------------------------------------------------------------------------------------------------------------------------->
<br><br>
<?php
$lost_sum_rs = $conn->query("select sum(lost) FROM start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search  "); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $lost_sum_rs->fetch_array()){  ?>
  <?php
  $sum_lost = $row['sum(lost)'];?>
  <div class="card-deck">
    <div class="card bg-secondary ">
       <div class="card-header text-secondary bg-light">ตายรวมทั้งหมด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo ($sum_lost); echo " กรัม";?></h2><br>
    </div>
    <?php
}
$lost_avg_rs = $conn->query("select avg(lost) FROM start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search"); // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $lost_avg_rs->fetch_array()){  ?>
  <?php
  $lost_end = $row['avg(lost)'];?>
    <div class="card bg-primary">
       <div class="card-header text-primary bg-light">ตายเฉลี่ย</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($lost_end,2,'.',''); echo " กรัม";?></h2><br>
    </div>
    </div>
  <?php
}?>
<?php
$min_lost_rs = $conn->query("select room,lost,date_end FROM start_end where status = 'เก็บเกี่ยวแล้ว'  $sql_search and lost=(select min(lost) from start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search  )  ");
while($row = $min_lost_rs->fetch_array()){  ?>
  <?php
  $min_lost = $row['lost'];
  $room_weigh_end = $row['room'];
  $date_weigh_end = $row['date_end'];?>
  <br><br>
  <div class="card-deck">
    <div class="card bg-info">
       <div class="card-header text-info bg-light">ตายน้อยที่สุด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($min_lost,2,'.',''); echo " กรัม";?></h2><br>
       <div class="card-footer text-white">
         <?php echo "บ่อ: ", $room_weigh_end ," วันที่เก็บ ", $date_weigh_end ; ?>
      </div>
      </div>

  <?php
}
$max_lost_rs = $conn->query("select room,lost,date_end FROM start_end where status = 'เก็บเกี่ยวแล้ว' $sql_search and lost=(select max(lost) from start_end Where status = 'เก็บเกี่ยวแล้ว' $sql_search)  ");
while($row = $max_lost_rs->fetch_array()){  ?>
  <?php
  $max_lost = $row['lost'];
  $room_weigh_end = $row['room'];
  $date_weigh_end = $row['date_end'];?>
    <div class="card bg-warning">
       <div class="card-header text-warning bg-light">ตายมากที่สุด</div>
       <br><h2 class="card-text text-center text-white" ><?php echo number_format($max_lost,2,'.',''); echo " กรัม";?></h2><br>
       <div class="card-footer text-white">
         <?php echo "บ่อ: ", $room_weigh_end ," วันที่เก็บ ", $date_weigh_end; ?>
      </div>
    </div>
    </div>
    <br><br>
  <?php
}
?>

<br><br>
