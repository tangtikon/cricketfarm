<?php include'header.php';?>
<?php include 'navbar.php'; ?>
<title>รายงานการให้อาหาร</title>
<script src="app/food.js"></script>
<body>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-11">
				<center>
					<h2>รายงานการให้อาหาร</h2>
        </center>
				<br>
				<form class="form-inline" action="javascript:;" method="post"	class="form-horizontal">
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
						<input type="datetime-local" class="form-control" name="q_day1" id="q_day1">
					</div>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ถึงวันที่</span>
						</div>
						<input type="datetime-local" class="form-control" name="q_day2" id="q_day2">
					</div>
					<button type="submit" class="btn btn-info" id="btsearch">ค้นหา</button>
				</form>

				<br>

			</div>
			<div class="col-md-7" id="showContain"></div>
			<div class="col-md-3">
				<br><br><br>
				<div id="report"></div>
				<form method="post" id="f" action="javascript:;" class="form-horizontal">
					<div class="form-group">
						<div class="col-xs-8">
							<label for="txt_name" class="col-10 col-form-label">ชื่อบ่อ</label>
							<input class="form-control" type="text" id="txt_name" name="txt_name">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-8">
							<label for="txt_amount" class="col-10 col-form-label">ปริมาณอาหาร</label>
							<input class="form-control" type="number" id="txt_amount" name="txt_amount">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-8">
							<label for="txt_day" class="col-10 col-form-label">วันที่และเวลา</label>
							<input class="form-control" type="datetime-local" id="txt_day" name="txt_day" >
						</div>
					</div>



					<div class="form-group">
						<label for="bt" class="col-10 col-form-label"></label>
						<div class="col-15">
							<input type="hidden" name="id" id="id"> <input type="hidden" name="action" id="action" value="add">
							<button class="btn btn-success" id="bt">บันทึก</button>
							<button class="btn btn-danger" id="btCancel">ยกเลิก</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
