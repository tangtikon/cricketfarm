<?php
include("check.php") ;
include("connect.php") ;
// get page number
// if page is empty return  $_GET['page'] else return 1 ;
$page = (!empty($_GET['page']))?$_GET['page']:1 ;
if(!empty($_POST['q_name']) && !empty($_POST['q_date']))
{
  $sql_search = " where room = '". $_POST['q_name'] ."' AND date_start = '" . $_POST['q_date'] . "'" ; // like '%keyword%'
}
else {
  $sql_search = '' ;

}



//get total rows
$rs = $conn->query("select count(id) as num FROM start_end $sql_search ") ; // query แบบมีเงื่อนไข ถ้ามีการส่งค่าค้นหา

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
$rs = $conn->query("select * from start_end $sql_search limit $startRow,$rowPerPage ") ; // limit เริ่มที่ , จำนวนที่ต้องการแสดง
//echo $conn->error ; // for check error ;
?>
<table class="table">
  <tr>
    <th>ชื่อบ่อ</th><th>วันที่เริ่มเลี้ยง</th><th>น้ำหนักจิ้งหรีดที่นำเข้า</th><th>สถานะ</th>
  </tr>
<?php
if($rs->num_rows > 0)
{
  while($row = $rs->fetch_array())
  {
  ?>
  <tr>
    <?php if($row['status']=='ยังไม่เก็บเกี่ยว'){ ?>
          <td><?php echo $row['room'] ; ?></td><td>
              <?php echo $row['date_start'] ; ?></td><td>
              <?php echo $row['weigh_start'] ; echo ' กรัม';?></td><td>
              <?php echo $row['status'] ; ?></td>
              <td>
                <a href="#" class="btn btn-outline-primary" onclick="edit(<?php echo $row['id'] ; ?>);"><i class='fa fa-pencil-square-o'></i></a>
                <a href="#" class="btn btn-outline-danger"  onclick="javascript:del('<?php echo $row['id'];?>');"><i class='fa fa-trash'></i></a>
              </td>
          <?php
              }
          else{

              }
          ?>
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
