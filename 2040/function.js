/*global $, document, details, alert, window, console*/
/*jslint node: true */

function load_ghapes () {
    $.ajax({
        url: 'read_ghapes.php',

        success: function (response) {
            var data = JSON.parse(response);
            // console.log(data);
            if(data[0].status != 'failed') {
                $("#apirequestModal").modal("show");
                var html = "";
                for (var i = 0, a = 1; i < data.length, a<data.length+1;i++, a++) {
                    var std_id = data[i].student_id;
                    var invoice = data[i].invoice_no;
                    var std_name = data[i].name;
                    var service = data[i].service;
                    var expected_date = data[i].expected_date;
                    var req_date = data[i].request_date;

                    if(a == '1') {
                        var con_btn = "<button onclick='confirm_api_request(\""+invoice+"\")' class='btn btn-sm btn-success'>Confirm</button>";
                    } else {
                        var con_btn = "";
                    }

                    html += "<tr><td>"+a+"</td><td>"+std_id+"</td><td>"+std_name+"</td><td>"+service+"</td><td>"+req_date+"</td><td>"+expected_date+"</td><td id='"+invoice+"'>"+con_btn+"</td></tr>";
                }
                $("#api_body").html(html);
            } else {
                $("#norequestModal").modal("show");
                myFunction();
                $("#apirequestModal").modal("hide");
            }
        }
    })

    // transfer_request('FMS010717113');
}

function myFunction() {
  timeout = setTimeout(timeout, 5000);
}

function timeout() {
  $("#norequestModal").modal("hide");
}

function addRequest() {
    $("#requestModal").modal('show');

    $("#req_send_btn").unbind("click").on('click', function() {
        var category = $("#category").val();
        var name = $("#name").val();
        var prog = $("#prog").val();

        if (category == null) {
            new PNotify({
                title: "Information",
                text: "Select Category",
                type: "info",
                styling: "bootstrap3"
            })
        } else {
            if(name == '' || prog == '') {
                new PNotify({
                title: "Information",
                text: "Student Record Incomplete. Report for Update",
                type: "info",
                styling: "bootstrap3"
            })
            } else {
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

            }

        }
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

document.getElementById("req_").addEventListener('click', function() {
    var val = $("#req_").val().toString();

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

                var detail_btn = "<img onclick='show_detail(\""+req_id+"\")' src='../images/namecard.ico' width='30px' >";


                html += "<tr><td>" + a + " "+detail_btn+ "</td><td>" + indexno + "</td><td>" + name + "</td><td>" + requests_array + "</td><td>" + category + "</td><td>" + req_cat + "</td><td>" + date_sub + "</td><td>" + status + "</td><td>" + username + "</td><td>" + dispatch_btn + "</td></tr>";
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

function show_detail(req_id) {
    $("#requestDetailModal").modal('show');

    $.ajax({
        type: 'POST',
        url: 'show_detail.php',
        data: 'req_id='+req_id,

        success: function(json) {
             var requests_array = new Array();
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var track_id = data[i].trans_uin;

                var trans = data[i].service_cat1;
                var eng_prof = data[i].service_cat2;
                var intro_let = data[i].service_cat3;
                var con_let = data[i].service_cat4;

                if(trans != '') {
                    requests_array.push(trans);
                }

                if(eng_prof != '') {
                    requests_array.push(eng_prof);
                }

                if(intro_let != '') {
                    requests_array.push(intro_let);
                }

                if(con_let != '') {
                    requests_array.push(con_let);
                }

                var name = data[i].name;
                var email = data[i].email;
                var contact = data[i].contact;
                var mode = data[i].delivery_mode;
                var addrss = data[i].delivery_addrss;

                $("#ghapes_inv_id").html(track_id);
                $("#ghapes_requests").html(requests_array.toString());
                $("#ghapes_name").html(name);
                $("#ghapes_email").html(email);
                $("#ghapes_contact").html(contact);
                $("#ghapes_service").html(mode);
                $("#ghapes_address").html(addrss);
            }
        }
    })
}

function dispatch_detail(request_id) {

}

function confirm_api_request (value) {
    $("#"+value).html("<img src='../images/glass.gif' width='50px'>");
    $.ajax({
        type: 'POST',
        url: 'api_callback.php',
        data: 'invoice='+value,

        success: function(response){ 
            console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var status = data[i].status;
                var track_id = data[i].tracking_id;
                alert(track_id);
                if (status == 'success') {
                    transfer_request(track_id);
                }
            }
        }
    })
}

function transfer_request (inv_id) {
    $.ajax({
        type: 'POST',
        url: 'transfer_request.php',
        data: "invoice="+inv_id,

        success: function(response) {
            console.log(response);
            load_ghapes ();
        }
    })
}

$(document).ready(function() {
    load_data();
    load_ghapes();
});