function load_data() {
    $("#sched_tbl").dataTable().fnDestroy();
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
                load_data();
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

function assign_process() {
    $.ajax({
        url: 'request_data.php',

        success: function(json) {
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                //Request properties...
                var variable = data[i].property;
            }

            $.ajax({
                type: 'POST',
                url: 'assign_process.php',
                data: 'index = ' + variable, //Request data to save to DB...

                success: function(response) {
                    //console.log(response);
                }

            });
        }
    })
}

$(document).ready(function() {
    setInterval("assign_process()", "5000");

    load_data();
    $("#reassign_modal").on('hidden.bs.modal', function() {
        document.getElementById("select_reassign").value = '';
    });
});