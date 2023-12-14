/*$, document, window, alert, window */

function view_details(uin) {
    $("#detailsModal").modal('show');
    $.ajax({
        type: 'POST',
        url: 'fetch_details.php',
        data: 'id=' + uin,

        success: function(json) {
            // console.log(json);
            var data = JSON.parse(json),
                i = 0;

            for (i; i < data.length; i++) {
                var indexno = data[i].indexno;
                var currentlevel = data[i].currentlevel;
                var date_added = data[i].date_added;
                var disability_status = data[i].disability_status;
                var disability_descr = data[i].disability_descr;
                var dob = moment(data[i].dob).format("DD-MMM-YYYY");
                var entrylevel = data[i].entrylevel;
                var entryyear = data[i].entryyear;
                var firstname = data[i].firstname;
                var fonnumber = data[i].fonnumber;
                var gender = data[i].gender;
                if (gender == "M") {
                    var gender = "Male";
                } else if (gender == "F") {
                    var gender = "Female";
                }
                var guardian_name = data[i].guardian_name;
                var homeaddress = data[i].homeaddress;
                var htown = data[i].htown;
                var inst_mail = data[i].inst_mail;
                var middlename = data[i].middlename;
                var nationality = data[i].countrynm;
                var option_id = data[i].option_title;
                var pic_id = data[i].pic_id;
                var pob = data[i].pob;
                var qualification_status = data[i].qualification_status;
                var rob = data[i].regionname;
                var sprogid = data[i].progname;
                var study_status = data[i].study_status;
                if (study_status == '') {
                    study_status = "Unknown";
                }
                var surname = data[i].surname;
                var uin = data[i].uin;
                var username = data[i].username;

                var name = firstname + ' ' + middlename + ' ' + surname;

                document.getElementById("uin").innerHTML = uin;
                document.getElementById("stud_id").innerHTML = indexno;
                document.getElementById("stud_name").innerHTML = name;
                document.getElementById("dob").innerHTML = dob;
                document.getElementById("gender").innerHTML = gender;
                document.getElementById("country").innerHTML = nationality;
                document.getElementById("qualification").innerHTML = qualification_status;
                document.getElementById("study_status").innerHTML = study_status;
                document.getElementById("prog").innerHTML = sprogid;
                document.getElementById("admin_year").innerHTML = entryyear;
                document.getElementById("inst_email").innerHTML = inst_mail;
                document.getElementById("prog_opt").innerHTML = option_id;
                document.getElementById("entry_lvl").innerHTML = entrylevel+"00";
                document.getElementById("cur_lvl").innerHTML = currentlevel+"00";
                document.getElementById("pob").innerHTML = pob;
                document.getElementById("htown").innerHTML = htown;
                document.getElementById("dis_status").innerHTML = disability_status;
                document.getElementById("gurd_name").innerHTML = guardian_name;
                document.getElementById("rob").innerHTML = rob;
                document.getElementById("hme_addrs").innerHTML = homeaddress;
                document.getElementById("dis_descr").innerHTML = disability_descr;
                document.getElementById("contact").innerHTML = fonnumber;

            }
            // details(uin);
            // academic_history(indexno);
        }
    })
}

function print() {
    printJS({
        printable: 'printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "view.css"]
    })
}

// function details(id) {
//     $.ajax({
//         type: 'POST',
//         url: 'details.php',
//         data: 'id=' + id,

//         success: function(response) {
//             //console.log("Waec Results");
//             console.log(response);
//             var data = JSON.parse(response);
//             var html = '';

//             // var name = data.firstname + ' ' + data.middlename + ' ' + data.surname;
//             var sgd1 = data.sgd1;
//             var sgd10 = data.sgd10;
//             var sgd2 = data.sgd2;
//             var sgd3 = data.sgd3;
//             var sgd4 = data.sgd4;
//             var sgd7 = data.sgd7;
//             var sgd8 = data.sgd8;
//             var sgd9 = data.sgd9;

//             var ssub1 = data.ssub1;
//             var ssub10 = data.ssub10;
//             var ssub2 = data.ssub2;
//             var ssub3 = data.ssub3;
//             var ssub4 = data.ssub4;
//             var ssub7 = data.ssub7;
//             var ssub8 = data.ssub8;
//             var ssub9 = data.ssub9;

//             // var student_no = data.student_no;
//             var uin = data.uin;
//             var wgd1 = data.wgd1;
//             var wgd10 = data.wgd10;
//             var wgd2 = data.wgd2;
//             var wgd3 = data.wgd3;
//             var wgd4 = data.wgd4;
//             var wgd7 = data.wgd7;
//             var wgd8 = data.wgd8;
//             var wgd9 = data.wgd9;

//             var windexno = data.index;
//             var wname = data.wname;
//             var name = data.name;


//             var wsub1 = data.wsub1;
//             var wsub10 = data.wsub10;
//             var wsub2 = data.wsub2;
//             var wsub3 = data.wsub3;
//             var wsub4 = data.wsub4;
//             var wsub7 = data.wsub7;
//             var wsub8 = data.wsub8;
//             var wsub9 = data.wsub9;


//             html += "<tr><td rowspan='8'>" + windexno + "</td><td rowspan='8'>" + name + "</td><td>" + ssub1 + "</td><td>" + sgd1 + "</td><td>" + wgd1 + "</td><td>" + wsub1 + "</td><td rowspan='8'>" + wname + "</td></tr>";

//             html += "<tr><td>" + ssub2 + "</td><td>" + sgd2 + "</td><td>" + wgd2 + "</td><td>" + wsub2 + "</td></tr>";
//             html += "<tr><td>" + ssub3 + "</td><td>" + sgd3 + "</td><td>" + wgd3 + "</td><td>" + wsub3 + "</td></tr>";
//             html += "<tr><td>" + ssub4 + "</td><td>" + sgd4 + "</td><td>" + wgd4 + "</td><td>" + wsub4 + "</td></tr>";
//             html += "<tr><td>" + ssub7 + "</td><td>" + sgd7 + "</td><td>" + wgd7 + "</td><td>" + wsub7 + "</td></tr>";
//             html += "<tr><td>" + ssub8 + "</td><td>" + sgd8 + "</td><td>" + wgd8 + "</td><td>" + wsub8 + "</td></tr>";
//             html += "<tr><td>" + ssub9 + "</td><td>" + sgd9 + "</td><td>" + wgd9 + "</td><td>" + wsub9 + "</td></tr>";
//             html += "<tr><td>" + ssub10 + "</td><td>" + sgd10 + "</td><td>" + wgd10 + "</td><td>" + wsub10 + "</td></tr>";

//             document.getElementById("veri_Body").innerHTML = html;
//             if (!windexno) {
//                 document.getElementById("shs_content_header").style.display = 'none';
//                 document.getElementById("shs_content_2").style.display = 'none';
//             } else {
//                 document.getElementById("shs_content_header").style.display = 'block';
//                 document.getElementById("shs_content_2").style.display = 'block';
//             }
//         }
//     })
// }

// function academic_history(id) {
//     $.ajax({
//         type: 'POST',
//         url: 'averages.php',
//         data: 'id=' + id,

//         success: function(json) {
//             //console.log("acad history");
//             //console.log(json);
//             var data = JSON.parse(json);
//             var html = '';
//             for (var i = 0; i < data.length; i++) {
//                 var index = data[i].indexnum;
//                 var level = data[i].levelid + "00";
//                 var trim = data[i].trimid;
//                 var gpa = Number(data[i].present).toFixed(2);
//                 var cwa = Number(data[i].cwa).toFixed(2);

//                 html += "<tr><td>" + level + "</td><td>" + trim + "</td><td>" + cwa + "</td><td>" + gpa + "</td></tr>";
//             }

//             document.getElementById("acad_history").innerHTML = html;
//             if (!index) {
//                 document.getElementById("acad_header").style.display = 'none';
//                 document.getElementById("acad_content").style.display = 'none';
//             } else {
//                 document.getElementById("acad_header").style.display = 'block';
//                 document.getElementById("acad_content").style.display = 'block';
//             }
//         }
//     })
// }

function defer(id) {
    document.getElementById("hide_date").style.display = 'block';

    $.ajax({
        type: 'POST',
        url: 'action_data.php',
        data: 'id=' + id,

        success: function(response) {

            //console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var study_status = data[i].study_status;
                var name = data[i].name;
                var prog = data[i].progname;
                var startd = data[i].startDate;
                var endd = data[i].endDate;
                var index = data[i].indexno;
                var date = data[i].date;
            }
            if (study_status == '') {
                study_status = "Unknown";
            }
            if (study_status != 'Deferred' && study_status != 'On-Going' && study_status != "GRADUATED" && study_status != "Unknown") {
                new PNotify({
                    title: "Deferral Failed",
                    text: "Student is Currently " + study_status + ". \n Please Re-Enroll to Continue With Current Action",
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else if (study_status == "GRADUATED") {
                new PNotify({
                    title: "Deferral Failed",
                    text: "Student is Currently " + study_status,
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else {
                if (study_status == "Deferred") {

                    $("#con_Action_Modal").modal('show');
                    $("#con_sid").html(index + " - " + name);
                    $("#con_prog").html(prog);
                    $("#startDate").html(startd);
                    $("#endDate").html(endd);
                    $(".con_status").html(study_status);

                    $("#confirmBtn").unbind('click').on('click', function() {
                        var reason = $("#reason").val();
                        $.ajax({
                            type: 'POST',
                            url: 'resumption.php',
                            data: 'id=' + id + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Re-Enrolled",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#con_Action_Modal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Re-Enrollment Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });

                } else {
                    $("#actionModal").modal('show');
                    $("#act_sid").html(index + " - " + name);
                    $("#act_prog").html(prog);
                    $("#status").html(study_status);
                    $("#action_title").html("Deferral");

                    $("#processBtn").unbind('click').on('click', function() {
                        var reason = $("#action_reason").val();
                        var start = $("#start").val();
                        var end = $("#end").val();
                        if (start == '' && end == '') {
                            new PNotify({
                                title: "Error",
                                text: "Duration Not Stated",
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: 'process_deferral.php',
                                data: 'id=' + id + '&reason=' + reason + '&index=' + index + '&start=' + start + '&end=' + end,

                                success: function(json) {
                                    if (json == "1") {
                                        new PNotify({
                                            title: "Success",
                                            text: "Student Deferred",
                                            type: 'success',
                                            styling: 'bootstrap3'
                                        })
                                        $("#actionModal").modal('hide');
                                    } else {
                                        new PNotify({
                                            title: "Error",
                                            text: "Deferral Error" + json,
                                            type: 'error',
                                            styling: 'bootstrap3'
                                        })
                                    }
                                }
                            });
                        }

                    });
                }
            }
        }
    })
}

function suspend(id) {
    document.getElementById("hide_date").style.display = 'block';
    $.ajax({
        type: 'POST',
        url: 'action_data.php',
        data: 'id=' + id,

        success: function(response) {

            //console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var study_status = data[i].study_status;
                var name = data[i].name;
                var prog = data[i].progname;
                var startd = data[i].startDate;
                var endd = data[i].endDate;
                var index = data[i].indexno;
                var date = data[i].date;
            }
            if (study_status == '') {
                study_status = "Unknown";
            }
            if (study_status != 'Suspended' && study_status != 'On-Going' && study_status != "GRADUATED" && study_status != "Unknown") {
                new PNotify({
                    title: "Suspension Failed",
                    text: "Student is Currently " + study_status + ". \n Please Re-Enroll to Continue With Current Action",
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else if (study_status == "GRADUATED") {
                new PNotify({
                    title: "Suspension Failed",
                    text: "Student is Currently " + study_status,
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else {
                if (study_status == "Suspended") {

                    $("#con_Action_Modal").modal('show');
                    $("#con_sid").html(index + " - " + name);
                    $("#con_prog").html(prog);
                    $("#startDate").html(startd);
                    $("#endDate").html(endd);
                    $(".con_status").html(study_status);

                    $("#confirmBtn").unbind('click').on('click', function() {
                        $.ajax({
                            type: 'POST',
                            url: 'resumption.php',
                            data: 'id=' + id + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Re-Enrolled",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#con_Action_Modal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Re-Enrollment Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });

                } else {
                    $("#actionModal").modal('show');
                    $("#act_sid").html(index + " - " + name);
                    $("#act_prog").html(prog);
                    $("#status").html(study_status);
                    $("#action_title").html("Suspension");

                    $("#processBtn").unbind('click').on('click', function() {
                        var reason = $("#reason").val();
                        var start = $("#start").val();
                        var end = $("#end").val();

                        if (start == '' && end == '') {
                            new PNotify({
                                title: "Error",
                                text: "Duration Not Stated",
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: 'process_suspension.php',
                                data: 'id=' + id + '&reason=' + reason + '&index=' + index + '&start=' + start + '&end=' + end,

                                success: function(json) {
                                    if (json == "1") {
                                        new PNotify({
                                            title: "Success",
                                            text: "Student Suspended",
                                            type: 'success',
                                            styling: 'bootstrap3'
                                        })
                                        $("#actionModal").modal('hide');
                                    } else {
                                        new PNotify({
                                            title: "Error",
                                            text: "Deferral Error \n" + json,
                                            type: 'error',
                                            styling: 'bootstrap3'
                                        })
                                    }
                                }
                            });
                        }

                    });
                }
            }
        }
    })
}

function withdraw(id) {
    // $("#hide_date").style.display = 'none';
    document.getElementById("hide_date").style.display = 'none';
    $.ajax({
        type: 'POST',
        url: 'action_data.php',
        data: 'id=' + id,

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var study_status = data[i].study_status;
                var name = data[i].name;
                var prog = data[i].progname;
                var index = data[i].indexno;
                var date = data[i].date;
            }
            if (study_status == 'GRADUATED') {
                new PNotify({
                    title: "Suspension Failed",
                    text: "Student is Currently " + study_status,
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else {

                if (study_status == "Withdrawn") {

                    $("#con_Action_Modal").modal('show');


                    $("#con_sid").html(index + " - " + name);
                    $("#con_prog").html(prog);
                    $(".con_status").html(study_status);

                    $("#confirmBtn").unbind('click').on('click', function() {
                        $.ajax({
                            type: 'POST',
                            url: 'resumption.php',
                            data: 'id=' + id + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Re-Enrolled",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#con_Action_Modal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Re-Enrollment Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });

                } else {
                    $("#actionModal").modal('show');
                    $("#act_sid").html(index + " - " + name);
                    $("#act_prog").html(prog);
                    $("#status").html(study_status);
                    $("#action_title").html("Withdrawal");

                    $("#processBtn").unbind('click').on('click', function() {
                        var reason = $("#reason").val();
                        $.ajax({
                            type: 'POST',
                            url: 'process_withdrawal.php',
                            data: 'id=' + id + '&reason=' + reason + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Withdrawn",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#actionModal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Withdrawal Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });
                }
            }
        }
    })
}

function refresh(id) {
    $.ajax({
        type: 'POST',
        url: 'refresh_id',
        data: 'id=' + id,

        success: function(response) {
            if (response == '1') {
                new PNotify({
                    title: 'Success',
                    text: 'Record Updated',
                    type: 'success',
                    styling: 'bootstrap3'
                })
            } else if (response == '2') {
                new PNotify({
                    title: 'Update Failed',
                    text: 'Record Not Updated',
                    type: 'info',
                    styling: 'bootstrap3'
                })
            } else {
                new PNotify({
                    title: 'Error',
                    text: response,
                    type: 'error',
                    styling: 'bootstrap3'
                })
            }
        }
    })
}

function employment(indexno) { 
    $.ajax({ 
        type: 'POST', 
        url: 'employment.php',
        data: 'id='+indexno,

        success: function(json){
            console.log(json);
            var data = JSON.parse(json);
            if(data == '') {
                document.getElementById("empl_header").style.display = 'none';
                document.getElementById("empl_content").style.display = 'none';
            } else {
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    var descr = data[i].descr;
                    var address = data[i].address;
                    var position = data[i].position;
                    var start_date = data[i].start_date;
                    var end_date = data[i].end_date;

                    html +="<tr><td>" + descr + "</td><td>" + address + "</td><td>" + position + "</td><td>" + start_date + "</td><td>" + end_date + "</td></tr>";
                }
                $("#empl_body").html(html);
            }
        } 
    })
}

function institutions(indexno) {
    $.ajax({
        type: 'POST',
        url: 'institution.php',
        data: 'id='+indexno,

        success: function(json){
            var data = JSON.parse(json);
            if(data == '') {
                document.getElementById("inst_header").style.display = 'none';
                document.getElementById("inst_content").style.display = 'none';
            } else {
                var html = '';
            for (var i = 0; i < data.length; i++) {
                var descr = data[i].descr;
                var region = data[i].region;
                var date_start = data[i].date_start;
                var date_end = data[i].date_end;
                var position = data[i].position;

                html += "<tr><td>"+descr+"</td><td>"+region+"</td><td>"+date_start+"</td><td>"+date_end+"</td><td>"+position+"</td></tr>";
            }
            $("#inst_body").html(html);

            }

        } 
    })
}

function enrolSearch() {
    $("#enrollSearch").modal('show');

    $("#enrollsearchBtn").unbind('click').on('click', function() {
        $("#enrollsearchBtn").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
        document.getElementById("enrollsearchBtn").disabled = true;
        $("#enrollTable").dataTable().fnDestroy();
        var form = document.querySelector("#enrollForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'enrollSearch.php',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function(response) {
                console.log(response);
                var data = JSON.parse(response);
                var html = '';

                for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                    var uin = data[i].uin;
                    var indexno = data[i].indexno;
                    var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                    var progname = data[i].progname;
                    var faculty = data[i].facultyname;
                    var campus = data[i].campus_descr;
                    var entryyear = data[i].entryyear;

                    if (data[i].firstname == '' || data[i].surname == '') {
                        var button = "<button class='btn btn-success btn-sm' onclick='refresh(\"" + uin + "\")'>Refresh</button>";
                    } else {
                        var button = "";
                    }

                    html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + indexno + "</td><td onclick='view_details(\"" + uin + "\")' class='detail_row' data-toggle='tooltip' title='Click to View More'>" + name + "</td><td>" + progname + "</td><td>" + faculty + "</td><td>" + campus + "</td><td>" + entryyear + "</td><td>" + button + "</td></tr>";
                }
                document.getElementById("enrollBody").innerHTML = html;
                // $("#enrollSearch").modal('hide');
                $("#enrollTable").DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdf',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7]
                            }
                        }
                    ]
                });
                $("#enrollsearchBtn").html("Search");
                document.getElementById("enrollsearchBtn").disabled = false;

                $("#enrollSearch").modal('hide');
                $("#enrollForm").trigger('reset');
            }
        })
    })
}


$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});