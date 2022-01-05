$().ready(function () {
  show(1);
  // search
  $("#btsearch").click(function () {
    show(1);
  });

});

function del(id) {
  if (confirm("ยืนยันการลบข้อมูล")) {
    $.ajax({
      type: "POST",
      url: "a_temp.php",
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


function show(page) {
  $("#showContain").load(
    "a_report_showHarvest.php?page=" + page,
    {
      q_name: $("#q_name").val(),
      q_day: $("#q_day").val(),
      q_day2: $("#q_day2").val()
    },

    function () {}
  );
}


src = "pageReportHarvest.js";
