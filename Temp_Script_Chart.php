<?php
   include("connect.php");

   if(!isset($_SESSION)){
     session_start();
   }
   $where = $_SESSION["sql_search"];
   echo $where;

   $rs = $conn->query("select * from dht22 $where ORDER by id DESC limit 10 ");

   $humi = array();
   $temp = array();
   $day = array();
   while ($row = $rs->fetch_array()) {
   	 array_push($humi,$row["humi"]);
     array_push($day,$row["day"]);
     array_push($temp,$row["temp"]);
   }
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
$().ready(function () {
  show(1);
  // search
  $("#btsearch").click(function () {
    show(1);
  });
});



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
        text: 'อุณหภูมิ'
      },
    },
    series: [{
      name: 'อุณหภูมิ',
      data: [<?= implode(',', $temp) ?>]
    }]

  });
});


  src = "pageTemp.js";
</script>
