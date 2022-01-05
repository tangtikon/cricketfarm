
<?php include 'navbar_login.php'; ?>
<html>
<head>
   <title>เข้าสู่ระบบ</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script language-="javascript">
      $().ready(function() {
        $('#bt').click(function() {
          $('#bt').attr('disabled',true) ;
          $.ajax({
            type:"POST",
            url:"checklogin.php",
            dataType:"json",
            data:"txt_username="+$("#txt_username").val()+"&txt_password="+$("#txt_password").val(),
            success:function(data){
              if(data.status=="ok")
              {
                window.location = "pageTemp.php" ;
              }
              else {
                  $("#report").removeClass('sr-only').html(data.msg) ;
              }
            },
            error:function(data){
              alert("ชื่อผู้ใช้หรือรหัสผ่านผิด");
            }
          }) ;
          $('#bt').attr('disabled',false) ;
        });
      }) ;
    </script>
</head>

<body>
   <center>
      <div class="container">
         <br><br>
         <img src="img/logo_b.png" alt="img" style="max-width: 200px; max-height: 240px"></img>
         <h1>เข้าสู่ระบบ</h1>
         <br>
         <form class="form-horizontal" action="javascript:;" method="post">
            <div class="form-group">
               <label class="control-label col-sm-5" for="txt_username"><h3>ชื่อผู้ใช้กรอก test</h3></label>
               <div class="col-sm-3">
                  <input class="form-control" type="text" id="txt_username" name="txt_username" required="true" placeholder="ชื่อผู้ใช้">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-5" for="txt_password"><h3>รหัสผ่าน 1234</h3></label>
               <div class="col-sm-3">
                  <input class="form-control" type="password" id="txt_password" name="txt_password" required="true" placeholder="รหัสผ่าน">
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-offset-4 col-sm-5">
                  <input type="hidden" id="id" name="id" value="">
                  <button class="btn btn-primary" id="bt">เข้าสู่ระบบ</button>
                  <!-- <a href="Register.php" >สมัครสมาชิก</a></p> -->
               </div>
            </div>
      </div>
      </form>
      </div>
   </center>
</body>

</html>
