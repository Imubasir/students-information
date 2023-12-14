/*$, document, window, alert, window */

function view_details(uin) {
    $("#detailsModal").modal('show');
    $.ajax({
        type: 'POST',
        url: 'fetch_details.php',
        data: 'id=' + uin,

        success: function(json) {
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
                var cert_no = data[i].certno;
                var admn_cat = data[i].admission_category;
                var graddate = data[i].graddate;
                var gradclass = data[i].gradclass;
                var issued_award = data[i].issued_date;
                var campus = data[i].campus_descr;
                var fee_cat = data[i].fee_category;
                var pic = data[i].pic_id;


                if (study_status == '') {
                    study_status = "Unknown";
                }
                var surname = data[i].surname;
                var uin = data[i].uin;
                var username = data[i].username;

                var name = firstname + ' ' + middlename + ' ' + surname;
                // if (pic) {
                //     document.getElementById("profile_pic").src = '../pics/' + pic;
                // }
                document.getElementById("profile_pic").src = 'http://res.uds.edu.gh/' + pic;
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
                document.getElementById("entry_lvl").innerHTML = entrylevel + "00";
                document.getElementById("cur_lvl").innerHTML = currentlevel + "00";
                document.getElementById("pob").innerHTML = pob;
                document.getElementById("htown").innerHTML = htown;
                document.getElementById("dis_status").innerHTML = disability_status;
                document.getElementById("gurd_name").innerHTML = guardian_name;
                document.getElementById("rob").innerHTML = rob;
                document.getElementById("hme_addrs").innerHTML = homeaddress;
                document.getElementById("dis_descr").innerHTML = disability_descr;
                document.getElementById("contact").innerHTML = fonnumber;
                document.getElementById("admn_cat").innerHTML = admn_cat;
                document.getElementById("campus").innerHTML = campus;
                document.getElementById("fee_cat").innerHTML = fee_cat;

                if (study_status == "GRADUATED") {
                    document.getElementById("grad_info").style.display = 'table-row';
                    document.getElementById("grad_info2").style.display = 'table-row';

                    document.getElementById("graddate").innerHTML = graddate;
                    document.getElementById("cert_no").innerHTML = cert_no;

                    document.getElementById("gradclass").innerHTML = gradclass;
                    document.getElementById("issued_award").innerHTML = issued_award;


                } else {
                    document.getElementById("grad_info").style.display = 'none';
                    document.getElementById("grad_info2").style.display = 'none';
                }

            }
            details(uin);
            academic_history(indexno);
            institutions(uin);
            employment(uin);
        }
    })
}

function details(id) {
    $.ajax({
        type: 'POST',
        url: 'details.php',
        data: 'id=' + id,

        success: function(response) {
            // console.log("Waec Results");
            //console.log(response);
            var data = JSON.parse(response);
            var html = '';

            // var name = data.firstname + ' ' + data.middlename + ' ' + data.surname;
            var sgd1 = data.sgd1;
            var sgd10 = data.sgd10;
            var sgd2 = data.sgd2;
            var sgd3 = data.sgd3;
            var sgd4 = data.sgd4;
            var sgd7 = data.sgd7;
            var sgd8 = data.sgd8;
            var sgd9 = data.sgd9;

            var ssub1 = data.ssub1;
            var ssub10 = data.ssub10;
            var ssub2 = data.ssub2;
            var ssub3 = data.ssub3;
            var ssub4 = data.ssub4;
            var ssub7 = data.ssub7;
            var ssub8 = data.ssub8;
            var ssub9 = data.ssub9;

            // var student_no = data.student_no;
            var uin = data.uin;
            var wgd1 = data.wgd1;
            var wgd10 = data.wgd10;
            var wgd2 = data.wgd2;
            var wgd3 = data.wgd3;
            var wgd4 = data.wgd4;
            var wgd7 = data.wgd7;
            var wgd8 = data.wgd8;
            var wgd9 = data.wgd9;

            var windexno = data.index;
            var wname = data.wname;
            var name = data.name;


            var wsub1 = data.wsub1;
            var wsub10 = data.wsub10;
            var wsub2 = data.wsub2;
            var wsub3 = data.wsub3;
            var wsub4 = data.wsub4;
            var wsub7 = data.wsub7;
            var wsub8 = data.wsub8;
            var wsub9 = data.wsub9;


            html += "<tr><td rowspan='8'>" + windexno + "</td><td rowspan='8'>" + name + "</td><td>" + ssub1 + "</td><td>" + sgd1 + "</td><td>" + wgd1 + "</td><td>" + wsub1 + "</td><td rowspan='8'>" + wname + "</td></tr>";

            html += "<tr><td>" + ssub2 + "</td><td>" + sgd2 + "</td><td>" + wgd2 + "</td><td>" + wsub2 + "</td></tr>";
            html += "<tr><td>" + ssub3 + "</td><td>" + sgd3 + "</td><td>" + wgd3 + "</td><td>" + wsub3 + "</td></tr>";
            html += "<tr><td>" + ssub4 + "</td><td>" + sgd4 + "</td><td>" + wgd4 + "</td><td>" + wsub4 + "</td></tr>";
            html += "<tr><td>" + ssub7 + "</td><td>" + sgd7 + "</td><td>" + wgd7 + "</td><td>" + wsub7 + "</td></tr>";
            html += "<tr><td>" + ssub8 + "</td><td>" + sgd8 + "</td><td>" + wgd8 + "</td><td>" + wsub8 + "</td></tr>";
            html += "<tr><td>" + ssub9 + "</td><td>" + sgd9 + "</td><td>" + wgd9 + "</td><td>" + wsub9 + "</td></tr>";
            html += "<tr><td>" + ssub10 + "</td><td>" + sgd10 + "</td><td>" + wgd10 + "</td><td>" + wsub10 + "</td></tr>";

            document.getElementById("veri_Body").innerHTML = html;
            if (!windexno) {
                document.getElementById("shs_content_header").style.display = 'none';
                document.getElementById("shs_content_2").style.display = 'none';
            } else {
                document.getElementById("shs_content_header").style.display = 'block';
                document.getElementById("shs_content_2").style.display = 'block';
            }
        }
    })
}

function academic_history(id) {
    $.ajax({
        type: 'POST',
        url: 'averages.php',
        data: 'id=' + id,

        success: function(json) {
            var data = JSON.parse(json);
            var html = '';
            for (var i = 0; i < data.length; i++) {
                var index = data[i].indexnum;
                var level = data[i].levelid + "00";
                var trim = data[i].trimid;
                var gpa = Number(data[i].present).toFixed(2);
                var cwa = Number(data[i].cwa).toFixed(2);

                html += "<tr><td>" + level + "</td><td>" + trim + "</td><td>" + cwa + "</td><td>" + gpa + "</td></tr>";
            }

            document.getElementById("acad_history").innerHTML = html;
            if (!index) {
                document.getElementById("acad_header").style.display = 'none';
                document.getElementById("acad_content").style.display = 'none';
            } else {
                document.getElementById("acad_header").style.display = 'block';
                document.getElementById("acad_content").style.display = 'block';
            }
        }
    })
}

function refresh(id) {
    var ids = id.split(",");
    for (var i = 0; i < ids.length; i++) {
        var id1 = ids[0];
        var id2 = ids[1];
    }
    $.ajax({
        type: 'POST',
        url: 'refresh_id.php',
        data: 'id=' + id1 + '&id2=' + id2,

        success: function(response) {
            if (response == '1') {
                new PNotify({
                    title: 'Success',
                    text: 'Biodata Refreshed Successfully',
                    type: 'success',
                    styling: 'bootstrap3'
                })
            } else {
                console.log(response);
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
                //console.log(response);
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
                    var button = "<button class='btn btn-success btn-sm' onclick='refresh(\"" + uin + "," + indexno + "\")'>Refresh</button>";
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
                    }, {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    }]
                });
                $("#enrollsearchBtn").html("Search");
                document.getElementById("enrollsearchBtn").disabled = false;

                $("#enrollSearch").modal('hide');
                $("#enrollForm").trigger('reset');
            }
        })
    })
}

function employment(indexno) {
    $.ajax({
        type: 'POST',
        url: 'employment.php',
        data: 'id=' + indexno,

        success: function(json) {
            console.log(json);
            var data = JSON.parse(json);
            if (data == '') {
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

                    html += "<tr><td>" + descr + "</td><td>" + address + "</td><td>" + position + "</td><td>" + start_date + "</td><td>" + end_date + "</td></tr>";
                }
                $("#empl_body").html(html);
            }
        }
    })
}

function print_page() {
    printJS({
        printable: 'printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "view.css"]
    })
}

function institutions(indexno) {
    $.ajax({
        type: 'POST',
        url: 'institution.php',
        data: 'id=' + indexno,

        success: function(json) {
            var data = JSON.parse(json);
            if (data == '') {
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

                    html += "<tr><td>" + descr + "</td><td>" + region + "</td><td>" + date_start + "</td><td>" + date_end + "</td><td>" + position + "</td></tr>";
                }
                $("#inst_body").html(html);
            }
        }
    })
}

function enroll_switch() {
    document.getElementById("enroll_container").style.display = 'block';
    document.getElementById("enroll_search").style.display = 'block';
    document.getElementById("enroll_title").style.display = 'block';
    document.getElementById("enroll_search").style.display = 'block';

    document.getElementById("loan_container").style.display = 'none';
    document.getElementById("loan_search").style.display = 'none';
    document.getElementById("loan_title").style.display = 'none';
}

function loan_switch() {
    document.getElementById("loan_search").style.display = 'block';
    document.getElementById("loan_title").style.display = 'block';
    document.getElementById("loan_container").style.display = 'block';
    // document.getElementById("enroll_search").style.display = 'none';

    document.getElementById("enroll_container").style.display = 'none';
    document.getElementById("enroll_search").style.display = 'none';
    document.getElementById("enroll_title").style.display = 'none';
}

function load_loan() {
    // $("#loan_tbl").dataTable().fnDestroy();
    var form = document.querySelector("#loanForm");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'load_loan.php',
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,

        success: function(json) {
            console.log(json);
            var data = JSON.parse(json);
            var html = '';
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var uin = data[i].uin;
                var indexno = data[i].indexno;
                var sname = data[i].surname;
                var mname = data[i].middlename;
                var fname = data[i].firstname;
                var progname = data[i].progname;
                var eyear = data[i].entryyear;
                var curlevel = data[i].currentlevel + "00";
                var inst = "UDS";

                html += "<tr><td>" + a + "</td><td>" + eyear + "</td><td>" + inst + "</td><td>" + uin + "</td><td>" + indexno + "</td><td>" + sname + "</td><td>" + mname + "</td><td>" + fname + "</td><td>" + progname + "</td><td>" + curlevel + "</td></tr>";
            }

            $("#loan_body").html(html);
            $("#loan_tbl").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdf',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }]
            });

            $("#loan_tbl").dataTable().fnDestroy();

            $("#loan_tbl").DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdf',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                }]
            });

            document.getElementById("loan_table").style.display = 'block';
            document.getElementById("loanSearchContainer").style.display = 'none';
        }
    })
}

function goback() {
    document.getElementById("loan_table").style.display = 'none';
    document.getElementById("loanSearchContainer").style.display = 'block';
    $("#loan_tbl").dataTable().fnDestroy();
    $("#loanForm").trigger('reset');
}

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

function update_ucm() {
    var fd = new FormData(document.querySelector("#updateucm_form"));
    var type = $("#up_type").val();
    var programme = $("#up_programme").val();
    if(programme == '') {
        programme = "All Programmes";
    }
    var level = $("#up_level").val();
    if(level == '') {
        level = "All Levels";
    }

    $.ajax({
        type: 'POST',
        url: 'update_ucm.php', 
        data: fd,
        cache: false,
        processData: false,
        contentType: false,

        beforeSend: function() {
            $("#waiting_notice").modal("show");

            $("#upd_type").html(type);
            $("#upd_group").html(programme);
            $("#upd_level").html(level);

            $("#updateucm").modal("hide");
        },
        success: function(response) {

        }
    })
}