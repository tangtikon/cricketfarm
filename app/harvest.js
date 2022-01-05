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
    $("#txt_date_end").val("");
    $("#txt_weigh_end").val("");
    $("#txt_lost").val("");

  });
  // insert and uppdate
  $('#bt').click(function() {
    $('#bt').attr('disabled', true);
    var data = $("#f").serialize();
    $.ajax({
      type : "POST",
      url : "a_harvest.php",
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
          $("#txt_date_end").val("");
          $("#txt_weigh_end").val("");
          $("#txt_lost").val("");
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
      url : "a_harvest.php",
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
      url:"a_harvest.php",
      dataType:"json",
      data:"action=edit&id="+id,
      success:function(data){
        $("#id").val(data.id) ;
        $("#action").val("update") ;
        $("#id").val(data.id) ;
        $("#txt_name").val(data.room) ;
        $("#txt_date_end").val(data.date_end);
        $("#txt_weigh_end").val(data.weigh_end);
        $("#txt_lost").val(data.lost);
      },
      error:function(data){
        console.log(data.responseText) ;
      }
    }) ;
}

function show(page) {
  $("#showContain").load("a_harvest_show.php?page=" + page, {
    q_name : $("#q_name").val(),
    q_date : $("#q_date").val()
  }, function() {

  });
}

src="pageHarvest.js"
