<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<title>สรุปข้อมูลเริ่มเลี้ยง</title>
<script src="app/report_harvest.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<body>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<center><h2>สรุปข้อมูลเก็บผลผลิต</h2></center>
				<br>
				<form class="form-inline" action="javascript:;" method="post" class="form-horizontal">
          <div class="input-group mb-2 mr-sm-2 mb-sm-0 col-md-2">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ชื่อบ่อ</span>
						</div>
						<input type="text" class="form-control" name="q_name" id="q_name">
					</div>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ตั้งแต่วันที่</span>
						</div>
						<input type="date" class="form-control" name="q_day" id="q_day">
					</div>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ถึงวันที่</span>
						</div>
						<input type="date" class="form-control" name="q_day2" id="q_day2">
					</div>
					<button type="submit" class="btn btn-info" id="btsearch">ค้นหา</button>&nbsp;&nbsp;
					<button class="btn btn-danger" onclick="location.reload();">ยกเลิก</button>&nbsp;&nbsp;
          <button class="btn btn-warning" onclick="location.href='pageHarvest.php'">ย้อนกลับ</button>
				</form>
				<br><br>
				<div id="showContain"></div><br>


			</div>
		</div>
	</div>
	<?php $conn->close();?>



</body>

</html>
