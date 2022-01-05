$().ready(function () {
  show(1);
  // search
  $("#btsearch").click(function () {
    show(1);
  });
  $('#btCancel').click(function() {
    $("#id").val("");
    $("#action").val("add"); // คืนค่ากลับไปที่เพิ่มข้อมูล
    $("#txt_name").val("");
    $("#txt_amount").val("");
    $("#txt_day").val("");

  });
  // insert and uppdate
  $('#bt').click(function() {
    $('#bt').attr('disabled', true);
    var data = $("#f").serialize();
    $.ajax({
      type : "POST",
      url : "a_food.php",
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
          $("#txt_amount").val("");
          $("#txt_day").val("");
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
      type: "POST",
      url: "a_food.php",
      dataType: "json",
      data: "action=delete&id=" + id,
      success: function (data) {
        if (data.status != "ok") {
          $("#report").html(data.msg); // show error
        }
        show(1); // refresh table
      },
      error: function (data) {
        console.log(data.responseText);
      },
    });
  }
}
function edit(id)
{
    $.ajax({
      type:"POST",
      url:"a_food.php",
      dataType:"json",
      data:"action=edit&id="+id,
      success:function(data){
        $("#id").val(data.id) ;
        $("#action").val("update") ;
        $("#id").val(data.id) ;
        $("#txt_name").val(data.room) ;
        $("#txt_amount").val(data.amount);
        $("#txt_day").val(data.day);
      },
      error:function(data){
        console.log(data.responseText) ;
      }
    }) ;
}

function show(page) {
  $("#showContain").load(
    "a_food_show.php?page=" + page,
    {
      q_name: $("#q_name").val(),
      q_day1: $("#q_day1").val(),
      q_day2: $("#q_day2").val()
    },
    function () {}
  );
}


src = "pageFood.js";
