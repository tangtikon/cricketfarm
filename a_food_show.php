<?php
include("check.php") ;
include("connect.php") ;
// get page number
// if page is empty return  $_GET['page'] else return 1 ;
$page = (!empty($_GET['page']))?$_GET['page']:1 ;
if(!empty($_POST['q_name']) && !empty($_POST['q_day1']) && !empty($_POST['q_day2']))
{
  $sql_search = " where room = '" . $_POST['q_name'] . "' AND day >= '" . $_POST['q_day1'] . "' AND day <= '" . $_POST['q_day2'] . "'";

}
else {
  $sql_search = '' ;

}
// echo $_POST['q_name'];
// echo $_POST['q_day1'];
// echo $_POST['q_day2'];
// echo $sql_search;

$rs = $conn->query("select avg(amount) as num FROM food $sql_search ");
//get total rows
$totalRow =  $rs->fetch_array()['num'] ;
$rowPerPage = 10 ;  // show 8 rows per a page
// calulate number of Pages
if($totalRow == 0)
  $totalPage = 1 ;
else
  $totalPage = ceil($totalRow / $rowPerPage)  ; // ceil หารแล้วปัดเศษขึ้น
// calculate Start row
$startRow = ($page - 1) * $rowPerPage ;
// query
$rs = $conn->query("select * from food $sql_search ORDER by id DESC limit $startRow,$rowPerPage ") ; // limit เริ่มที่ , จำนวนที่ต้องการแสดง
//echo $conn->error ; // for check error ;
?>
<br><br>
<table class="table">
  <tr>
    <th>ชื่อบ่อ</th><th>ปริมาณอาหาร</th><th>วันที่และเวลา</th>
  </tr>
<?php
if($rs->num_rows > 0)
{
  while($row = $rs->fetch_array())
  {
  ?>
  <tr>
  <td><?php echo $row['room'] ; ?></td><td>
      <?php echo $row['amount'] ; ?></td><td>
      <?php echo $row['day'] ;?></td><td>

    <td>
      <a href="#" class="btn btn-outline-primary" onclick="edit(<?php echo $row['id'] ; ?>);"><i class='fa fa-pencil-square-o'></i></a>
      <a href="#" class="btn btn-outline-danger" onclick="javascript:del('<?php echo $row['id'];?>');"><i class='fa fa-trash'></i></a>
    </td>
  </tr>
  <?php
  }
}
?>
</table>
<!-- bootstrap pagination -->
<ul class="pagination justify-content-center">
  <li class="page-item disabled"><a class="page-link" href="#"><?php echo 'หน้าที่ ',$page; echo ' : ';  ?></a></li>
<?php
for($i=1 ;$i<=$totalPage;$i++)
{
?>
  <li class="page-item" <?php echo ($i==$page)?' class="page-item"':'' ?>><a class="page-link" href="javascript:show(<?php echo $i;?>)"><?php echo $i;?></a></li>
<?php
}
?>
</ul>
<br>
<?php
$rs1 = $conn->query("select sum(amount) FROM food $sql_search ") ; // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs1->fetch_array()){  ?>
  <?php
  $sum_amount = $row['sum(amount)'];
  //echo number_format($avg_temp,2,'.','');?>
  <div class="card-deck">
    <div class="card bg-info">
      <div class="card-header text-info bg-light">ปริมาณอาหารสะสม</div>
      <br><h2 class="card-text text-center text-white" ><?php echo number_format($sum_amount,2,'.',''); echo " กรัม";?></h2><br>
    </div>
  <?php
}

$rs2 = $conn->query("select avg(amount) FROM food $sql_search ") ; // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา
while($row = $rs2->fetch_array()){ ?>
  <?php
  $avg_amount = $row['avg(amount)'];
  //echo number_format($avg_temp,2,'.','');?>
    <div class="card bg-secondary">
      <div class="card-header text-secondary bg-light">ปริมาณอาหารที่ให้เฉลี่ย</div>
      <br><h2 class="card-text text-center text-white" ><?php echo number_format($avg_amount,2,'.',''); echo " กรัม";?></h2><br>
    </div>
    </div>
  <?php
}
?>
