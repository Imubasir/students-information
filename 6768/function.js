/*global $, document, details, alert, window, console*/
/*jslint node: true */

"use strict";

function load_data() {
    $("#reqTable").dataTable().fnDestroy();
    // document.getElementById("load_1").style.display = true;
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response),
                html = '',
                i = 0,
                a = 1;

            for (i, a; i < data.length, a < data.length + 1; i++, a++) {
                var uin = data[i].indexno;
                var req_id = data[i].trans_uin;
                var name = data[i].name;
                var programme = data[i].progname;
                var serv_type = data[i].service_type;
                var submit_date = moment(data[i].submitted_date).format("DD-MMM-YYYY HH:mm:ss");

                if (a == '1') {
                    var print_btn = "<button onclick='details(\"" + req_id + "\")' class='btn btn-sm btn-success'>View</button>";
                    localStorage.setItem("re1_id", req_id);
                } else {
                    print_btn = "";
                }

                html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + serv_type + "</td><td>" + submit_date + "</td><td>" + print_btn + "</td></tr>";
            }
            document.getElementById("load_1").style.display = 'none';
            document.getElementById("sigBody").innerHTML = html;
            $("#reqTable").DataTable();
        }
    })
}

function details(id) {
    $("#detBody").html("<img src='../images/Cube.gif'>");
    $.ajax({
        type: 'POST',
        url: 'details.php',
        data: 'id=' + id,

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            var html = '';
            for (var i = 0; i < data.length; i++) {
                var a = 1;
                var uin = data[i].trans_uin;
                var index = data[i].indexno;

                localStorage.setItem("trans", uin);
                localStorage.setItem("index", index);

                var programme = data[i].progname;
                var name = data[i].name;

                var cat1 = data[i].service_cat1;
                var cat2 = data[i].service_cat2;
                var cat3 = data[i].service_cat3;
                var cat4 = data[i].service_cat4;
                var cat5 = data[i].service_cat5;

                var cat1_status = data[i].cat1_status;
                var cat2_status = data[i].cat2_status;
                var cat3_status = data[i].cat3_status;
                var cat4_status = data[i].cat4_status;
                var cat5_status = data[i].cat5_status;

                if (cat1_status == '1') {
                    var trans_btn = "";
                } else if (cat1_status == '0') {
                    var trans_btn = "<button onclick='completed_trans(\"" + uin + "\")' class='btn btn-sm btn-info'>Done</button>&nbsp;&nbsp;<button onclick='flag(\"" + uin + "\")' class='btn btn-sm btn-danger'><i class = 'fa fa-flag'></i> Flag</button>";
                }

                if (cat2_status == '1') {
                    var prof_btn = "";
                } else if (cat2_status == '0') {
                    var prof_btn = "<button onclick='completed_prof(\"" + uin + "\")' class='btn btn-sm btn-info'>Done</button>&nbsp;&nbsp;<button onclick='flag(\"" + uin + "\")' class='btn btn-sm btn-danger'><i class = 'fa fa-flag'></i> Flag</button>";
                }

                if (cat3_status == '1') {
                    var loa_btn = "";
                } else if (cat3_status == '0') {
                    var loa_btn = "<button onclick='completed_loa(\"" + uin + "\")' class='btn btn-sm btn-info'>Done</button>&nbsp;&nbsp;<button onclick='flag(\"" + uin + "\")' class='btn btn-sm btn-danger'><i class = 'fa fa-flag'></i> Flag</button>";
                }

                if (cat4_status == '1') {
                    var conf_btn = "";
                } else if (cat4_status == '0') {
                    var conf_btn = "<button onclick='completed_conf(\"" + uin + "\")' class='btn btn-sm btn-info'>Done</button>&nbsp;&nbsp;<button onclick='flag(\"" + uin + "\")' class='btn btn-sm btn-danger'><i class = 'fa fa-flag'></i> Flag</button>";
                }

                if (cat5_status == '1') {
                    var visa_btn = "";
                } else if (cat5_status == '0') {
                    var visa_btn = "<button onclick='completed_visa(\"" + uin + "\")' class='btn btn-sm btn-info'>Done</button>&nbsp;&nbsp;<button onclick='flag(\"" + uin + "\")' class='btn btn-sm btn-danger'><i class = 'fa fa-flag'></i> Flag</button>";
                }

                var quantity1 = data[i].quantity1;
                var quantity2 = data[i].quantity2;
                var quantity3 = data[i].quantity3;
                var quantity4 = data[i].quantity4;
                var quantity5 = data[i].quantity5;

                var del_mode = data[i].delivery_mode;

                if (cat1 != '' && cat1_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat1 + "</td><td>" + quantity1 + "</td><td>" + del_mode + "</td><td><button id='trans_load' onclick='trans(\"" + index + "," + uin + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + trans_btn + "</td></tr>";
                    a++;
                } else if (cat1 != '' && cat1_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat1 + "</td><td>" + quantity1 + "</td><td>" + del_mode + "</td><td>" + /**+"<button onclick='trans(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + trans_btn + **/ "</td></tr>";
                    a++;
                }



                if (cat2 != '' && cat2_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat2 + "</td><td>" + quantity2 + "</td><td>" + del_mode + "</td><td><button id='prof_load' onclick='prof(\"" + index + "," + uin + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + prof_btn + "</td></tr>";
                    a++;
                } else if (cat2 != '' && cat2_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat2 + "</td><td>" + quantity2 + "</td><td>" + del_mode + "</td><td>" + /**+"<button onclick='prof(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + prof_btn + **/ "</td></tr>";
                    a++;
                }



                if (cat3 != '' && cat3_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat3 + "</td><td>" + quantity3 + "</td><td>" + del_mode + "</td><td><button id='intro_load' onclick='intro(\"" + index + "," + uin + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + loa_btn + "</td></tr>";
                    a++;
                } else if (cat3 != '' && cat3_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat3 + "</td><td>" + quantity3 + "</td><td>" + del_mode + "</td><td>" + /**+"<button onclick='loa(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + loa_btn + **/ "</td></tr>";
                    a++;
                }



                if (cat4 != '' && cat4_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat4 + "</td><td>" + quantity4 + "</td><td>" + del_mode + "</td><td><button id='conf_load' onclick='conf(\"" + index + "," + uin + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + conf_btn + "</td></tr>";
                    a++;
                } else if (cat4 != '' && cat4_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat4 + "</td><td>" + quantity4 + "</td><td>" + del_mode + "</td><td>" /**"<button onclick='conf(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + conf_btn **/ + "</td></tr>";
                    a++;
                }


                if (cat5 != '' && cat5_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat5 + "</td><td>" + quantity5 + "</td><td>" + del_mode + "</td><td><button id='visa_load' onclick='visa(\"" + index + "," + uin + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + visa_btn + "</td></tr>";
                    a++;
                } else if (cat5 != '' && cat5_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat5 + "</td><td>" + quantity5 + "</td><td>" + del_mode + "</td><td>" /**"<button onclick='conf(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + conf_btn **/ + "</td></tr>";
                    a++;
                }
            }


            document.getElementById("load_2").style.display = 'none';
            document.getElementById("detBody").innerHTML = html;
            document.getElementById("main_trans").style.display = 'none';
            document.getElementById("trans_details").style.display = 'block';
            document.getElementById("reported_table").style.display = 'none';


        }
    })

    // report(id);

}

function prof(id) {
    $("#prof_load").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
    var arr = id.split(",");
    for (var i = 0; i < arr.length; i++) {
        var indexno = arr[0];
        var transid = arr[1];
    }
    $.ajax({
        type: 'POST',
        url: 'english_prof.php',
        data: 'index=' + indexno + '&transid=' + transid,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexno = data[i].indexno;
                var name = data[i].name;
                // var numyears = data[i].levelid;
                // var numyears = data[i].numyears;
                var deg = data[i].deg;
                var fullname = data[i].fullname;
                var progname = data[i].progname;
                var prog_arr = progname.split(" ");
                var determiner = prog_arr[0];
                if (determiner == "DIPLOMA") {
                    var numyears = "2-year";
                } else if (determiner == "DOCTOR") {
                    var numyears = "6-year";
                } else if (determiner == "MBCHB(MEDICINE)") {
                    var numyears = "6-year";
                } else {
                    var numyears = "4-year";
                }
                var gender = data[i].gender;
                var title = data[i].title;
                var code = data[i].verify_code;
            }

            $(".name").html(name);
            $(".progfullname").html(progname);
            $(".gender").html(gender);
            $(".years").html(numyears);
            $("#con_id").html(indexno);
            letter_signatory();
            letter_watermark(indexno);
            $("#profModal").modal('show');

            var code_ = "*E" + code + "*";

            $("#qrcode_3").barcode(
                code_,
                "code128", {
                    showHRI: true,
                    barHeight: 45,
                    barWidth: 2,
                    output: "css",
                    fontSize: 20,
                    color: "#000000",
                    bgColor: "#FFFFFF",
                    moduleSize: 7,
                }
            );

            $("#prof_load").html("Preview");
        }
    })
}

function conf(id) {
    $("#conf_load").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
    $("#confirmModal").modal('show');
    var arr = id.split(",");
    for (var i = 0; i < arr.length; i++) {
        var indexno = arr[0];
        var transid = arr[1];
    }
    $.ajax({
        type: 'POST',
        url: 'confirmatory.php',
        data: 'index=' + indexno + '&transid=' + transid,

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexno = data[i].indexno;
                var name = data[i].name;
                // var numyears = data[i].numyears;
                var deg = data[i].deg;
                var fullname = data[i].fullname;
                var progname = data[i].progname;
                var prog_arr = progname.split(" ");
                var determiner = prog_arr[0];
                if (determiner == "DIPLOMA") {
                    var numyears = "2-year";
                } else if (determiner == "DOCTOR") {
                    var numyears = "6-year";
                } else if (determiner == "MBCHB(MEDICINE)") {
                    var numyears = "6-year";
                } else {
                    var numyears = "4-year";
                }
                var gender = data[i].gender;
                var entryyear = data[i].entryyear;
                var gradclass = data[i].gradclass;
                var facultyname = data[i].facultyname;
                var facid = data[i].facid;
                var code = data[i].verify_code;

            }

            $(".con_id").html(indexno);
            $(".con_name").html(name);
            $(".duration").html(numyears);
            $(".con_facname").html(facultyname);
            $(".con_admn_yr").html(entryyear);
            $(".con_prgname").html(progname);
            $(".con_gradclass").html(gradclass);
            $(".con_gender").html(gender);
            // $("#our_ref").html(indexno);
            letter_signatory();
            con_letter_watermark(indexno);
            var code_ = "*C" + code + "*";

            $("#qrcode_2").barcode(
                code_,
                "code128", {
                    showHRI: true,
                    barHeight: 45,
                    barWidth: 2,
                    output: "css",
                    fontSize: 20,
                    color: "#000000",
                    bgColor: "#FFFFFF",
                    moduleSize: 7,

                }
            );
            $("#conf_load").html("Preview");
        }
    })
}

function intro(id) {
    $("#intro_load").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
    $("#introductoryModal").modal('show');
    var arr = id.split(",");
    for (var i = 0; i < arr.length; i++) {
        var indexno = arr[0];
        var transid = arr[1];
    }
    $.ajax({
        type: 'POST',
        url: 'introductory.php',
        data: 'index=' + indexno + '&transid=' + transid,

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexno = data[i].indexno;
                var name = data[i].name;
                // var numyears = data[i].numyears;
                var deg = data[i].deg;
                var levelname = data[i].levelname;
                var progname = data[i].progname;
                var determiner = prog_arr[0];
                if (determiner == "DIPLOMA") {
                    var numyears = "2-year";
                } else if (determiner == "DOCTOR") {
                    var numyears = "6-year";
                } else if (determiner == "MBCHB(MEDICINE)") {
                    var numyears = "6-year";
                } else {
                    var numyears = "4-year";
                }
                var gender = data[i].gender;
                var entryyear = data[i].entryyear;
                var gradclass = data[i].gradclass;
                var facultyname = data[i].facultyname;
                var facid = data[i].facid;
                var code = data[i].verify_code;

            }

            $(".con_id").html(indexno);
            $(".con_name").html(name);
            $(".con_facname").html(facultyname);
            $(".level").html(levelname);
            $(".duration").html(numyears);
            $(".con_admn_yr").html(entryyear);
            $(".con_prgname").html(progname);
            $(".con_gradclass").html(gradclass);
            $(".con_gender").html(gender);

            letter_signatory();
            intro_letter_watermark(indexno);
            var code_ = "*I" + code + "*";

            $("#qrcode_1").barcode(
                code_,
                "code128", {
                    showHRI: true,
                    barHeight: 45,
                    barWidth: 2,
                    output: "css",
                    fontSize: 20,
                    color: "#000000",
                    bgColor: "#FFFFFF",
                    moduleSize: 7,
                }
            );
            $("#intro_load").html("Preview");
        }
    })
}

function visa(id) {
    $("#visa_load").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
    $("#visaModal").modal('show');
    var arr = id.split(",");
    for (var i = 0; i < arr.length; i++) {
        var indexno = arr[0];
        var transid = arr[1];
    }
    $.ajax({
        type: 'POST',
        url: 'visa.php',
        data: 'index=' + indexno + '&transid=' + transid,

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexno = data[i].indexno;
                var name = data[i].name;
                var numyears = data[i].numyears;
                var deg = data[i].deg;
                var fullname = data[i].fullname;
                var progname = data[i].progname;
                var gender = data[i].gender;
                var gender2 = data[i].gender2;
                var entryyear = data[i].entryyear;
                var gradclass = data[i].gradclass;
                var facultyname = data[i].facultyname;
                var facid = data[i].facid;
                var code = data[i].verify_code;
                var countrynm = data[i].countrynm;
                var people = data[i].people;
                var level = data[i].levelname;
                var consulate = data[i].consulate;
                var consulate_loc = data[i].consulatelocation;

            }

            $(".con_id").html(indexno);
            $(".con_name").html(name);
            $(".level").html(level);
            $(".duration").html(numyears);
            $(".con_admn_yr").html(entryyear);
            $(".con_prgname").html(progname);
            $(".con_gender").html(gender);
            $(".con_gender2").html(gender2);
            $(".con_facname").html(facultyname);
            $(".country_ppl").html(people);
            $(".country_nm").html(countrynm);
            $(".consulate").html(consulate);

            letter_signatory();
            var code_ = "*V" + code + "*";

            $("#qrcode_4").barcode(
                code_,
                "code128", {
                    showHRI: true,
                    barHeight: 45,
                    barWidth: 2,
                    output: "css",
                    fontSize: 20,
                    color: "#000000",
                    bgColor: "#FFFFFF",
                    moduleSize: 7,

                }
            );
            $("#visa_load").html("Preview");
        }
    })
}

function completed_loa(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(json) {
            var data = JSON.parse(json)
            // console.log(data);
            for (var i = 0; i < data.length; i++) {
                var req_no = data[i].Req_No_Rem;
                var track = data[i].trans_uin;
                var user = data[i].username;
                var msg = "Service Completed.";
            }

            if (req_no < 1) {
                ghapes(track + "," + msg);
            }
        }
    })

    $.ajax({
        type: 'POST',
        url: 'update_loa.php',
        data: 'id=' + id,

        success: function(response_1) {
            load_data();
            var req_id = localStorage.getItem("re1_id", req_id);
            details(req_id);
        }
    })
}

function completed_trans(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(json) {
            var data = JSON.parse(json);
            console.log(data);
            if (data != '') {
                for (var i = 0; i < data.length; i++) {
                    var req_no = data[i].Req_No_Rem;
                    var track = data[i].trans_uin;
                    var user = data[i].username;
                    var msg = "Service Completed.";

                }

                if (req_no < 1) {
                    ghapes(track + "," + msg);
                }
            }

        }
    })

    $.ajax({
        type: 'POST',
        url: 'update_trans.php',
        data: 'id=' + id,

        success: function(response_1) {
            load_data();
            var req_id = localStorage.getItem("re1_id", req_id);
            // $("#service_tbl").dataTable.fnDestroy();
            details(req_id);
        }
    })
}

function completed_prof(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json)
            for (var i = 0; i < data.length; i++) {
                var req_no = data[i].Req_No_Rem;
                var track = data[i].trans_uin;
                var user = data[i].username;
                var msg = "Service Completed.";
            }

            if (req_no < 1) {
                ghapes(track + "," + msg);
            }

        }
    })

    $.ajax({
        type: 'POST',
        url: 'update_prof.php',
        data: 'id=' + id,

        success: function(response_1) {
            load_data();
            var req_id = localStorage.getItem("re1_id", req_id);
            // $("#service_tbl").dataTable.fnDestroy();
            details(req_id);
        }
    })
}

function completed_visa(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json)
            for (var i = 0; i < data.length; i++) {
                var req_no = data[i].Req_No_Rem;
                var track = data[i].trans_uin;
                var user = data[i].username;
                var msg = "Service Completed.";
            }

            if (req_no < 1) {
                ghapes(track + "," + msg);
            }

        }
    })

    $.ajax({
        type: 'POST',
        url: 'update_visa.php',
        data: 'id=' + id,

        success: function(response_1) {
            load_data();
            var req_id = localStorage.getItem("re1_id", req_id);
            // $("#service_tbl").dataTable.fnDestroy();
            details(req_id);
        }
    })
}

function completed_conf(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json)
            for (var i = 0; i < data.length; i++) {
                var req_no = data[i].Req_No_Rem;
                var track = data[i].trans_uin;
                var user = data[i].username;
                var msg = "Service Completed.";
            }

            if (req_no < 1) {
                ghapes(track + "," + msg);
            }


        }
    })

    $.ajax({
        type: 'POST',
        url: 'update_conf.php',
        data: 'id=' + id,

        success: function(response_1) {
            load_data();
            var req_id = localStorage.getItem("re1_id", req_id);
            // $("#service_tbl").dataTable.fnDestroy();
            details(req_id);
        }
    })
}

function flag(id) {
    $.ajax({
        type: 'POST',
        url: 'update_flag.php',
        data: 'id=' + id,

        success: function(response) {
            if (response == '1') {
                load_data();
                back();
            } else {
                alert(response);
            }
        }
    })
}

function unflag(id) {
    $.ajax({
        type: 'POST',
        url: 'update_unflag.php',
        data: 'id=' + id,

        success: function(response) {
            if (response == '1') {
                load_data();
                view_flagged();
            } else {
                alert(response);
            }
        }
    })
}

function trans(id) {
    $("#trans_load").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
    document.getElementById("trans_load").disabled = true;
    // document.getElementById("banner_row").style.visibility = 'hidden';


    // $("#view_results").modal('show');
    var arr = id.split(",");
    for (var i = 0; i < arr.length; i++) {
        var indexno = arr[0];
        var transid = arr[1];
    }
    trans_profile(indexno);
    signatory();
    $.ajax({
        type: 'POST',
        url: 'transcript.php',
        data: 'id=' + indexno,

        success: function(response) {
            $("#transcriptModal").modal('show');
            console.log(response);
            var data = JSON.parse(response);
            var prog = data['biodata'][0].progname;
            var _prog = prog.split(" ");
            for (var i = 0; i < _prog.length; i++) {
                var __prog = _prog[0];
            }

            // Create Headers (Level and Trimester) for Diploma.
            if (__prog.trim() == "DIPLOMA") {
                var html1 = '';
                var header = "<table style='width:100%;border-bottom: 2px solid black;' class='table inner_tbl'><thead class='inner_thead'><tr><th>Course Code</th><th style='width:60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";

                //FIRST YEAR
                var session1 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='one'>FIRST YEAR</h5></div>";

                html1 += "<label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html1 += header;

                var html2 = '';
                html2 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html2 += header;

                var html3 = '';
                html3 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html3 += header;

                //SECOND YEAR
                var session2 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two'>SECOND YEAR</h5></div>";

                var html4 = '';
                html4 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html4 += header;

                var html5 = '';
                html5 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html5 += header;

                var html6 = '';
                html6 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html6 += header;

                //THIRD YEAR
                var session3 = "<div id='thirdyear' class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='three'>THIRD YEAR</h5></div>";

                var html7 = '';
                html7 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html7 += header;

                var html8 = '';
                html8 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>SECOND TRIMESTER</label>";
                html8 += header;

                var html9 = '';
                html9 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html9 += header;

                // FIRST YEAR FIRST TRIMESTER
                for (var i = 0; i < data['first_first'].length; i++) {
                    var trimester = data['first_first'][i].trimester;
                    var level = data['first_first'][i].levelid;

                    var title = data['first_first'][i].course_title;
                    var code = data['first_first'][i].coursecode1;
                    var credits = data['first_first'][i].credits;
                    var grade = data['first_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_first'][i].coursecode1 && tempgrade == data['first_first'][i].grade) {
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                        continue;
                    } else if (tempcode == data['first_first'][i].coursecode1 && tempgrade != data['first_first'][i].grade) {
                        grade += "**";
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_first'][i].coursecode1;
                    var tempgrade = data['first_first'][i].grade;

                    var one_one = true;
                    html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR SECOND TRIMESTER
                for (var i = 0; i < data['first_second'].length; i++) {
                    var trimester = data['first_second'][i].trimester;
                    var level = data['first_second'][i].levelid;

                    var title = data['first_second'][i].course_title;
                    var code = data['first_second'][i].coursecode1;
                    var credits = data['first_second'][i].credits;
                    var grade = data['first_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_second'][i].coursecode1 && tempgrade == data['first_second'][i].grade) {
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                        continue;
                    } else if (tempcode == data['first_second'][i].coursecode1 && tempgrade != data['first_second'][i].grade) {
                        grade += "**";
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_second'][i].coursecode1;
                    var tempgrade = data['first_second'][i].grade;

                    var one_two = true;
                    html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR THIRD TRIMESTER
                for (var i = 0; i < data['first_third'].length; i++) {
                    var trimester = data['first_third'][i].trimester;
                    var level = data['first_third'][i].levelid;

                    var title = data['first_third'][i].course_title;
                    var code = data['first_third'][i].coursecode1;
                    var credits = data['first_third'][i].credits;
                    var grade = data['first_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_third'][i].coursecode1 && tempgrade == data['first_third'][i].grade) {
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                        continue;
                    } else if (tempcode == data['first_third'][i].coursecode1 && tempgrade != data['first_third'][i].grade) {
                        grade += "**";
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_third'][i].coursecode1;
                    var tempgrade = data['first_third'][i].grade;

                    var one_three = true;
                    html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr></tr>";
                }

                // SECOND YEAR FIRST TRIMESTER
                for (var i = 0; i < data['second_first'].length; i++) {
                    var trimester = data['second_first'][i].trimester;
                    var level = data['second_first'][i].levelid;

                    var title = data['second_first'][i].course_title;
                    var code = data['second_first'][i].coursecode1;
                    var credits = data['second_first'][i].credits;
                    var grade = data['second_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_first'][i].coursecode1 && tempgrade == data['second_first'][i].grade) {
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                        continue;
                    } else if (tempcode == data['second_first'][i].coursecode1 && tempgrade != data['second_first'][i].grade) {
                        grade += "**";
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_first'][i].coursecode1;
                    var tempgrade = data['second_first'][i].grade;

                    var two_one = true;
                    html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR SECOND TRIMESTER
                for (var i = 0; i < data['second_second'].length; i++) {
                    var trimester = data['second_second'][i].trimester;
                    var level = data['second_second'][i].levelid;

                    var title = data['second_second'][i].course_title;
                    var code = data['second_second'][i].coursecode1;
                    var credits = data['second_second'][i].credits;
                    var grade = data['second_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_second'][i].coursecode1 && tempgrade == data['second_second'][i].grade) {
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                        continue;
                    } else if (tempcode == data['second_second'][i].coursecode1 && tempgrade != data['second_second'][i].grade) {
                        grade += "**";
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_second'][i].coursecode1;
                    var tempgrade = data['second_second'][i].grade;

                    var two_two = true;
                    html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR THIRD TRIMESTER
                for (var i = 0; i < data['second_third'].length; i++) {
                    var trimester = data['second_third'][i].trimester;
                    var level = data['second_third'][i].levelid;

                    var title = data['second_third'][i].course_title;
                    var code = data['second_third'][i].coursecode1;
                    var credits = data['second_third'][i].credits;
                    var grade = data['second_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_third'][i].coursecode1 && tempgrade == data['second_third'][i].grade) {
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                        continue;
                    } else if (tempcode == data['second_third'][i].coursecode1 && tempgrade != data['second_third'][i].grade) {
                        grade += "**";
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_third'][i].coursecode1;
                    var tempgrade = data['second_third'][i].grade;

                    var two_three = true;
                    html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR FIRST TRIMESTER
                for (var i = 0; i < data['third_first'].length; i++) {
                    var trimester = data['third_first'][i].trimester;
                    var level = data['third_first'][i].levelid;

                    var title = data['third_first'][i].course_title;
                    var code = data['third_first'][i].coursecode1;
                    var credits = data['third_first'][i].credits;
                    var grade = data['third_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_first'][i].coursecode1 && tempgrade == data['third_first'][i].grade) {
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                        continue;
                    } else if (tempcode == data['third_first'][i].coursecode1 && tempgrade != data['third_first'][i].grade) {
                        grade += "**";
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_first'][i].coursecode1;
                    var tempgrade = data['third_first'][i].grade;

                    var three_one = true;
                    html7 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR SECOND TRIMESTER
                for (var i = 0; i < data['third_second'].length; i++) {
                    var trimester = data['third_second'][i].trimester;
                    var level = data['third_second'][i].levelid;

                    var title = data['third_second'][i].course_title;
                    var code = data['third_second'][i].coursecode1;
                    var credits = data['third_second'][i].credits;
                    var grade = data['third_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_second'][i].coursecode1 && tempgrade == data['third_second'][i].grade) {
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                        continue;
                    } else if (tempcode == data['third_second'][i].coursecode1 && tempgrade != data['third_second'][i].grade) {
                        grade += "**";
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_second'][i].coursecode1;
                    var tempgrade = data['third_second'][i].grade;

                    var three_two = true;
                    html8 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR THIRD TRIMESTER
                for (var i = 0; i < data['third_third'].length; i++) {
                    var trimester = data['third_third'][i].trimester;
                    var level = data['third_third'][i].levelid;

                    var title = data['third_third'][i].course_title;
                    var code = data['third_third'][i].coursecode1;
                    var credits = data['third_third'][i].credits;
                    var grade = data['third_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_third'][i].coursecode1 && tempgrade == data['third_third'][i].grade) {
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                        continue;
                    } else if (tempcode == code && tempgrade != data['third_third'][i].grade) {
                        grade += "**";
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_third'][i].coursecode1;
                    var tempgrade = data['third_third'][i].grade;

                    var three_three = true;
                    html9 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                //Add Summary of GPA, CC and CGPA.

                var summary1 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa1'></span> </td></tr>";
                var summary2 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa2'></span> </td></tr>";
                var summary3 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa3'></span> </td></tr>";

                var summary4 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa4'></span> </td></tr>";
                var summary5 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa5'></span> </td></tr>";
                var summary6 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa6'></span> </td></tr>";

                var summary7 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa7'></span> </td></tr>";
                var summary8 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa8'></span> </td></tr>";
                var summary9 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa9'></span> </td></tr>";

                total_credits(indexno);
                html1 += summary1 + "</tbody></table><br>";
                html2 += summary2 + "</tbody></table><br>";
                html3 += summary3 + "</tbody></table><br>";

                html4 += summary4 + "</tbody></table><br>";
                html5 += summary5 + "</tbody></table><br>";
                html6 += summary6 + "</tbody></table><br>";

                html7 += summary7 + "</tbody></table><br>";
                html8 += summary8 + "</tbody></table><br>";
                html9 += summary9 + "</tbody></table><br>";

                var end = "</div>";

                var main = '';

                $.ajax({
                    type: 'POST',
                    url: 'toDisplay.php',
                    data: 'id=' + indexno,

                    success: function(json) {

                        // main += trans_header;
                        if (json.includes(1)) {
                            main += session1;
                            if (one_one == true) {
                                main += html1;
                            } else {

                            }
                            if (one_two == true) {
                                main += html2;
                            } else {

                            }
                            if (one_three == true) {
                                main += html3;
                            } else {

                            }
                        }
                        if (json.includes(2)) {
                            main += session2;

                            if (two_one == true) {
                                main += html4;
                            } else {

                            }
                            if (two_two == true) {
                                main += html5;
                            } else {

                            }
                            if (two_three == true) {
                                main += html6;
                            } else {

                            }
                        }
                        if (json.includes(3)) {
                            main += session3;

                            if (three_one == true) {
                                main += html7;
                            } else {

                            }
                            if (three_two == true) {
                                main += html8;
                            } else {

                            }
                            if (three_three == true) {
                                main += html9;
                            } else {

                            }
                        }
                        main += end;
                        averages(indexno);
                        watermark(indexno);

                        document.getElementById("trancriptTable").innerHTML = main;
                    }
                });

            } else {

                var header = "<table style='width:100%;border-bottom: 2px solid black;' class='table inner_tbl'><thead class='inner_thead'><tr><th>Course Code</th><th style='width:60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";

                //FIRST YEAR
                var session1 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='one'>FIRST YEAR</h5></div>";

                var html1 = '';
                html1 += "<label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html1 += header;

                var html2 = '';
                html2 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html2 += header;

                var html3 = '';
                html3 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html3 += header;

                //SECOND YEAR
                var session2 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two'>SECOND YEAR</h5></div>";

                var html4 = '';
                html4 += "<label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html4 += header;

                var html5 = '';
                html5 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html5 += header;

                var html6 = '';
                html6 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html6 += header;

                //THIRD YEAR
                var session3 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='three'>THIRD YEAR</h5></div>";

                var html7 = '';
                html7 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html7 += header;

                var html8 = '';
                html8 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html8 += header;

                var html9 = '';
                html9 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html9 += header;

                //Fourth
                var session4 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>FOURTH YEAR</h5></div>";

                var html10 = '';
                html10 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html10 += header;

                var html11 = '';
                html11 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html11 += header;

                var html12 = '';
                html12 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html12 += header;

                //Fifth
                var session5 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>FIFTH YEAR</h5></div>";

                var html13 = '';
                html13 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html13 += header;

                var html14 = '';
                html14 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html14 += header;

                var html15 = '';
                html15 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html15 += header;

                //Sixth
                var session6 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>SIXTH YEAR</h5></div>";

                var html16 = '';
                html16 += "<br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                html16 += header;

                var html17 = '';
                html17 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html17 += header;

                var html18 = '';
                html18 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html18 += header;


                // trans_profile(indexno);

                // FIRST YEAR FIRST TRIMESTER
                for (var i = 0; i < data['first_first'].length; i++) {
                    var trimester = data['first_first'][i].trimester;
                    var level = data['first_first'][i].levelid;

                    var title = data['first_first'][i].course_title;
                    var code = data['first_first'][i].coursecode1;
                    var credits = data['first_first'][i].credits;
                    var grade = data['first_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_first'][i].coursecode1 && tempgrade == data['first_first'][i].grade) {
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                        continue;
                    } else if (tempcode == data['first_first'][i].coursecode1 && tempgrade != data['first_first'][i].grade) {
                        grade += "**";
                        tempcode = data['first_first'][i].coursecode1;
                        tempgrade = data['first_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_first'][i].coursecode1;
                    var tempgrade = data['first_first'][i].grade;

                    var one_one = true;
                    html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR SECOND TRIMESTER
                for (var i = 0; i < data['first_second'].length; i++) {
                    var trimester = data['first_second'][i].trimester;
                    var level = data['first_second'][i].levelid;

                    var title = data['first_second'][i].course_title;
                    var code = data['first_second'][i].coursecode1;
                    var credits = data['first_second'][i].credits;
                    var grade = data['first_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_second'][i].coursecode1 && tempgrade == data['first_second'][i].grade) {
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                        continue;
                    } else if (tempcode == data['first_second'][i].coursecode1 && tempgrade != data['first_second'][i].grade) {
                        grade += "**";
                        tempcode = data['first_second'][i].coursecode1;
                        tempgrade = data['first_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_second'][i].coursecode1;
                    var tempgrade = data['first_second'][i].grade;

                    var one_two = true;
                    html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIRST YEAR THIRD TRIMESTER
                for (var i = 0; i < data['first_third'].length; i++) {
                    var trimester = data['first_third'][i].trimester;
                    var level = data['first_third'][i].levelid;

                    var title = data['first_third'][i].course_title;
                    var code = data['first_third'][i].coursecode1;
                    var credits = data['first_third'][i].credits;
                    var grade = data['first_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['first_third'][i].coursecode1 && tempgrade == data['first_third'][i].grade) {
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                        continue;
                    } else if (tempcode == data['first_third'][i].coursecode1 && tempgrade != data['first_third'][i].grade) {
                        grade += "**";
                        tempcode = data['first_third'][i].coursecode1;
                        tempgrade = data['first_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['first_third'][i].coursecode1;
                    var tempgrade = data['first_third'][i].grade;

                    var one_three = true;
                    html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr></tr>";
                }

                // SECOND YEAR FIRST TRIMESTER
                for (var i = 0; i < data['second_first'].length; i++) {
                    var trimester = data['second_first'][i].trimester;
                    var level = data['second_first'][i].levelid;

                    var title = data['second_first'][i].course_title;
                    var code = data['second_first'][i].coursecode1;
                    var credits = data['second_first'][i].credits;
                    var grade = data['second_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_first'][i].coursecode1 && tempgrade == data['second_first'][i].grade) {
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                        continue;
                    } else if (tempcode == data['second_first'][i].coursecode1 && tempgrade != data['second_first'][i].grade) {
                        grade += "**";
                        tempcode = data['second_first'][i].coursecode1;
                        tempgrade = data['second_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_first'][i].coursecode1;
                    var tempgrade = data['second_first'][i].grade;

                    var two_one = true;
                    html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR SECOND TRIMESTER
                for (var i = 0; i < data['second_second'].length; i++) {
                    var trimester = data['second_second'][i].trimester;
                    var level = data['second_second'][i].levelid;

                    var title = data['second_second'][i].course_title;
                    var code = data['second_second'][i].coursecode1;
                    var credits = data['second_second'][i].credits;
                    var grade = data['second_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_second'][i].coursecode1 && tempgrade == data['second_second'][i].grade) {
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                        continue;
                    } else if (tempcode == data['second_second'][i].coursecode1 && tempgrade != data['second_second'][i].grade) {
                        grade += "**";
                        tempcode = data['second_second'][i].coursecode1;
                        tempgrade = data['second_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_second'][i].coursecode1;
                    var tempgrade = data['second_second'][i].grade;

                    var two_two = true;
                    html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SECOND YEAR THIRD TRIMESTER
                for (var i = 0; i < data['second_third'].length; i++) {
                    var trimester = data['second_third'][i].trimester;
                    var level = data['second_third'][i].levelid;

                    var title = data['second_third'][i].course_title;
                    var code = data['second_third'][i].coursecode1;
                    var credits = data['second_third'][i].credits;
                    var grade = data['second_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['second_third'][i].coursecode1 && tempgrade == data['second_third'][i].grade) {
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                        continue;
                    } else if (tempcode == data['second_third'][i].coursecode1 && tempgrade != data['second_third'][i].grade) {
                        grade += "**";
                        tempcode = data['second_third'][i].coursecode1;
                        tempgrade = data['second_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['second_third'][i].coursecode1;
                    var tempgrade = data['second_third'][i].grade;

                    var two_three = true;
                    html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR FIRST TRIMESTER
                for (var i = 0; i < data['third_first'].length; i++) {
                    var trimester = data['third_first'][i].trimester;
                    var level = data['third_first'][i].levelid;

                    var title = data['third_first'][i].course_title;
                    var code = data['third_first'][i].coursecode1;
                    var credits = data['third_first'][i].credits;
                    var grade = data['third_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_first'][i].coursecode1 && tempgrade == data['third_first'][i].grade) {
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                        continue;
                    } else if (tempcode == data['third_first'][i].coursecode1 && tempgrade != data['third_first'][i].grade) {
                        grade += "**";
                        tempcode = data['third_first'][i].coursecode1;
                        tempgrade = data['third_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_first'][i].coursecode1;
                    var tempgrade = data['third_first'][i].grade;

                    var three_one = true;
                    html7 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR SECOND TRIMESTER
                for (var i = 0; i < data['third_second'].length; i++) {
                    var trimester = data['third_second'][i].trimester;
                    var level = data['third_second'][i].levelid;

                    var title = data['third_second'][i].course_title;
                    var code = data['third_second'][i].coursecode1;
                    var credits = data['third_second'][i].credits;
                    var grade = data['third_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_second'][i].coursecode1 && tempgrade == data['third_second'][i].grade) {
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                        continue;
                    } else if (tempcode == data['third_second'][i].coursecode1 && tempgrade != data['third_second'][i].grade) {
                        grade += "**";
                        tempcode = data['third_second'][i].coursecode1;
                        tempgrade = data['third_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_second'][i].coursecode1;
                    var tempgrade = data['third_second'][i].grade;

                    var three_two = true;
                    html8 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // THIRD YEAR THIRD TRIMESTER
                for (var i = 0; i < data['third_third'].length; i++) {
                    var trimester = data['third_third'][i].trimester;
                    var level = data['third_third'][i].levelid;

                    var title = data['third_third'][i].course_title;
                    var code = data['third_third'][i].coursecode1;
                    var credits = data['third_third'][i].credits;
                    var grade = data['third_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['third_third'][i].coursecode1 && tempgrade == data['third_third'][i].grade) {
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                        continue;
                    } else if (tempcode == code && tempgrade != data['third_third'][i].grade) {
                        grade += "**";
                        tempcode = data['third_third'][i].coursecode1;
                        tempgrade = data['third_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['third_third'][i].coursecode1;
                    var tempgrade = data['third_third'][i].grade;

                    var three_three = true;
                    html9 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FOURTH YEAR FIRST TRIMESTER
                for (var i = 0; i < data['fourth_first'].length; i++) {
                    var trimester = data['fourth_first'][i].trimester;
                    var level = data['fourth_first'][i].levelid;

                    var title = data['fourth_first'][i].course_title;
                    var code = data['fourth_first'][i].coursecode1;
                    var credits = data['fourth_first'][i].credits;
                    var grade = data['fourth_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['fourth_first'][i].coursecode1 && tempgrade == data['fourth_first'][i].grade) {
                        tempcode = data['fourth_first'][i].coursecode1;
                        tempgrade = data['fourth_first'][i].grade;
                        continue;
                    } else if (tempcode == data['fourth_first'][i].coursecode1 && tempgrade != data['fourth_first'][i].grade) {
                        grade += "**";
                        tempcode = data['fourth_first'][i].coursecode1;
                        tempgrade = data['fourth_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fourth_first'][i].coursecode1;
                    var tempgrade = data['fourth_first'][i].grade;

                    var four_one = true;
                    html10 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FOURTH YEAR SECOND TRIMESTER
                for (var i = 0; i < data['fourth_second'].length; i++) {
                    var trimester = data['fourth_second'][i].trimester;
                    var level = data['fourth_second'][i].levelid;

                    var title = data['fourth_second'][i].course_title;
                    var code = data['fourth_second'][i].coursecode1;
                    var credits = data['fourth_second'][i].credits;
                    var grade = data['fourth_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['fourth_second'][i].coursecode1 && tempgrade == data['fourth_second'][i].grade) {
                        tempcode = data['fourth_second'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fourth_second'][i].coursecode1 && tempgrade != data['fourth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['fourth_second'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fourth_second'][i].coursecode1;
                    var tempgrade = data['fourth_second'][i].grade;

                    var four_two = true;
                    html11 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FOURTH YEAR THIRD TRIMESTER
                for (var i = 0; i < data['fourth_third'].length; i++) {
                    var trimester = data['fourth_third'][i].trimester;
                    var level = data['fourth_third'][i].levelid;

                    var title = data['fourth_third'][i].course_title;
                    var code = data['fourth_third'][i].coursecode1;
                    var credits = data['fourth_third'][i].credits;
                    var grade = data['fourth_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['fourth_third'][i].coursecode1 && tempgrade == data['fourth_second'][i].grade) {
                        tempcode = data['fourth_third'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fourth_third'][i].coursecode1 && tempgrade != data['fourth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['fourth_third'][i].coursecode1;
                        tempgrade = data['fourth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fourth_third'][i].coursecode1;
                    var tempgrade = data['fourth_third'][i].grade;

                    var four_three = true;
                    html12 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIFT YEAR FIRST TRIMESTER
                for (var i = 0; i < data['fifth_first'].length; i++) {
                    var trimester = data['fifth_first'][i].trimester;
                    var level = data['fifth_first'][i].levelid;

                    var title = data['fifth_first'][i].course_title;
                    var code = data['fifth_first'][i].coursecode1;
                    var credits = data['fifth_first'][i].credits;
                    var grade = data['fifth_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['fifth_first'][i].coursecode1 && tempgrade == data['fifth_first'][i].grade) {
                        tempcode = data['fifth_first'][i].coursecode1;
                        tempgrade = data['fifth_first'][i].grade;
                        continue;
                    } else if (tempcode == data['fifth_first'][i].coursecode1 && tempgrade != data['fifth_first'][i].grade) {
                        grade += "**";
                        tempcode = data['fifth_first'][i].coursecode1;
                        tempgrade = data['fifth_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fifth_first'][i].coursecode1;
                    var tempgrade = data['fifth_first'][i].grade;

                    var five_one = true;
                    html13 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIFT YEAR SECOND TRIMESTER
                for (var i = 0; i < data['fifth_second'].length; i++) {
                    var trimester = data['fifth_second'][i].trimester;
                    var level = data['fifth_second'][i].levelid;

                    var title = data['fifth_second'][i].course_title;
                    var code = data['fifth_second'][i].coursecode1;
                    var credits = data['fifth_second'][i].credits;
                    var grade = data['fifth_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['fifth_second'][i].coursecode1 && tempgrade == data['fifth_second'][i].grade) {
                        tempcode = data['fifth_second'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fifth_second'][i].coursecode1 && tempgrade != data['fifth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['fifth_second'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fifth_second'][i].coursecode1;
                    var tempgrade = data['fifth_second'][i].grade;

                    var five_two = true;
                    html14 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // FIFT YEAR THIRD TRIMESTER
                for (var i = 0; i < data['fifth_third'].length; i++) {
                    var trimester = data['fifth_third'][i].trimester;
                    var level = data['fifth_third'][i].levelid;

                    var title = data['fifth_third'][i].course_title;
                    var code = data['fifth_third'][i].coursecode1;
                    var credits = data['fifth_third'][i].credits;
                    var grade = data['fifth_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['fifth_third'][i].coursecode1 && tempgrade == data['fifth_third'][i].grade) {
                        tempcode = data['fifth_third'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['fifth_third'][i].coursecode1 && tempgrade != data['fifth_third'][i].grade) {
                        grade += "**";
                        tempcode = data['fifth_third'][i].coursecode1;
                        tempgrade = data['fifth_third'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['fifth_third'][i].coursecode1;
                    var tempgrade = data['fifth_third'][i].grade;

                    var five_three = true;
                    html15 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SIXTH YEAR FIRST TRIMESTER
                for (var i = 0; i < data['sixth_first'].length; i++) {
                    var trimester = data['sixth_first'][i].trimester;
                    var level = data['sixth_first'][i].levelid;

                    var title = data['sixth_first'][i].course_title;
                    var code = data['sixth_first'][i].coursecode1;
                    var credits = data['sixth_first'][i].credits;
                    var grade = data['sixth_first'][i].grade;
                    // alert(code);
                    if (tempcode == data['sixth_first'][i].coursecode1 && tempgrade == data['sixth_first'][i].grade) {
                        tempcode = data['sixth_first'][i].coursecode1;
                        tempgrade = data['sixth_first'][i].grade;
                        continue;
                    } else if (tempcode == data['sixth_first'][i].coursecode1 && tempgrade != data['sixth_first'][i].grade) {
                        grade += "**";
                        tempcode = data['sixth_first'][i].coursecode1;
                        tempgrade = data['sixth_first'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['sixth_first'][i].coursecode1;
                    var tempgrade = data['sixth_first'][i].grade;

                    var six_one = true;
                    html16 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SIXTH YEAR SECOND TRIMESTER
                for (var i = 0; i < data['sixth_second'].length; i++) {
                    var trimester = data['sixth_second'][i].trimester;
                    var level = data['sixth_second'][i].levelid;

                    var title = data['sixth_second'][i].course_title;
                    var code = data['sixth_second'][i].coursecode1;
                    var credits = data['sixth_second'][i].credits;
                    var grade = data['sixth_second'][i].grade;
                    // alert(code);
                    if (tempcode == data['sixth_second'][i].coursecode1 && tempgrade == data['sixth_second'][i].grade) {
                        tempcode = data['sixth_second'][i].coursecode1;
                        tempgrade = data['sixth_second'][i].grade;
                        continue;
                    } else if (tempcode == data['sixth_second'][i].coursecode1 && tempgrade != data['sixth_second'][i].grade) {
                        grade += "**";
                        tempcode = data['sixth_second'][i].coursecode1;
                        tempgrade = data['sixth_second'][i].grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['sixth_second'][i].coursecode1;
                    var tempgrade = data['sixth_second'][i].grade;

                    var six_two = true;
                    html17 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                // SIXTH YEAR THIRD TRIMESTER
                for (var i = 0; i < data['sixth_third'].length; i++) {
                    var trimester = data['sixth_third'][i].trimester;
                    var level = data['sixth_third'][i].levelid;

                    var title = data['sixth_third'][i].course_title;
                    var code = data['sixth_third'][i].coursecode1;
                    var credits = data['sixth_third'][i].credits;
                    var grade = data['sixth_third'][i].grade;
                    // alert(code);
                    if (tempcode == data['sixth_third'][i].coursecode1 && tempgrade == data['sixth_third'][i].grade) {
                        tempcode = data['sixth_third'][i].coursecode1;
                        tempgrade = data['fifth_second'][i].grade;
                    } else if (tempcode == data['sixth_third'][i].coursecode1 && tempgrade != data['sixth_third'][i].grade) {
                        grade += "**";
                        tempcode = data['sixth_third'][i].coursecode1;
                        tempgrade = data['sixth_third'][i].grade;
                        continue;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = data['sixth_third'][i].coursecode1;
                    var tempgrade = data['sixth_third'][i].grade;

                    var six_three = true;
                    html18 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                }

                //First Year Summary
                var summary1 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa1'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa1'></span> </td></tr>";
                var summary2 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa2'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa2'></span> </td></tr>";
                var summary3 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa3'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa3'></span> </td></tr>";
                //SECOND YEAR Summary
                var summary4 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa4'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa4'></span> </td></tr>";
                var summary5 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa5'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa5'></span> </td></tr>";
                var summary6 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa6'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa6'></span> </td></tr>";
                //THIRD YEAR Summary
                var summary7 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa7'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa7'></span> </td></tr>";
                var summary8 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa8'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa8'></span> </td></tr>";
                var summary9 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa9'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa9'></span> </td></tr>";
                //FOURTH YEAR Summary
                var summary10 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc10'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa10'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa10'></span> </td></tr>";
                var summary11 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc11'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa11'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa11'></span> </td></tr>";
                var summary12 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc12'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa12'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa12'></span> </td></tr>";
                //FIFTH YEAR Summary
                var summary13 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: CC: <span id='cc13'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa13'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa13'></span> </td></tr>";
                var summary14 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc14'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa14'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa14'></span> </td></tr>";
                var summary15 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc15'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa15'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa15'></span> </td></tr>";
                //SIXTH YEAR Summary
                var summary16 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc16'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa16'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa16'></span> </td></tr>";
                var summary17 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc17'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa17'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa17'></span> </td></tr>";
                var summary18 = "<tr style='text-align: left;font-weight: bold;color:black;'><td colspan='4'>CC: <span id='cc18'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='gpa18'></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id='cgpa18'></span> </td></tr>";


                html1 += summary1 + "</tbody></table><br>" /*</tr>"*/ ;
                html2 += summary2 + "</tbody></table><br>" /*</tr>"*/ ;
                html3 += summary3 + "</tbody></table><br>" /*</tr>"*/ ;
                html4 += summary4 + "</tbody></table><br>" /*</tr>"*/ ;
                html5 += summary5 + "</tbody></table><br>" /*</tr>"*/ ;
                html6 += summary6 + "</tbody></table><br>" /*</tr>"*/ ;
                html7 += summary7 + "</tbody></table><br>" /*</tr>"*/ ;
                html8 += summary8 + "</tbody></table><br>" /*</tr>"*/ ;
                html9 += summary9 + "</tbody></table><br>" /*</tr>"*/ ;
                html10 += summary10 + "</tbody></table><br>" /*</tr>"*/ ;
                html11 += summary11 + "</tbody></table><br>" /*</tr>"*/ ;
                html12 += summary12 + "</tbody></table><br>" /*</tr>"*/ ;
                html13 += summary13 + "</tbody></table><br>" /*</tr>"*/ ;
                html14 += summary14 + "</tbody></table><br>" /*</tr>"*/ ;
                html15 += summary15 + "</tbody></table><br>" /*</tr>"*/ ;
                html16 += summary16 + "</tbody></table><br>" /*</tr>"*/ ;
                html17 += summary17 + "</tbody></table><br>" /*</tr>"*/ ;
                html18 += summary18 + "</tbody></table><br>" /*</tr>"*/ ;


                var end = "</div>";

                var main = '';
                $.ajax({
                    type: 'POST',
                    url: 'toDisplay.php',
                    data: 'id=' + indexno,

                    success: function(json) {
                        if (json.includes(1)) {

                            main += session1;
                            if (one_one == true) {
                                main += html1;
                            } else {

                            }
                            if (one_two == true) {
                                main += html2;
                            } else {

                            }
                            if (one_three == true) {
                                main += html3;
                            } else {

                            }

                        }
                        if (json.includes(2)) {
                            main += session2;
                            if (two_one == true) {
                                main += html4;
                            } else {

                            }
                            if (two_two == true) {
                                main += html5;
                            } else {

                            }
                            if (two_three == true) {
                                main += html6;
                            } else {

                            }
                        }
                        if (json.includes(3)) {
                            main += session3;
                            if (three_one == true) {
                                main += html7;
                            } else {

                            }
                            if (three_two == true) {
                                main += html8;
                            } else {

                            }
                            if (three_three == true) {
                                main += html9;
                            } else {

                            }
                        }
                        if (json.includes(4)) {
                            main += session4;
                            if (four_one == true) {
                                main += html10;
                            } else {

                            }
                            if (four_two == true) {
                                main += html11;
                            } else {

                            }
                            if (four_three == true) {
                                main += html12;
                            } else {

                            }
                        }
                        if (json.includes(5)) {
                            main += session5;
                            if (five_one == true) {
                                main += html13;
                            } else {

                            }
                            if (five_two == true) {
                                main += html14;
                            } else {

                            }
                            if (five_three == true) {
                                main += html15;
                            } else {

                            }
                        }
                        if (json.includes(6)) {
                            main += session6;
                            if (six_one == true) {
                                main += html16;
                            } else {

                            }
                            if (six_two == true) {
                                main += html17;
                            } else {

                            }
                            if (six_three == true) {
                                main += html18;
                            } else {

                            }
                        }
                        main += end;
                        document.getElementById("trancriptTable").innerHTML = main;
                        averages(indexno);
                        total_credits(indexno);
                        watermark(indexno);
                        // signatory();
                    }
                });

            }

            $.ajax({
                type: 'POST',
                url: 'verify_id.php',
                data: 'id=' + indexno + '&trans=' + transid,

                success: function(resp) {
                    var code = "*T" + resp + "*";

                    $("#qrcode").barcode(
                        code,
                        "code128", {
                            showHRI: true,
                            barHeight: 20,
                            barWidth: 1,
                            output: "css",
                            fontSize: 20,
                            color: "#000000",
                            bgColor: "#FFFFFF",
                            moduleSize: 7,

                        }
                    );

                }
            })

            $("#trans_load").html("Preview");
            document.getElementById("trans_load").disabled = false;
        } //End of success
    })

}

function trans_profile(id) {

    $.ajax({
        type: 'POST',
        url: 'fetch_profile.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json);
            var date = moment().format("MMMM DD, YYYY");
            var name = data['name'];
            var index = data['index'];
            var sex = data['sex'];
            var dob = moment(data['dob']).format("MMMM DD, YYYY");
            var prog = data['prog'];
            var major = data['major'];
            var gradclass = data['gradclass'];
            if (data['graddate']) {
                var graddate = moment(data['graddate']).format("MMMM DD, YYYY");
            } else {

            }


            $("#trans_name").html(name);
            $("#trans_indexno").html(index);

            $("#awarded").html(prog);
            $("#dob").html(dob);

            $("#trans_major").html(major);
            $("#gender").html(sex);

            $("#date_awarded").html(graddate);

            $("#trans_class").html(gradclass);
            $("#trans_print_date").html(date);

            $("#final_class").html(gradclass);

        }
    })
}

function print() {
    printJS({
        printable: 'print_trans',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "transcript.css"]
    })
}

function print_english() {
    printJS({
        printable: 'printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "english_prof.css"]
    })
}

function print_confirmatory() {
    printJS({
        printable: 'con_printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "english_prof.css"]
    })
}

function print_introductory() {
    printJS({
        printable: 'intro_printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "english_prof.css"]
    })
}

function print_visa() {
    printJS({
        printable: 'visa_printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "english_prof.css"]
    })
}

function averages(id) {
    $.ajax({
        type: 'POST',
        url: 'averages.php',
        data: 'id=' + id,

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);

            for (var i = 0; i < data.length; i++) {
                var levelid = data[i].levelid;
                var trimid = data[i].trimid;
                var cwa = Number(data[i].cwa).toFixed(2);
                var present = Number(data[i].present).toFixed(2);
                var progname = data[i].progname;

                var _prog = progname.split(" ");
                for (var a = 0; a < _prog.length; a++) {
                    var __prog = _prog[0];
                }

                if (levelid == '1' && trimid == '1') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa1").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa1").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa1").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa1").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa1").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa1").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa1").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa1").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '1' && trimid == '2') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa2").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa2").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa2").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa2").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa2").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa2").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa2").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa2").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '1' && trimid == '3') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa3").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa3").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa3").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa3").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa3").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa3").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa3").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa3").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '2' && trimid == '1') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa4").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa4").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa4").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa4").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa4").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa4").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa4").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa4").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '2' && trimid == '2') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa5").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa5").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa5").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa5").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa5").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa5").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa5").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa5").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '2' && trimid == '3') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa6").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa6").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa6").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa6").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa6").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa6").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa6").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa6").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '3' && trimid == '1') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa7").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa7").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa7").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa7").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa7").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa7").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa7").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa7").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '3' && trimid == '2') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa8").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa8").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa8").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa8").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa8").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa8").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa8").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa8").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '3' && trimid == '3') {
                    if (__prog == "DIPLOMA") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa9").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa9").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa9").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa9").innerHTML = "CGPA: " + cwa;
                        }
                    } else {
                        if (cwa != "") {
                            if (cwa > 5) {
                                if (present != "") {
                                    document.getElementById("gpa9").innerHTML = "TWA: " + present;
                                }
                                document.getElementById("cgpa9").innerHTML = "CWA: " + cwa;
                            } else {
                                if (present != "") {
                                    document.getElementById("gpa9").innerHTML = "GPA: " + present;
                                }
                                document.getElementById("cgpa9").innerHTML = "CGPA: " + cwa;
                            }
                        }
                    }
                } else if (levelid == '4' && trimid == '1') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa10").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa10").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa10").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa10").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '4' && trimid == '2') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa11").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa11").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa11").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa11").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '4' && trimid == '3') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa12").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa12").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa12").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa12").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '5' && trimid == '1') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa13").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa13").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa13").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa13").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '5' && trimid == '2') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa14").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa14").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa14").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa14").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '5' && trimid == '3') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa15").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa15").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa15").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa15").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '6' && trimid == '1') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa16").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa16").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa16").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa16").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '6' && trimid == '2') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa17").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa17").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa17").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa17").innerHTML = "CGPA: " + cwa;
                        }
                    }
                } else if (levelid == '6' && trimid == '3') {
                    if (cwa != "") {
                        if (cwa > 5) {
                            if (present != "") {
                                document.getElementById("gpa18").innerHTML = "TWA: " + present;
                            }
                            document.getElementById("cgpa18").innerHTML = "CWA: " + cwa;
                        } else {
                            if (present != "") {
                                document.getElementById("gpa18").innerHTML = "GPA: " + present;
                            }
                            document.getElementById("cgpa18").innerHTML = "CGPA: " + cwa;
                        }
                    }
                }

                if (__prog == "DIPLOMA") {
                    if (cwa > 5) {
                        $(".label_cgpa").html("Final TWA:");
                        // $("#final_cgpa").html(final_cgpa);
                    } else {
                        $(".label_cgpa").html("Final CGPA:");
                    }
                } else {
                    if (cwa != "") {
                        if (cwa > 5) {
                            $(".label_cgpa").html("Final TWA:");
                        } else {
                            $(".label_cgpa").html("Final CGPA:");
                        }
                    }
                }

                if (__prog == "DIPLOMA") {
                    if (levelid == '2' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    } else if (levelid == '2' && trimid == '2') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }

                    } else if (levelid == '3' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }

                    } else if (levelid == '3' && trimid == '2') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }

                    } else {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    }
                } else {
                    if (levelid == '4' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    } else if (levelid == '4' && trimid == '2') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    } else if (levelid == '6' && trimid == '3') {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }

                    } else {
                        if (cwa != '') {
                            $("#trans_cgpa").html(cwa);
                            $("#final_cgpa").html(cwa);
                        }
                    }
                }


            }
        }
    });
}

function signatory() {
    $.ajax({
        url: 'signatory.php',

        success: function(json) {
            var signatory = json;
            document.getElementById("signed_for").innerHTML = signatory;
        }
    })
}

function letter_signatory() {
    $.ajax({
        url: 'letter_signatory.php',

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var post = data[i].post;
                var name = data[i].fullname;
            }
            var sig = "<strong>" + name + "</strong><br>" + post;
            $(".signatory").html(sig);
        }
    });
}

function total_credits(id) {
    $("#main_print_btn").disabled = true;
    $.ajax({
        type: 'POST',
        url: 'total_credits.php',
        data: 'id=' + id,

        success: function(json) {
            var data = JSON.parse(json);
            var counter = 0;
            for (var i = 0; i < data.length; i++) {
                var levelid = data[i].levelid;
                var trimid = data[i].trimester;
                var tt = new Number(data[i].tt);
                var cc = tt;
                counter += cc;

                if (levelid == '1' && trimid == '1') {
                    document.getElementById("cc1").innerHTML = counter;
                } else if (levelid == '1' && trimid == '2') {
                    document.getElementById("cc2").innerHTML = counter;
                } else if (levelid == '1' && trimid == '3') {
                    document.getElementById("cc3").innerHTML = counter;
                } else if (levelid == '2' && trimid == '1') {
                    document.getElementById("cc4").innerHTML = counter;
                } else if (levelid == '2' && trimid == '2') {
                    document.getElementById("cc5").innerHTML = counter;
                } else if (levelid == '2' && trimid == '3') {
                    document.getElementById("cc6").innerHTML = counter;
                } else if (levelid == '3' && trimid == '1') {
                    document.getElementById("cc7").innerHTML = counter;
                } else if (levelid == '3' && trimid == '2') {
                    document.getElementById("cc8").innerHTML = counter;
                } else if (levelid == '3' && trimid == '3') {
                    document.getElementById("cc9").innerHTML = counter;
                } else if (levelid == '4' && trimid == '1') {
                    document.getElementById("cc10").innerHTML = counter;
                } else if (levelid == '4' && trimid == '2') {
                    document.getElementById("cc11").innerHTML = counter;
                } else if (levelid == '4' && trimid == '3') {
                    document.getElementById("cc12").innerHTML = counter;
                } else if (levelid == '5' && trimid == '1') {
                    document.getElementById("cc13").innerHTML = counter;
                } else if (levelid == '5' && trimid == '2') {
                    document.getElementById("cc14").innerHTML = counter;
                } else if (levelid == '5' && trimid == '3') {
                    document.getElementById("cc15").innerHTML = counter;
                } else if (levelid == '6' && trimid == '1') {
                    document.getElementById("cc16").innerHTML = counter;
                } else if (levelid == '6' && trimid == '2') {
                    document.getElementById("cc17").innerHTML = counter;
                } else if (levelid == '6' && trimid == '3') {
                    document.getElementById("cc18").innerHTML = counter;
                }
            }
            $("#main_print_btn").disabled = false;
        }
    })
}

function addRequest() {
    $("#requestModal").modal('show');

    $("#req_send_btn").unbind("click").on('click', function() {
        var form = document.querySelector("#reqForm");
        var formdata = new FormData(form);

        var requests = $("#req_").val().toString();
        // alert(requests);
        var req_array = new Array();
        var elems = requests.split(',');
        for (var i = 0; i < elems.length; i++) {
            req_array.push(elems[i]);
        }
        //console.log(req_array[0]);
        $.ajax({
            type: 'POST',
            url: 'request_process.php',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function(response) {
                //console.log(response);
                if (response == '1') {
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


function load_issued() {
    $("#issTable").dataTable().fnDestroy();
    $("#issBody").html("<tr><td colspan='7' style='text-align: center;'><img src='../images/cube.gif'></td></tr>");
    $.ajax({
        type: 'POST',
        url: 'load_issued.php',

        success: function(json) {
            // console.log(json);
            var html = '';
            var data = JSON.parse(json);
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var service = [];
                var indexno = data[i].indexnum;
                var name = data[i].name;
                var issued_by = data[i].first_name + ' ' + data[i].middle_name + ' ' + data[i].last_name;
                var prog = data[i].progname;
                var date_issued = moment(data[i].action_date).format("DD MMM YYYY HH:mm:ss");
                var service_cat1 = data[i].service_cat1;
                var service_cat2 = data[i].service_cat2;
                var service_cat3 = data[i].service_cat3;
                var service_cat4 = data[i].service_cat4;
                var service_cat5 = data[i].service_cat5;

                if (service_cat1 != '') {
                    service.push(service_cat1);
                }
                if (service_cat2 != '') {
                    service.push(service_cat2);
                }
                if (service_cat3 != '') {
                    service.push(service_cat3);
                }
                if (service_cat4 != '') {
                    service.push(service_cat4);
                }
                if (service_cat5 != '') {
                    service.push(service_cat5);
                }

                html += "<tr><td>" + a + "</td><td>" + indexno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + service + "</td><td>" + date_issued + "</td><td>" + issued_by + "</td></tr>";
            }
            $("#issBody").html(html);
            $("#issTable").DataTable();
        }
    })
}

$("#sendMessage").on('click', function() {
    $(".compose").slideToggle();
})
$(".reply").on('click', function() {
    $(".compose_reply").slideToggle();
})
$(".reply_close").on('click', function() {
    $(".compose_reply").slideToggle();
})

$("#send_reply").on('click', function() {
    var value = $("#reply_editor").html();
    var subject = $("#subject").val();
    // alert(value);
    $.ajax({
        type: 'POST',
        url: 'message_upload.php',
        data: 'message=' + value + '&subj=' + subject,

        success: function(response) {
            if (response == '1') {
                document.getElementById("reply_editor").innerHTML = '';
                document.getElementById("subject").value = '';
                new PNotify({
                    title: 'Success',
                    text: 'Message Sent',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            } else {
                new PNotify({
                    title: 'Error',
                    text: response,
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        }
    })
})

function load_reported() {
    $.ajax({
        url: 'load_reported.php',

        success: function(json) {
            var html = '';
            var data = JSON.parse(json);
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var subj = data[i].subject;
                if (subj == null) {
                    subj = '';
                }
                var message = data[i].message;
                var name = data[i].name;
                var date = moment(data[i].date).format("DD-MMM-YYYY HH:mm:ss");

                html += "<tr><td>" + a + "</td><td>" + subj + "</td><td>" + message + "</td><td>" + name + "</td><td>" + date + "</td></tr>";
            }
            $("#repBody").html(html);
        }
    })
}
$("#flag_btn").on('click', function() {
    $("#flagged").modal('show');
})

function view_flagged() {
    $.ajax({
        url: 'load_flagged.php',

        success: function(response) {
            var data = JSON.parse(response),
                html = '',
                i = 0,
                a = 1;

            for (i, a; i < data.length, a < data.length + 1; i++, a++) {
                var uin = data[i].indexno;
                var req_id = data[i].trans_uin;
                var name = data[i].name;
                var programme = data[i].progname;
                var serv_type = data[i].service_type;
                var submit_date = moment(data[i].submitted_date).format("DD-MMM-YYYY HH:mm:ss");

                var print_btn = "<button onclick='unflag(\"" + req_id + "\")' class='btn btn-sm btn-success'>Unflag</button>";

                html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + serv_type + "</td><td>" + submit_date + "</td><td>" + print_btn + "</td></tr>";
            }
            document.getElementById("flagBody").innerHTML = html;
            $("#flagTable").DataTable();
        }
    })
}

function watermark(studentid) {
    var value = '';
    $.ajax({
        async: false,
        type: 'POST',
        url: 'watermark.php',
        data: 'id=' + studentid,

        success: function(json) {
            // alert(json);
            var values = json.split(",");
            var qual = values[0];
            var bal = values[1];

            if (bal == 'Owing') {
                document.getElementById("banner_row").style.visibility = 'visible';
                $("#banner").html("**OWING**");
            } else if (qual == 'Fake') {
                document.getElementById("banner_row").style.visibility = 'visible';
                $("#banner").html("**FAKE**");
            } else {
                document.getElementById("banner_row").style.visibility = 'hidden';
            }
        }
    })
}

function letter_watermark(studentid) {
    var value = '';
    $.ajax({
        async: false,
        type: 'POST',
        url: 'watermark.php',
        data: 'id=' + studentid,

        success: function(json) {
            var values = json.split(",");
            var qual = values[0];
            var bal = values[1];

            if (bal == 'Owing') {
                document.getElementById("letter_banner_row intro_letter_banner_row").style.visibility = 'visible';
                $("#letter_banner intro_letter_banner").html("**OWING**");
            } else {
                document.getElementById("letter_banner_row intro_letter_banner_row").style.visibility = 'hidden';
            }
        }
    })
}

function intro_letter_watermark(studentid) {
    var value = '';
    $.ajax({
        async: false,
        type: 'POST',
        url: 'watermark.php',
        data: 'id=' + studentid,

        success: function(json) {
            var values = json.split(",");
            var qual = values[0];
            var bal = values[1];

            if (bal == 'Owing') {
                document.getElementById("intro_letter_banner_row").style.visibility = 'visible';
                $("#intro_letter_banner").html("**OWING**");
            } else {
                document.getElementById("intro_letter_banner_row").style.visibility = 'hidden';
            }
        }
    })
}

function con_letter_watermark(studentid) {
    var value = '';
    $.ajax({
        async: false,
        type: 'POST',
        url: 'watermark.php',
        data: 'id=' + studentid,

        success: function(json) {
            var values = json.split(",");
            var qual = values[0];
            var bal = values[1];

            if (bal == 'Owing') {
                document.getElementById("con_letter_banner_row").style.visibility = 'visible';
                $("#con_letter_banner").html("**OWING**");
            } else {
                document.getElementById("con_letter_banner_row").style.visibility = 'hidden';
            }
        }
    })
}


function bsc() {
    $("#bscBackModal").modal("show");
}

function dmls() {
    $("#dmlsBackModal").modal("show");
}

function printBSC() {
    printJS({
        printable: 'print_bsc',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "transcript.css"]
    })
}

function printDMLS() {
    printJS({
        printable: 'print_dmls',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "transcript.css"]
    })
}

function ghapes(values) {
    console.log("ghapes "+values);
    var value = values.split(",");
    var track = value[0];
    var msg = value[1];

    var fd = new FormData();
    fd.append("tracking_id", track);
    fd.append("msg", msg);

    $.ajax({
        type: "POST",
        data: fd,
        url: "feedback.php",
        contentType: false,
        processData: false,
        cache: false,

        success: function(response) {
            console.log("API Response: " + response);
        }
    });
}

$(document).ready(function() {
    "use strict";
    load_data();
    load_reported();

});