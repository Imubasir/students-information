/*global $, document, details, alert, window, console*/
/*jslint node: true */

"use strict";

function load_data() {
    $("#reqTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
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
                var indexno = data[i].Sindexno;
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
                var indexno = data[i].Sindexno;
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
            // console.log(response);

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

function trans(id) {
    $("#view_results").modal('show');
    $.ajax({
        type: 'POST',
        url: 'transcript.php',
        data: 'id=' + id,

        success: function(response) {
                $("#transcriptModal").modal('show');
                // console.log(response);
                //            display(id);
                var data = JSON.parse(response);

                for (var a = 0; a < data.length; a++) {
                    var prog = data[data.length - 1].progname;
                }
                var _prog = prog.split(" ");
                for (var i = 0; i < _prog.length; i++) {
                    var __prog = _prog[0];
                }

                // Create Headers (Level and Trimester) for Diploma.
                if (__prog.trim() == "DIPLOMA") {

                    var html1 = '';
                    var header = "<table id='trans_table' class='table table-hover'><thead></thead><tr><th>Course Code</th><th style='width: 60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr><tbody>";
                    // var header = "";
                    html1 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='one'>FIRST YEAR</h5></div><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html1 += header;

                    var html2 = '';
                    html2 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html2 += header;

                    var html3 = '';
                    html3 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html3 += header;

                    //SECOND YEAR
                    var html4 = '';
                    html4 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two'>SECOND YEAR</h5></div><br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html4 += header;

                    var html5 = '';
                    html5 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html5 += header;

                    var html6 = '';
                    html6 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html6 += header;

                    //THIRD YEAR
                    var html7 = '';
                    html7 += "<div id='thirdyear' class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='three'>THIRD YEAR</h5></div><br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html7 += header;

                    var html8 = '';
                    html8 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>SECOND TRIMESTER</label>";
                    html8 += header;

                    var html9 = '';
                    html9 += "<div style='text-align:center;width:100%'></div><br><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html9 += header;

                    trans_profile(id);


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

                        //Add Courses, Grades and Credits to table.

                        if (level == '1' && trimester == '1') {
                            html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '1' && trimester == '2') {
                            html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '1' && trimester == '3') {
                            html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr></tr>";
                        } else if (level == '2' && trimester == '1') {
                            html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '2') {
                            html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '3') {
                            html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '3' && trimester == '1') {
                            html7 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '3' && trimester == '2') {
                            html8 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '3' && trimester == '3') {
                            html9 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        }
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


                    html1 += summary1 + "</tbody></table>";
                    html2 += summary2 + "</tbody></table>";
                    html3 += summary3 + "</tbody></table>";

                    html4 += summary4 + "</tbody></table>";
                    html5 += summary5 + "</tbody></table>";
                    html6 += summary6 + "</tbody></table>";

                    html7 += summary7 + "</tbody></table>";
                    html8 += summary8 + "</tbody></table>";
                    html9 += summary9 + "</tbody></table>";

                    var end = "</div>";

                    var main = '';

                    $.ajax({
                        type: 'POST',
                        url: 'toDisplay.php',
                        data: 'id=' + id,

                        success: function(json) {
                            // main += trans_header;
                            if (json.includes(1)) {
                                main += html1;
                                main += html2;
                                main += html3;
                            }
                            if (json.includes(2)) {
                                main += html4;
                                main += html5;
                                main += html6;
                            }
                            if (json.includes(3)) {
                                main += html7;
                                main += html8;
                                main += html9;
                            }
                            main += end;
                            averages(id);
                            total_credits(id);
                            signatory();
                            document.getElementById("trancriptTable").innerHTML = main;
                        }
                    });

                } else {

                    var html1 = '';
                    var header = "<table id='trans_table' class='table table-hover'><thead><tr><th>Course Code</th><th style='width:60%;'>Course Title</th><th>Credits</th><th>Grade</th></tr></thead><tbody>";
                    html1 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='one'>FIRST YEAR</h5></div><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html1 += header;

                    var html2 = '';
                    html2 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html2 += header;

                    var html3 = '';
                    html3 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html3 += header;

                    //SECOND YEAR
                    var html4 = '';
                    html4 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='two'>SECOND YEAR</h5></div><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html4 += header;

                    var html5 = '';
                    html5 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html5 += header;

                    var html6 = '';
                    html6 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html6 += header;

                    //THIRD YEAR
                    var html7 = '';
                    html7 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='three'>THIRD YEAR</h5></div><br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html7 += header;

                    var html8 = '';
                    html8 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html8 += header;

                    var html9 = '';
                    html9 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html9 += header;

                    //Fourth
                    var html10 = '';
                    html10 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>FOURTH YEAR</h5></div><br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html10 += header;

                    var html11 = '';
                    html11 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html11 += header;

                    var html12 = '';
                    html12 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html12 += header;

                    //Fifth
                    var html13 = '';
                    html13 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>FIFTH YEAR</h5></div><br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html13 += header;

                    var html14 = '';
                    html14 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html14 += header;

                    var html15 = '';
                    html15 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html15 += header;

                    //Sixth
                    var html16 = '';
                    html16 += "<div class='headStyle' style='text-align:center;width:100%;font-size: 20px;font-weight: bold;color: #1c7911;'><h5 class='four'>SIXTH YEAR</h5></div><br><label style='font-weight:bold;color:black;'>FIRST TRIMESTER RESULTS</label>";
                    html16 += header;

                    var html17 = '';
                    html17 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>SECOND TRIMESTER RESULTS</label>";
                    html17 += header;

                    var html18 = '';
                    html18 += "<div style='text-align:center;width:100%'></div><label style='font-weight:bold;color:black;'>THIRD TRIMESTER RESULTS</label>";
                    html18 += header;


                    trans_profile(id);


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
                            html1 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '1' && trimester == '2') {
                            html2 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '1' && trimester == '3') {
                            html3 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr></tr>";
                        } else if (level == '2' && trimester == '1') {
                            html4 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '2') {
                            html5 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '2' && trimester == '3') {
                            html6 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '3' && trimester == '1') {
                            html7 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '3' && trimester == '2') {
                            html8 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '3' && trimester == '3') {
                            html9 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '4' && trimester == '1') {
                            html10 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '4' && trimester == '2') {
                            html11 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '4' && trimester == '3') {
                            html12 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '5' && trimester == '1') {
                            html13 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '5' && trimester == '2') {
                            html14 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '5' && trimester == '3') {
                            html15 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '6' && trimester == '1') {
                            html16 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '6' && trimester == '2') {
                            html17 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        } else if (level == '6' && trimester == '3') {
                            html18 += "<tr><td>" + code + "</td><td>" + title + "</td><td>" + credits + "</td><td>" + grade + "</td></tr>";
                        }
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


                    html1 += summary1 + "</tbody></table>";
                    html2 += summary2 + "</tbody></table>";
                    html3 += summary3 + "</tbody></table>";
                    html4 += summary4 + "</tbody></table>";
                    html5 += summary5 + "</tbody></table>";
                    html6 += summary6 + "</tbody></table>";
                    html7 += summary7 + "</tbody></table>";
                    html8 += summary8 + "</tbody></table>";
                    html9 += summary9 + "</tbody></table>";
                    html10 += summary10 + "</tbody></table>";
                    html11 += summary11 + "</tbody></table>";
                    html12 += summary12 + "</tbody></table>";
                    html13 += summary13 + "</tbody></table>";
                    html14 += summary14 + "</tbody></table>";
                    html15 += summary15 + "</tbody></table>";
                    html16 += summary16 + "</tbody></table>";
                    html17 += summary17 + "</tbody></table>";
                    html18 += summary18 + "</tbody></table>";


                    var end = "</div>";

                    var main = '';
                    $.ajax({
                        type: 'POST',
                        url: 'toDisplay.php',
                        data: 'id=' + id,

                        success: function(json) {
                            // console.log(json);
                            if (json.includes(1)) {
                                main += html1;
                                main += html2;
                                main += html3;
                            }
                            if (json.includes(2)) {
                                main += html4;
                                main += html5;
                                main += html6;
                            }
                            if (json.includes(3)) {
                                main += html7;
                                main += html8;
                                main += html9;
                            }
                            if (json.includes(4)) {
                                main += html10;
                                main += html11;
                                main += html12;
                            }
                            if (json.includes(5)) {
                                main += html13;
                                main += html14;
                                main += html15;
                            }
                            if (json.includes(6)) {
                                main += html16;
                                main += html17;
                                main += html18;
                            }
                            main += end;
                            document.getElementById("trancriptTable").innerHTML = main;
                            averages(id);
                            total_credits(id);
                            signatory();
                        }
                    });

                }

                $("#qrcode").barcode(
                    "12345",
                    "datamatrix", {
                        showHRI: true,
                        barHeight: 45,
                        barWidth: 3,
                        output: "bmp",
                        fontSize: 15,
                        color: "#000000",
                        bgColor: "#FFFFFF",
                        moduleSize: 7,
                    }
                );

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
            var graddate = data['graddate'];

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
                    } else if (levelid == '3' && trimid == '3') {
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
                    } else if (levelid == '6' && trimid == '3') {
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
        }
    })
}

function addRequest() {
    $("#requestModal").modal('show');

    $("#req_send_btn").unbind("click").on('click', function() {
        var form = document.querySelector("#reqForm");
        var formdata = new FormData(form);

        var requests = $("#req_").val().toString();
        alert(requests);
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

// document.getElementById("req_").addEventListener('click', function() {
//    var val = $("#req_").val().toString();
//    // alert(val);
//    var inputs = val.split(",");
//    if(inputs.includes('cf')) {
//     document.getElementById("cf_q").style.display = 'block';
//    } else {
//     document.getElementById("cf_q").style.display = 'none';
//    }

//    if(inputs.includes('trans')) {
//     document.getElementById("trans_q").style.display = 'block';
//    } else {
//     document.getElementById("trans_q").style.display = 'none';
//    }

//    if(inputs.includes('loa')) {
//     document.getElementById("loa_q").style.display = 'block';
//    } else {
//     document.getElementById("loa_q").style.display = 'none';
//    }

//    if(inputs.includes('ep')) {
//     document.getElementById("ep_q").style.display = 'block';
//    } else {
//     document.getElementById("ep_q").style.display = 'none';
//    }
// })

function display() {

}

$(document).ready(function() {
    "use strict";
    load_data();

});