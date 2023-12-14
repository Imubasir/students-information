/*global $, document, details, alert, window, console*/
/*jslint node: true */

"use strict";

function load_data() {
    // $("#reqTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',

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

                if (a == '1') {
                    var print_btn = "<button onclick='details(\"" + req_id + "\")' class='btn btn-sm btn-success'>View</button>";
                    localStorage.setItem("re1_id", req_id);
                } else {
                    print_btn = "";
                }

                html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + serv_type + "</td><td>" + submit_date + "</td><td>" + print_btn + "</td></tr>";
            }
            document.getElementById("sigBody").innerHTML = html;
            $("#reqTable").DataTable();
        }
    })
}

function details(id) {
    // $("#service_tbl").dataTable.fnDestroy();
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
                var programme = data[i].progname;
                var name = data[i].name;
                var cat1 = data[i].service_cat1;
                var cat2 = data[i].service_cat2;
                var cat3 = data[i].service_cat3;
                var cat4 = data[i].service_cat4;

                var cat1_status = data[i].cat1_status;
                var cat2_status = data[i].cat2_status;
                var cat3_status = data[i].cat3_status;
                var cat4_status = data[i].cat4_status;

                if (cat1_status == '1') {
                    var trans_btn = "";
                } else if (cat1_status == '0') {
                    var trans_btn = "<button onclick='completed_trans(\"" + uin + "\")' class='btn btn-sm btn-default'>Done</button>";
                }

                if (cat2_status == '1') {
                    var prof_btn = "";
                } else if (cat2_status == '0') {
                    var prof_btn = "<button onclick='completed_prof(\"" + uin + "\")' class='btn btn-sm btn-default'>Done</button>";
                }

                if (cat3_status == '1') {
                    var loa_btn = "";
                } else if (cat3_status == '0') {
                    var loa_btn = "<button onclick='completed_loa(\"" + uin + "\")' class='btn btn-sm btn-default'>Done</button>";
                }

                if (cat4_status == '1') {
                    var conf_btn = "";
                } else if (cat4_status == '0') {
                    var conf_btn = "<button onclick='completed_conf(\"" + uin + "\")' class='btn btn-sm btn-default'>Done</button>";
                }

                var quantity1 = data[i].quantity1;
                var quantity2 = data[i].quantity2;
                var quantity3 = data[i].quantity3;
                var quantity4 = data[i].quantity4;

                var del_mode = data[i].delivery_mode;

                if (cat1 != '' && cat1_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat1 + "</td><td>" + quantity1 + "</td><td>" + del_mode + "</td><td><button onclick='trans(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + trans_btn + "</td></tr>";
                    a++;
                } else if (cat1 != '' && cat1_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat1 + "</td><td>" + quantity1 + "</td><td>" + del_mode + "</td><td>" + /**+"<button onclick='trans(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + trans_btn + **/ "</td></tr>";
                    a++;
                }



                if (cat2 != '' && cat2_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat2 + "</td><td>" + quantity2 + "</td><td>" + del_mode + "</td><td><button onclick='prof(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + prof_btn + "</td></tr>";
                    a++;
                } else if (cat2 != '' && cat2_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat2 + "</td><td>" + quantity2 + "</td><td>" + del_mode + "</td><td>" + /**+"<button onclick='prof(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + prof_btn + **/ "</td></tr>";
                    a++;
                }



                if (cat3 != '' && cat3_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat3 + "</td><td>" + quantity3 + "</td><td>" + del_mode + "</td><td><button onclick='loa(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + loa_btn + "</td></tr>";
                    a++;
                } else if (cat3 != '' && cat3_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat3 + "</td><td>" + quantity3 + "</td><td>" + del_mode + "</td><td>" + /**+"<button onclick='loa(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + loa_btn + **/ "</td></tr>";
                    a++;
                }



                if (cat4 != '' && cat4_status == '0' && a == '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat4 + "</td><td>" + quantity4 + "</td><td>" + del_mode + "</td><td><button onclick='conf(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + conf_btn + "</td></tr>";
                    a++;
                } else if (cat4 != '' && cat4_status == '0' && a != '1') {
                    html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + programme + "</td><td>" + cat4 + "</td><td>" + quantity4 + "</td><td>" + del_mode + "</td><td>" /**"<button onclick='conf(\"" + index + "\")' class='btn btn-sm btn-success'>Preview</button>&nbsp;&nbsp;" + conf_btn **/ + "</td></tr>";
                    a++;
                }
            }

            document.getElementById("detBody").innerHTML = html;
            document.getElementById("main_trans").style.display = 'none';
            document.getElementById("trans_details").style.display = 'block';
            document.getElementById("reported_table").style.display = 'none';


        }
    })

    // report(id);

}

function prof(id) {
    $.ajax({
        type: 'POST',
        url: 'english_prof.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexno = data[i].indexno;
                var name = data[i].name;
                var numyears = data[i].numyears;
                var deg = data[i].deg;
                var fullname = data[i].fullname;
                var progname = data[i].progname;
                var gender = data[i].gender;
                var title = data[i].title;
            }
            $(".name").html(name);
            $(".progfullname").html(fullname);
            $(".gender").html(gender);
            $(".years").html(numyears);
            $("#our_ref").html(indexno);
            letter_signatory();
            $("#profModal").modal('show');

        }

    })
}

function conf(id) {
    $("#confirmModal").modal('show');
    $.ajax({
        type: 'POST',
        url: 'confirmatory.php',
        data: 'id=' + id,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexno = data[i].indexno;
                var name = data[i].name;
                var numyears = data[i].numyears;
                var deg = data[i].deg;
                var fullname = data[i].fullname;
                var progname = data[i].progname;
                var gender = data[i].gender;
                var entryyear = data[i].entryyear;
                var gradclass = data[i].gradclass;
                var facultyname = data[i].facultyname;
                var facid = data[i].facid;

            }

            $(".con_id").html(indexno);
            $(".con_name").html(name);
            $(".con_facname").html(facultyname);
            $(".con_admn_yr").html(entryyear);
            $(".con_prgname").html(progname);
            $(".con_gradclass").html(gradclass);
            $(".con_gender").html(gender);
            letter_signatory();
        }
    })
}

// function loa(id) {
//     $.ajax({
//         type: 'POST',
//         url: 'loa.php',
//         data: 'id=' + id,

//         success: function(response) {

//         }
//     })
// }

function completed_loa(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(response) {
            //console.log(response);

            // document.getElementById(id).style.cursor = 'not-allowed';
            // document.getElementById(id).disabled = true;


        }
    })

    $.ajax({
        type: 'POST',
        url: 'update_loa.php',
        data: 'id=' + id,

        success: function(response_1) {
            load_data();
            var req_id = localStorage.getItem("re1_id", req_id);
            // $("#service_tbl").dataTable.fnDestroy();
            details(req_id);
        }
    })
}

function completed_trans(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(response) {
            //console.log(response);

            // document.getElementById(id).style.cursor = 'not-allowed';
            // document.getElementById(id).disabled = true;
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

        success: function(response) {
            //console.log(response);
            // document.getElementById(id).style.cursor = 'not-allowed';
            // document.getElementById(id).disabled = true;

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

function completed_conf(id) {
    $.ajax({
        type: 'POST',
        url: 'update_req.php',
        data: 'id=' + id,

        success: function(response) {
            // document.getElementById(id).style.cursor = 'not-allowed';
            // document.getElementById(id).disabled = true;
            //console.log(response);


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

function trans(id) {
    $("#view_results").modal('show');
    trans_profile(id);
    $.ajax({
        type: 'POST',
        url: 'transcript.php',
        data: 'id=' + id,

        success: function(response) {
                console.log(response);
                $("#transcriptModal").modal('show');
                var data = JSON.parse(response);

                for (var a = 0; a < data.length; a++) {
                    var prog = data[data.length - 1].progname;
                }

                var html1 = '';
                var header = "<table style='width:100%;border-bottom: 2px solid black;' class='table inner_tbl'><thead class='inner_thead'><tr><th>Course Code</th><th style='width:60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";

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
                var html4 = '';
                var session2 = "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two' id='ssheader'>SECOND YEAR STREAM</h5></div>";
                html4 += "<label id='ssftheader' style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>"; 
                html4 += header;

                var html5 = '';
                html5 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                html5 += header;

                var html6 = '';
                html6 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                html6 += header;

                for (var i = 0; i < data.length; i++) {
                    var trimester = data[i].trimester;
                    var level = data[i].levelid;

                    var title = data[i].course_title;
                    var code = data[i].coursecode1;
                    var credits = data[i].credits;
                    var grade = data[i].grade;

                    if (tempcode == code && tempgrade == grade) {
                        tempcode = code;
                        tempgrade = grade;
                    } else if (tempcode == code && tempgrade != grade) {
                        grade += "**";
                        tempcode = code;
                        tempgrade = grade;
                    } else {
                        if (grade == "F") {
                            grade += "*";
                        }
                    }
                    var tempcode = code;
                    var tempgrade = grade;

                    if (level == '1' && trimester == '1') {
                        var one_one = true;
                        html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                    } else if (level == '1' && trimester == '2') {
                        var one_two = true;
                        html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                    } else if (level == '1' && trimester == '3') {
                        var one_three = true;
                        html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                    } else if (level == '2' && trimester == '1') {
                        var two_one = true;
                        html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                    } else if (level == '2' && trimester == '2') {
                        var two_two = true;
                        html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                    } else if (level == '2' && trimester == '3') {
                        var two_three = true;
                        html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                    } 
                }


                 html1 += "</tbody></table><br>" /*</tr>"*/ ;
                html2 += "</tbody></table><br>" /*</tr>"*/ ;
                html3 += "</tbody></table><br>" /*</tr>"*/ ;
                html4 += "</tbody></table><br>" /*</tr>"*/ ;
                html5 += "</tbody></table><br>" /*</tr>"*/ ;
                html6 += "</tbody></table><br>" /*</tr>"*/ ;


                var end = "</div>";

                var main = '';
                $.ajax({
                    type: 'POST',
                    url: 'toDisplay.php',
                    data: 'id=' + id,

                    success: function(json) {
                        console.log(json);
                        if (json.includes(1)) {
                            
                            main += session1;

                            if(one_one == true) {
                                main += html1;
                            } else {
                                
                            }
                            if(one_two == true) {
                                main += html2;
                            } else {

                            }
                            if(one_three == true) {
                                main += html3;
                            } else {

                            }
                        }

                        if (json.includes(2)) {
                            main += session2;
                            if(two_one == true) {
                                main += html4;
                            } else {

                            }
                            if(two_two == true) {
                                main += html5;
                            } else {

                            }
                            if(two_three == true) {
                                main += html6;
                            } else {

                            }
                        }
                        
                        main += end;
                        document.getElementById("trancriptTable").innerHTML = main;
                        signatory();

                        if(one_one == true) {
                            $("#ssftheader").html("");
                        }

                        if(two_two == true) {
                            $("#ssheader").html("SECOND YEAR");
                            $("#ssftheader").html("FIRST TRIMESTER RESULTS");
                        }
                    }
                });


                var trans = localStorage.getItem("trans");
                var index = localStorage.getItem("index");

                $.ajax({
                    type: 'POST',
                    url: 'verify_id.php',
                    data: 'id=' + index + '&trans=' + trans,

                    success: function(resp) {
                        var code = "*T" + resp + "*";

                        $("#qrcode").barcode(
                            code,
                            "code128", {
                                showHRI: true,
                                barHeight: 45,
                                barWidth: 4,
                                output: "css",
                                fontSize: 20,
                                color: "#000000",
                                bgColor: "#FFFFFF",
                                moduleSize: 7,

                            }
                        );
                    }
                })
            } //End of success
    })
}

function trans_profile(id) {
    $.ajax({
        type: 'POST',
        url: 'fetch_profile.php',
        data: 'id=' + id,

        success: function(json) {
            console.log(json);
            var data = JSON.parse(json);
            var date = moment().format("MMMM DD, YYYY");
            var name = data['name'];
            var index = data['index'];
            var sex = data['sex'];
            var dob = moment(data['dob']).format("MMMM DD, YYYY");
            var prog = data['prog'];
            var gradclass = data['gradclass'];
            var graddate = data['graddate'];

            $("#trans_name").html(name);
            $("#trans_indexno").html(index);

            $("#awarded").html(prog);
            $("#dob").html(dob);

            $("#grad_class").html(gradclass);
            $("#gender").html(sex);

            $("#date_awarded").html(graddate);

            $("#trans_print_date").html(date);


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

function load_issued() {
    $("#issTable").dataTable().fnDestroy();
    $("#issBody").html("<tr><td colspan='7' style='text-align: center;'><img src='../images/cube.gif'></td></tr>");
    $.ajax({
        type: 'POST',
        url: 'load_issued.php',

        success: function(json) {
            //console.log(json);
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

$(document).ready(function() {
    "use strict";
    load_data();

});