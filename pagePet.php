<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<title>ข้อมูลการเลี้ยง</title>
<script src="app/pet.js"></script>

<body>
	<br>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<center><h2>ข้อมูลการเลี้ยง</h2></center>
				<br>
				<form class="form-inline" action="javascript:;" method="post" class="form-horizontal">
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">ชื่อบ่อ</span>
						</div>
						<input type="text" class="form-control" name="q_name" id="q_name">
					</div>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon1">วันที่เลี้ยง</span>
						</div>
						<input type="date" class="form-control" name="q_date" id="q_date">
					</div>
					<button type="submit" class="btn btn-info" id="btsearch">ค้นหา</button>
				</form>

				<br><br><br>
				<div id="showContain"></div>

			</div>

			<div class="col-md-4">
				<br><br><br>
				<h2>เพิ่มข้อมูล</h2>
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
							<label for="txt_date" class="col-10 col-form-label">ระบุวันที่เริ่มเลี้ยง</label>
							<input class="form-control" type="date" id="txt_date_start" name="txt_date_start" step="any">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-8">
							<label for="txt_weigh" class="col-10 col-form-label">น้ำหนักจิ้งหรีดที่นำเข้า(กรัม)</label>
							<input class="form-control" type="text" id="txt_weigh_start" name="txt_weigh_start">
						</div>
					</div>

					<div class="form-group">
						<label for="bt" class="col-10 col-form-label"></label>
						<div class="col-15">
							<input type="hidden" name="id" id="id"> <input type="hidden" name="action" id="action" value="add">
							<button class="btn btn-success" id="bt">บันทึก</button>
							<button class="btn btn-danger" id="btCancel">ยกเลิก</button>
							<button class="btn btn-primary" onclick="location.href='pageReportPet.php'">ดูรายงาน</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
