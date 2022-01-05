<?php include 'header.php'; ?>


<?php include 'navbar.php'; ?>

<title>ตรวจสอบอุณหภูมิ</title>
<script src="app/temp.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<body>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<center><h2>ตรวจสอบอุณหภูมิ</h2></center>
				<br>
				<form class="form-inline" action="javascript:;" method="post" class="form-horizontal">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ตั้งแต่วันที่</span>
						</div>
						<input type="datetime-local" class="form-control" name="q_day" id="q_day">
					</div>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ถึงวันที่</span>
						</div>
						<input type="datetime-local" class="form-control" name="q_day2" id="q_day2">
					</div>
					<button type="submit" class="btn btn-info" id="btsearch">ค้นหา</button>
				</form>
				<br><br>
				<div id="showContain"></div><br>


			</div>
		</div>
	</div>
	<?php $conn->close();?>



</body>

</html>
