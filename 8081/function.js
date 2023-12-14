$(document).ready(function() {
  $("#search_btn")
    .off("click")
    .on("click", function() {
      var id = $("#searchID").val();
      search(id);
    });
    
});

function search(id) {
  $.ajax({
    type: "POST",
    url: "search.php",
    data: "id=" + id,

    success: function(json) {
      var data = JSON.parse(json);

      var table =
        "<div style='box-shadow: 1px 0px 2px 2px #d6d9dc;border-radius: 10px;padding: 20px;'>";

      if (data.length == 0) {
        $("#nullMessage").html("<code>NO RECORD FOUND</code>");
      } else {
        $("#nullMessage").html("");
        var ind = "";
        for (var i = 0; i < data.length; i++) {
          var index = data[i].trans_id;
          if (data[i].indexnumber == ind) {
            continue;
          }
          var indexnum =
            "<label>: " +
            data[i].indexnumber +
            "&nbsp;&nbsp;<sup onclick='indexNum(\"" +
            index +
            "\");'><i class='fa fa-edit'>Edit</i></sup></label>";

          var exammonth =
            "<label>: " +
            data[i].exam_month +
            "-" +
            data[i].exam_year +
            "&nbsp;&nbsp;<sup onclick='indexMonth(\"" +
            index +
            "\");'><i class='fa fa-edit'>Edit</i></label></sup>";

          var examname =
            "<label>: " +
            data[i].cand_name +
            "&nbsp;&nbsp;<sup onclick='indexName(\"" +
            index +
            "\");'><i class='fa fa-edit'>Edit</i></label></sup>";

          table +=
            "<hr /><table><tr><td><label>Index Number </label></td><td style='padding-left: 30px;'><span id='indexNumber'>" +
            indexnum +
            "</span></td></tr><tr><td><label>Month </label></td><td style='padding-left: 30px;'><span id='indexMonth'>" +
            exammonth +
            "</span></span></td></tr><tr><td><label>Name </label></td><td style='padding-left: 30px;'><span id='indexName'>" +
            examname +
            "</span></span></td></tr></table>";

          ind = data[i].indexnumber;
        }

        fetch_cand_result(index);
        table += "</div>";
        $("#display_table").html(table);
      }
    },
  });
}

function fetch_cand_result(uin) {
  var html = "";
  $.ajax({
    type: "POST",
    url: "fetch_cand_results.php",
    data: "id=" + uin,

    success: function(json) {
      var data = JSON.parse(json);
      for (var i = 0; i < data.length; i++) {
        var sit = data[i].sitting;
        var uin = data[i].trans_id;
        var ind_number = data[i].indexnumber;
        var type = data[i].Exam_Type;
        var month = data[i].exam_month;
        var year = data[i].exam_year;

        var btn = "<button onclick='update_results(\"" + uin + "," + ind_number + "\")' class='btn btn-sm btn-info'>Edit</button>";
        html += "<tr><td>" + sit + "</td><td>" + uin + "</td><td>" + ind_number + "</td><td>" + type + "</td><td>" + month + "</td><td>" + year + "</td><td>" + btn + "</td></tr>";
      }

      $("#res_container").html(html);

    },
  });


}

function update_results(ids) {
  var value = ids.split(",");
  var uin = "";
  var index = "";
  var structure = "";

  $("#updateResults").modal("show");
  for (var i = 0; i < value.length; i++) {
    uin = value[0];
    index = value[1];
  }

  $.ajax({
    type: 'POST',
    url: 'fetch_cand_rawresults.php',
    data: "uin=" + uin + "&index=" + index,

    success: function(response) {
      var data = JSON.parse(response);
      for (var i = 0; i < data.length; i++) {
        var sub1 = data[i].subject1;
        var grd1 = data[i].grade1;

        var sub2 = data[i].subject2;
        var grd2 = data[i].grade2;

        var sub3 = data[i].subject3;
        var grd3 = data[i].grade3;

        var sub4 = data[i].subject4;
        var grd4 = data[i].grade4;

        var sub7 = data[i].subject7;
        var grd7 = data[i].grade7;

        var sub8 = data[i].subject8;
        var grd8 = data[i].grade8;

        var sub9 = data[i].subject9;
        var grd9 = data[i].grade9;

        var sub10 = data[i].subject10;
        var grd10 = data[i].grade10;
        
        structure += "<tr><td><select name='sub1' class='form-control'><option selected>SOCIAL STUDIES</option></select></td><td><input type='text' name='grd1' value='" + grd1 + "' class='form-control'></td></tr>";
        structure += "<tr><td><select name='sub2' class='form-control'><option selected>ENGLISH LANGUAGE</option></select></td><td><input type='text' name='grd2' value='" + grd2 + "' class='form-control'></td></tr>";
        structure += "<tr><td><select name='sub3' class='form-control'><option selected>MATHEMATICS (CORE)</option></select></td><td><input type='text' name='grd3' value='" + grd3 + "' class='form-control'></td></tr>";
        structure += "<tr><td><select name='sub4' class='form-control'><option selected>INTEGRATED SCIENCE</option></select></td><td><input type='text' name='grd4' value='" + grd4 + "' class='form-control'></td></tr>";

        structure += "<tr><td><select name='sub7' id='sub7' value='"+sub7+"' class='form-control elect'></select></td><td><input type='text' name='grd7' value='" + grd7 + "' class='form-control'></td></tr>";
        structure += "<tr><td><select name='sub8' id='sub8' value='"+sub8+"' class='form-control elect'></select></td><td><input type='text' name='grd8' value='" + grd8 + "' class='form-control'></td></tr>";
        structure += "<tr><td><select name='sub9' id='sub9' value='"+sub9+"' class='form-control elect'></select></td><td><input type='text' name='grd9' value='" + grd9 + "' class='form-control'></td></tr>";
        structure += "<tr><td><select name='sub10' id='sub10' value='"+sub10+"' class='form-control elect'></select></td><td><input type='text' name='grd10' value='" + grd10 + "' class='form-control'></td></tr></form>";
        
        select_elective(sub7+","+sub8+","+sub9+","+sub10);
      }
      
      $("#loadResult").html(structure);

      $("#updateResultsBtn").off("click").on("click", function() {
        var fd = new FormData(document.querySelector("#result_form"));
        fd.append("uin", uin);
        fd.append("index", index);

        $.ajax({
          type: 'POST',
          url: 'updateResults.php',
          data: fd,
          cache: false,
          processData: false,
          contentType: false,

          success: function(response) {
            if (response == '1') {
              new PNotify({
                title: "Success",
                text: "Result Updated",
                type: "success",
                styling: "bootstrap3"
              });
              $("#updateResults").modal("hide");
            } else {
              new PNotify({
                title: "Error",
                text: response,
                type: "error",
                styling: "bootstrap3"
              });
            }
          }
        })
      })
    }
  })
}

function select_elective (values) {
  var data = values.split(",");
  var subject7 = data[0];
  var subject8 = data[1];
  var subject9 = data[2];
  var subject10 = data[3];

  $.ajax({
    url: 'fetch_elective.php',

    success: function(json) {
      var data = JSON.parse(json);
      console.log(data);
      var html = "";
      for (var i = 0; i < data.length; i++) {
        var subject = data[i].subject;
        html += "<option>" + subject + "</option>";
      }

      $(".elect").html(html);

      document.getElementById("sub7").value = subject7;
      document.getElementById("sub8").value = subject8;
      document.getElementById("sub9").value = subject9;
      document.getElementById("sub10").value = subject10;
    }
  })
}

function indexNum(id) {
  $("#NumModal").modal("show");
  $("#updateNumBtn")
    .off("click")
    .on("click", function() {
      var num = $("#edit_indexNumber").val();

      $.ajax({
        type: "POST",
        url: "editIndexNum.php",
        data: "id=" + id + "&num=" + num,

        success: function(response) {
          if (response == "1") {
            $("#NumModal").modal("hide");
            new PNotify({
              title: "Success",
              text: "Update Completed",
              type: "success",
              styling: "bootstrap3",
            });
            search(id);
          }
        },
      });
    });
}

function indexMonth(id) {
  $("#MonthModal").modal("show");
  $("#updateMonBtn")
    .off("click")
    .on("click", function() {
      var mon = $("#edit_Month").val();
      $.ajax({
        type: "POST",
        url: "editMonth.php",
        data: "id=" + id + "&mon=" + mon,

        success: function(response) {
          if (response == "1") {
            $("#MonthModal").modal("hide");
            new PNotify({
              title: "Success",
              text: "Update Completed",
              type: "success",
              styling: "bootstrap3",
            });
            search(id);
          }
        },
      });
    });
}

function indexName(id) {
  $("#NameModal").modal("show");
  $("#updateNameBtn")
    .off("click")
    .on("click", function() {
      var name = $("#edit_CandName").val();
      $.ajax({
        type: "POST",
        url: "editName.php",
        data: "id=" + id + "&name=" + name,

        success: function(response) {
          if (response == "1") {
            $("#NameModal").modal("hide");
            new PNotify({
              title: "Success",
              text: "Update Completed",
              type: "success",
              styling: "bootstrap3",
            });
            search(id);
          }
        },
      });
    });
}