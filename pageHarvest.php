<?php include'header.php';?>
<?php include'navbar.php'; ?>
<title>บันทึกการเก็บเกี่ยว</title>
<script src="app/harvest.js"></script>
<body>
	<br>
	<br>
	<div class="container-justify">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-md-8">
				<center>
					<h2>ข้อมูลการเก็บเกี่ยว</h2>
        </center>
				<br>
				<form class="form-inline" action="javascript:;" method="post"	class="form-horizontal">
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
				<br>
				<div id="showContain"></div>

			</div>
			<div class="col-md-2">
				<br><br><br><br>
				<div id="report"></div>
				<form method="post" id="f" action="javascript:;"
					class="form-horizontal">
					<div class="form-group">
						<label for="txt_name" class="col-10 col-form-label">ชื่อบ่อ</label>
						<div class="col-15">
							<input class="form-control" type="text" id="txt_name"
								name="txt_name" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="txt_date" class="col-10 col-form-label">วันที่เก็บเกี่ยว</label>
						<div class="col-15">
							<input class="form-control" type="date" id="txt_date_end"
								name="txt_date_end" step="any">
						</div>
					</div>

          <div class="form-group">
            <label for="txt_weigh" class="col-10 col-form-label">น้ำหนักจิ้งหรีดที่เก็บเกี่ยวได้</label>
            <div class="col-15">
              <input class="form-control" type="text" id="txt_weigh_end"
                name="txt_weigh_end">
            </div>
          </div>
					<div class="form-group">
            <label for="txt_lost" class="col-10 col-form-label">ตาย(กรัม)</label>
            <div class="col-15">
              <input class="form-control" type="text" id="txt_lost"
                name="txt_lost">
            </div>
          </div>
					<div class="form-group">
						<label for="bt" class="col-10 col-form-label"></label>
						<div class="col-15">
							<input type="hidden" name="id" id="id" value="Submit">
              <input type="hidden" name="action" id="action" value="add">
							<button class="btn btn-success" id="bt">บันทึก</button>
							<button class="btn btn-danger" id="btCancel">ยกเลิก</button>
							<button class="btn btn-primary" onclick="location.href='pageReportHarvest.php'">ดูรายงาน</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
