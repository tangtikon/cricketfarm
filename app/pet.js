$().ready(function() {
  show(1);
  // search
  $('#btsearch').click(function() {
    show(1);
  });
  $('#btCancel').click(function() {
    $("#id").val("");
    $("#action").val("add"); // คืนค่ากลับไปที่เพิ่มข้อมูล
    $("#txt_name").val("");
    $("#txt_date_start").val("");
    $("#txt_weigh_start").val("");

  });
  // insert and uppdate
  $('#bt').click(function() {
    $('#bt').attr('disabled', true);
    var data = $("#f").serialize();
    $.ajax({
      type : "POST",
      url : "a_pet.php",
      dataType : "json",
      data : data,
      success : function(data) {
        if (data.status != "ok") {
          $("#report").html(data.msg); // show error
        } else {
          // clear data in form
          $("#id").val("");
          $("#action").val("add"); // คืนค่ากลับไปที่เพิ่มข้อมูล
          $("#txt_name").val("");
          $("#txt_date_start").val("");
          $("#txt_weigh_start").val("");
        }
        show(1); // refresh table
      },
      error : function(data) {
        console.log(data.responseText);
      }
    });
    $('#bt').attr('disabled', false);
  });
});

function del(id) {
  if (confirm("ยืนยันการลบข้อมูล")) {
    $.ajax({
      type : "POST",
      url : "a_pet.php",
      dataType : "json",
      data : "action=delete&id=" + id,
      success : function(data) {
        if (data.status != "ok") {
          $("#report").html(data.msg); // show error
        }
        show(1); // refresh table
      },
      error : function(data) {
        console.log(data.responseText);
      }
    });
  }
}

function edit(id)
{
    $.ajax({
      type:"POST",
      url:"a_pet.php",
      dataType:"json",
      data:"action=edit&id="+id,
      success:function(data){
        $("#id").val(data.id) ;
        $("#action").val("update") ;
        $("#id").val(data.id) ;
        $("#txt_name").val(data.room) ;
        $("#txt_date_start").val(data.date_start);
        $("#txt_weigh_start").val(data.weigh_start) ;
        //$("#txt_status").val(data.status) ;


      },
      error:function(data){
        console.log(data.responseText) ;
      }
    }) ;
}

function show(page) {
  $("#showContain").load("a_pet_show.php?page=" + page,
  {
    q_name : $("#q_name").val(),
    q_date : $("#q_date").val()
  },
  function() {

  });
}



src="pagePet.js"
