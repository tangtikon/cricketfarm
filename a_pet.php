<?php
include("check.php") ;
header('Content-Type: charset=utf-8');
include("connect.php") ;
$status = "" ;
$msg = "" ;

if($_POST['action'] =='edit')
{
  if( !empty($_POST['id']))
  {
    $id = $_POST['id'] ;
    $sql = "select * from start_end where id='". $id."' limit 1 " ;
    $rs = $conn->query($sql) ;
    $row = $rs->fetch_array() ;
    echo json_encode($row) ;
    exit() ;
  }
}

// delete function
if($_POST['action'] =='delete')
{
  if(!empty($_POST['id']))
  {
    $id = $_POST['id'] ;
    $sql = "delete from start_end where id='". $id ."' " ;
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

// update function
if($_POST['action'] =='update')
{
  if(!empty($_POST['txt_name']) && !empty($_POST['txt_date_start'])
    && !empty($_POST['txt_weigh_start'])&& !empty($_POST['id']))
  {
    $id = $conn->escape_string($_POST['id']);
    $room = $conn->escape_string($_POST['txt_name']);
    $date_start = $conn->escape_string($_POST['txt_date_start']);
    $weigh_start = $conn->escape_string($_POST['txt_weigh_start']);
    $status = "ยังไม่เก็บเกี่ยว";
    $sql = "update start_end set room='$room', date_start='$date_start', weigh_start=$weigh_start, status='$status'  where id='$id'";
    //$sql = "update date_start set room='".$conn->escape_string($_POST['txt_name'])."',weigh=". $conn->escape_string($_POST['txt_weigh'])." where id='". $id ."' " ;
    $rs = $conn->query($sql) ;
    if($rs)
    {
      $status = "ok" ;
      $msg = "แก้ไขข้อมูลเรียบร้อย" ;
    }
    else
    {
      $msg = "แก้ไขข้อมูลไม่ได้" ;
    }
  }
  else {
    $msg = "อัพเดทข้อมูลไม่ครบ" ;
  }

  echo '{"status":"'.$status.'","msg":"'.$msg.'"}' ;
  exit() ;
}
//เพิ่มข้อมูล
if($_POST['action'] =='add')
{
  if(!empty($_POST['txt_name']) && !empty($_POST['txt_date_start'])
    && !empty($_POST['txt_weigh_start']))
  {
    $room = $conn->escape_string($_POST['txt_name']);
    $date_start = $conn->escape_string($_POST['txt_date_start']);
    $weigh_start = $conn->escape_string($_POST['txt_weigh_start']);
    $status = "ยังไม่เก็บเกี่ยว";
    $sql = "insert into start_end (room,date_start,weigh_start,status) values('$room','$date_start',$weigh_start,'$status')";
    $rs = $conn->query($sql);
      if($rs)
      {
        $status = "ok" ;
        $msg = "เพิ่มข้อมูลเรียบร้อย" ;
      }
        else {
          $msg = "เพิ่มข้อมูลไม่ได้" ;
        }
      }
    else{
      $msg = "เพิ่มข้อมูลไม่ครบ" ;
    }
  echo '{"status":"'.$status.'","msg":"'.$msg.'"}' ;
  exit() ;
}
?>
