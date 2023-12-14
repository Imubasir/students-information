/*global $, document, details, alert, window, console*/
/*jslint node: true */

function addRequest() {
    $("#requestModal").modal('show');

    $("#req_send_btn").unbind("click").on('click', function() {
        var form = document.querySelector("#reqForm");
        var formdata = new FormData(form);

        var requests = $("#req_").val().toString();
        var req_array = new Array();
        var elems = requests.split(',');

        for (var i = 0; i < elems.length; i++) {
            req_array.push(elems[i]);
        }
        var arr = JSON.stringify(req_array);
        formdata.append("req_array", arr);

        $.ajax({
            type: 'POST',
            url: 'request_process.php',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function(response) {
                // console.log(response);
                if (response == '1') {
                    load_data();
                    $("#requestModal").modal('hide');
                    new PNotify({
                        title: "Success",
                        text: "New Request Added",
                        type: "success",
                        styling: "bootstrap3"
                    })
                } else {
                    new PNotify({
                        title: "Error",
                        text: response,
                        type: "error",
                        styling: "bootstrap3"
                    })
                }
            }
        });
    });
}

document.getElementById("stud_id").addEventListener('keyup', function() {
    var id = $("#stud_id").val();
    var cat = $("#category").val();

    $.ajax({
        type: 'POST',
        url: 'check_details.php',
        data: 'id=' + id + '&cat=' + cat,

        success: function(json) {

            //console.log(json);
            var data = JSON.parse(json);
            if (data == '') {
                $("#prog").val("");
                $("#name").val("");
            }
            for (var i = 0; i < data.length; i++) {
                var name = data[i].name;
                var prog = data[i].progname;

                $("#prog").val(prog);
                $("#name").val(name);
            }
        }
    })
})

document.getElementById("req_").addEventListener('click', function() {
    var val = $("#req_").val().toString();
    // alert(val);
    var inputs = val.split(",");
    if (inputs.includes('cf')) {
        document.getElementById("cf_q").style.display = 'block';
    } else {
        document.getElementById("cf_q").style.display = 'none';
    }

    if (inputs.includes('trans')) {
        document.getElementById("trans_q").style.display = 'block';
    } else {
        document.getElementById("trans_q").style.display = 'none';
    }

    if (inputs.includes('il')) {
        document.getElementById("il_q").style.display = 'block';
    } else {
        document.getElementById("il_q").style.display = 'none';
    }

    if (inputs.includes('ep')) {
        document.getElementById("ep_q").style.display = 'block';
    } else {
        document.getElementById("ep_q").style.display = 'none';
    }

    if (inputs.includes('visa')) {
        document.getElementById("visa_q").style.display = 'block';
        document.getElementById("country").style.display = 'block';
    } else {
        document.getElementById("visa_q").style.display = 'none';
        document.getElementById("country").style.display = 'none';
    }
})



function load_data() {
    $.ajax({
        url: 'load_data.php',

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            var html = '';
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var requests_array = new Array();
                var req_id = data[i].trans_uin;
                var indexno = data[i].indexno;
                var name = data[i].name;
                var assigned = data[i].assignedto;
                var category = data[i].category;
                var cat_1 = data[i].service_cat1;
                var cat_2 = data[i].service_cat2;
                var cat_3 = data[i].service_cat3;
                var cat_4 = data[i].service_cat4;
                var cat_5 = data[i].service_cat5;
                var Req_No = data[i].Req_No_Rem;
                var action_date = moment(data[i].action_date).format("DD MMM YYYY HH:mm:ss");
                var username = data[i].first_name + ' ' + data[i].middle_name + ' ' + data[i].last_name;
                var del_mode = data[i].delivery_mode;
                var del_addrs = data[i].delivery_addrss;

                if (cat_1 != '') {
                    requests_array.push(cat_1);
                }
                if (cat_2 != '') {
                    requests_array.push(cat_2);
                }
                if (cat_3 != '') {
                    requests_array.push(cat_3);
                }
                if (cat_4 != '') {
                    requests_array.push(cat_4);
                }
                if (cat_5 != '') {
                    requests_array.push(cat_5);
                }
                var req_cat = data[i].service_type;
                var date_sub = moment(data[i].submitted_date).format("DD-MMM-YYYY H:m:s");
                if (Req_No < '1') {
                    var status = "<span style='color:red;'>Ready - " + action_date + "</span>";
                } else {
                    var status = data[i].status;
                }

                if (del_mode != "Hand Pick" && del_addrs != '' && Req_No < '1') {
                    var dispatch_btn = "<button id='dispatch_detail'>Dispatch</button>";
                } else if (del_mode == "Hand Pick" && del_addrs == '' && Req_No < '1') {
                    var dispatch_btn = '<button>Collect</button>';
                } else {
                    var dispatch_btn = '';
                }


                html += "<tr><td>" + a + "</td><td>" + indexno + "</td><td>" + name + "</td><td>" + requests_array + "</td><td>" + category + "</td><td>" + req_cat + "</td><td>" + date_sub + "</td><td>" + status + "</td><td>" + username + "</td><td>" + dispatch_btn + "</td></tr>";
            }
            $("#req_table").html(html);
            $("#request_tbl").DataTable();
            $("#dispatch_detail").on('click', function() {
                $("#dispatch_modal").modal('show');
                var content = "<p><i class = 'fas fa-book'></i> " + del_addrs + "</p>";
                $("#dispatch_body").html(content);
            })
        }
    })
}

function dispatch_detail(request_id) {

}

$(document).ready(function() {
    load_data();
});