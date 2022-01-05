<?php
include("check.php") ;
header('Content-Type: charset=utf-8');
include("connect.php") ;
$status = "" ;
$msg = "" ;

// delete function
if($_POST['action'] =='delete')
{
  if(!empty($_POST['id']))
  {
    $id = $_POST['id'] ;
    $sql = "delete from dht22 where id='". $id ."' " ;
    $rs = $conn->query($sql) ;
    if($rs)
    {
      $status = "ok" ;
      $msg =  "ลบข้อมูลเรียบร้อย" ;
    }
    else
    {
      $msg = "ลบข้อมูลไม่ได้" ;
    }
  }
  else {
    $msg = "ลบข้อมูลไม่ครบ" ;
  }

  echo '{"status":"'.$status.'","msg":"'.$msg.'"}' ;
  exit() ;
}
?>
