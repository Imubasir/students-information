$(document).ready(function() {
    $.ajax({
        url: 'fetch_issuers.php',

        success: function(json) {
            var html = "";
            var data = JSON.parse(json);
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var sid = data[i].staff_ID;
                var name = data[i].name;
                var status = data[i].status;
                if (status == '0') {
                    var option = "<select><option value='1'>Yes</option><option selected value='0'>No</option></select>";
                } else if (status == '1') {
                    var option = "<select><option selected value='1'>Yes</option><option value='0'>No</option></select>";
                }

                html += "<tr id='" + sid + "'><td>" + a + "</td><td>" + name + "</td><td>" + option + "</td></tr>";
            }
            $("#issue_body").html(html);
        }
    })
})

function update_issuer() {

    var tbl = document.getElementById("issue_body");
    var rowCount = tbl.rows.length;
    for (var i = 0; i < rowCount; i++) {
        var row = tbl.rows[i];

        var rowid = row.id;
        var value = row.cells[2].childNodes[0].value;

        var sts = update(rowid + "," + value);
    }
    
    $("#issuerModal").modal("hide");
    new PNotify({
            title: 'Success',
            text: "Issue Updated",
            type: 'success',
            styling: 'bootstrap3'
        });
}

function update(id) {
    var values = id.split(",");
    var sid = values[0];
    var val = values[1];
    var value = "";
    $.ajax({
        async: false,
        type: 'POST',
        url: 'update_issuer.php',
        data: 'id=' + sid + '&val=' + val,

        success: function(response) {
            value = response;
        }
    })
    return value;
}

function load_data() {
    $("#sched_tbl").dataTable().fnDestroy();
    $("#schedule_body").html("<tr><td colspan='7' style='text-align: center;'><img src='../images/cube.gif'></td></tr>");
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var index = data[i].indexnum;
                var submitted = moment(data[i].submitted_date).format("DD MMM YYYY HH:mm:ss");
                // var submitted = data[i].date_added;
                var assigned_to = data[i].first_name + ' ' + data[i].last_name;
                var transid_cat = data[i].cat;
                var trans_id = data[i].trans_id;

                var reg_no = data[i].Req_No_Rem;
                if (reg_no < 1) {
                    var remark_date = "Ready" + " - " + moment(data[i].action_date).format("DD MMM YYYY HH:mm:ss");
                    var button = '';
                } else {
                    var remark_date = "Being Processed";
                    var button = "<button onclick= 'assign(\"" + trans_id + "\")' class = 'btn btn-sm btn-success'>Reassign</button>";
                }
                html += "<tr><td>" + a + "</td><td>" + index + "</td><td>" + transid_cat + "</td><td>" + submitted + "</td><td>" + remark_date + "</td><td>" + assigned_to + "</td><td>" + button + "</td></tr>";

            }
            document.getElementById("schedule_body").innerHTML = html;
            $("#sched_tbl").DataTable();
        }
    })
}

function assign(id) {
    $("#reassign_modal").modal('show');

    $.ajax({
        type: 'POST',
        url: 'fetch_reassign.php',
        data: 'id=' + id,

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';
            for (var i = 0; i < data.length; i++) {
                var name = data[i].first_name + ' ' + data[i].last_name;
                var transid = data[i].trans_id;
            }
            document.getElementById("assigned").value = name;
            document.getElementById("transid").value = transid;

        }
    });
}

function reassign() {
    var transid = $("#transid").val();
    var from = $("#assigned").val();
    var to = $("#select_reassign").val();

    $.ajax({
        type: 'POST',
        url: 'reassign.php',
        data: 'id=' + from + '&new=' + to + '&transid=' + transid,

        success: function(response) {
            if (response == '1') {
                //                load_data();
                $("#reassign_modal").modal('hide');
            } else {
                new PNotify({
                    title: 'ERROR',
                    text: response,
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        }
    });
}

$(document).ready(function() {
    load_data();
});