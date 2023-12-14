function details(id) {
    $("#verify_modal").modal('show');
    var identifiers = id.split(",");
    for (var i = 0; i < identifiers.length; i++) {
        var id = identifiers[0];
        var trans = identifiers[1];
    }
    $.ajax({
        type: 'POST',
        url: 'details.php',
        data: 'id=' + id,

        success: function (response) {
            // console.log(response);
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0; i < data.length; i++) {
                var student_name = data[i].sname;
                var student_no = data[i].stdno;
                var uin = data[i].uin;

                var ssub1 = data[i].ssub1;
                var ssub10 = data[i].ssub10;
                var ssub2 = data[i].ssub2;
                var ssub3 = data[i].ssub3;
                var ssub4 = data[i].ssub4;
                var ssub7 = data[i].ssub7;
                var ssub8 = data[i].ssub8;
                var ssub9 = data[i].ssub9;

                var sgd1 = data[i].sgd1;
                var sgd10 = data[i].sgd10;
                var sgd2 = data[i].sgd2;
                var sgd3 = data[i].sgd3;
                var sgd4 = data[i].sgd4;
                var sgd7 = data[i].sgd7;
                var sgd8 = data[i].sgd8;
                var sgd9 = data[i].sgd9;

                var wsub1 = data[i].wsub1;
                var wsub10 = data[i].wsub10;
                var wsub2 = data[i].wsub2;
                var wsub3 = data[i].wsub3;
                var wsub4 = data[i].wsub4;
                var wsub7 = data[i].wsub7;
                var wsub8 = data[i].wsub8;
                var wsub9 = data[i].wsub9;

                var wgd1 = data[i].wgd1;
                var wgd10 = data[i].wgd10;
                var wgd2 = data[i].wgd2;
                var wgd3 = data[i].wgd3;
                var wgd4 = data[i].wgd4;
                var wgd7 = data[i].wgd7;
                var wgd8 = data[i].wgd8;
                var wgd9 = data[i].wgd9;

                var windexno = data[i].sindex;
                var wname = data[i].wname;
                var remark = data[i].remark;

                html += "<tr><td rowspan='8'>" + uin + "</td><td rowspan='8'>" + student_no + "</td><td rowspan='8'>" + windexno + "</td><td rowspan='8'>" + student_name + "</td><td>" + ssub1 + "</td><td>" + sgd1 + "</td><td>" + wgd1 + "</td><td>" + wsub1 + "</td><td rowspan='8'>" + wname + "</td><td>" + remark + "</td></tr>";

                html += "<tr><td>" + ssub2 + "</td><td>" + sgd2 + "</td><td>" + wgd2 + "</td><td>" + wsub2 + "</td></tr>";
                html += "<tr><td>" + ssub3 + "</td><td>" + sgd3 + "</td><td>" + wgd3 + "</td><td>" + wsub3 + "</td></tr>";
                html += "<tr><td>" + ssub4 + "</td><td>" + sgd4 + "</td><td>" + wgd4 + "</td><td>" + wsub4 + "</td></tr>";
                html += "<tr><td>" + ssub7 + "</td><td>" + sgd7 + "</td><td>" + wgd7 + "</td><td>" + wsub7 + "</td></tr>";
                html += "<tr><td>" + ssub8 + "</td><td>" + sgd8 + "</td><td>" + wgd8 + "</td><td>" + wsub8 + "</td></tr>";
                html += "<tr><td>" + ssub9 + "</td><td>" + sgd9 + "</td><td>" + wgd9 + "</td><td>" + wsub9 + "</td></tr>";
                html += "<tr><td>" + ssub10 + "</td><td>" + sgd10 + "</td><td>" + wgd10 + "</td><td>" + wsub10 + "</td></tr>";
            }
            document.getElementById("verify_body").innerHTML = html;
        }
    })
}

function print_single_verify() {
    printJS({
        printable: 'printable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css"]
    })
}

function gradSearch() {
    $("#gradSearch").modal('show');

    $("#gradsearchBtn").unbind('click').on('click', function () {
        $("#gradsearchBtn").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
        $("#gradTable").dataTable().fnDestroy();
        var form = document.querySelector("#gradForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'gradsearch.php',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function (response) {
                //console.log(response);
                var data = JSON.parse(response);
                var html = '';

                for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                    var uin = data[i].uin;
                    var indexno = data[i].indexno;
                    var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                    var progname = data[i].progname;
                    var certno = data[i].certno;
                    var gradclass = data[i].gradclass;
                    var graddate = data[i].graddate;
                    var option = data[i].option_title;
                    var status = data[i].qualification_status;
                    var balance = getBalance(indexno + "," + uin);

                    if (balance < 0) {
                        var disp_balance = formatNumber(balance) + " (Owing)";
                    } else if (balance > 0) {
                        var disp_balance = "(Cleared)";
                    } else {
                        var disp_balance = "";
                    }
                    html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + indexno + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + progname + "</td><td>" + option + "</td><td>" + gradclass + "</td><td>" + graddate + "</td><td>" + disp_balance + "</td><td>" + status + "</td></tr>";
                }
                document.getElementById("gradTableBody").innerHTML = html;
                $("#gradTable").DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'pdf',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }, {
                        extend: 'excel',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        }
                    }]
                });
                $("#gradForm").trigger('reset');
                $("#gradsearchBtn").html("Search");
                $("#gradSearch").modal('hide');
            }
        })
    })
}

function veriSearch() {
    $("#veriSearch").modal('show');

    $("#verisearchBtn").unbind('click').on('click', function () {
        $("#verisearchBtn").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
        $("#veriTable").dataTable().fnDestroy();
        var form = document.querySelector("#veriForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'verisearch.php',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function (response) {
                //console.log(response);
                var data = JSON.parse(response);
                var html = '';

                for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                    var uin = data[i].uin;
                    var stdno = data[i].indexno;
                    //var cand_name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                    var candname = data[i].cand_name;
                    //var indexno = data[i].indexno;
                    //var month = data[i].exam_month;
                    //var year = data[i].exam_year;
                    var prog = data[i].progname;
                    var qualification_status = data[i].qualification_status;
                    var entry_year = data[i].entryyear;
                    var current_level = data[i].currentlevel + '00';
                    var studystatus = data[i].study_status;

                    html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + stdno + "</td><td>" + candname + "</td><td>" + entry_year + "</td><td>" + current_level + "</td><td>" + studystatus + "</td><td>" + prog + "</td><td>" + qualification_status + "</td><td><div class='hidden'><button onclick='details(\"" + uin + "," + stdno + "\")' class='btn btn-sm btn-success'>Details</button></div></td></tr>";
                }
                document.getElementById("veriTableBody").innerHTML = html;
                $("#veriTable").DataTable({
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
                $("#veriForm").trigger('reset');
                $("#verisearchBtn").html("Search");
                $("#veriSearch").modal('hide');
            }
        });
    })
}

function search_format() {
    var catSelector = document.getElementById("category");
    catSelector.addEventListener("change", function () {
        var catValue = document.getElementById("category").value;

        if (catValue == "gradlist") {
            document.getElementById("graddate").style.display = 'block';
            document.getElementById("graddate").disabled = false;

            document.getElementById("class").style.display = 'block';
            document.getElementById("class").disabled = false;

            document.getElementById("year").style.display = 'none';
            document.getElementById("year").disabled = true;

            document.getElementById("status").style.display = 'none';
            document.getElementById("status").disabled = true;
        } else if (catValue == "verif_det") {
            document.getElementById("year").style.display = 'block';
            document.getElementById("year").disabled = false;

            document.getElementById("status").style.display = 'block';
            document.getElementById("status").disabled = false;

            document.getElementById("graddate").style.display = 'none';
            document.getElementById("graddate").disabled = true;

            document.getElementById("class").style.display = 'none';
            document.getElementById("class").disbaled = true;
        } else if (catValue == "waec") {

        }
    })
}

function exportSearch() {
    $("#export_btn").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
    var form = document.querySelector("#exportForm");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'exportsearch.php',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,

        success: function (response) {
            var category = $("#category").val();

            if (category == 'gradlist') {
                //console.log(response);
                var data = JSON.parse(response);
                //console.log(data);
                var html = '';

                $("#export_gradTable").dataTable().fnDestroy();
                for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                    var uin = data[i].uin;
                    var indexno = data[i].indexno;
                    var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                    var prog = data[i].progname;
                    var gradclass = data[i].gradclass;
                    var graddate = data[i].graddate;
                    var remark = data[i].qualification_status;

                    html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + indexno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + gradclass + "</td><td>" + graddate + "</td><td>" + remark + "</td></tr>";
                }

                $("#export_btn").html("Search");
                document.getElementById("export_gradBody").innerHTML = html;

                $("#export_gradTable").DataTable({
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
                $("#export_btn").html("Search");
                $("#exportForm").trigger('reset');
                document.getElementById("exportTable").style.display = 'block';
                document.getElementById("exportTableVerify").style.display = 'none';
                document.getElementById("uploadBody").style.display = 'none';
                document.getElementById("exportBody").style.display = 'none';
                document.getElementById("veriBody").style.display = 'none';
                document.getElementById("gradBody").style.display = 'none';

            } else if (category == 'verif_det') {
                //console.log(response);
                var data = JSON.parse(response);
                var html = '';

                for (var i = 0; i < data.length; i++) {
                    //var student_name = data[i].firstname + ' ' + data[i].middlename + ' ' + data[i].surname;
                    var student_name = data[i].sname;
                    var student_no = data[i].stdno;
                    var uin = data[i].uin;

                    var ssub1 = data[i].ssub1;
                    var ssub10 = data[i].ssub10;
                    var ssub2 = data[i].ssub2;
                    var ssub3 = data[i].ssub3;
                    var ssub4 = data[i].ssub4;
                    var ssub7 = data[i].ssub7;
                    var ssub8 = data[i].ssub8;
                    var ssub9 = data[i].ssub9;

                    var sgd1 = data[i].sgd1;
                    var sgd10 = data[i].sgd10;
                    var sgd2 = data[i].sgd2;
                    var sgd3 = data[i].sgd3;
                    var sgd4 = data[i].sgd4;
                    var sgd7 = data[i].sgd7;
                    var sgd8 = data[i].sgd8;
                    var sgd9 = data[i].sgd9;

                    var wsub1 = data[i].wsub1;
                    var wsub10 = data[i].wsub10;
                    var wsub2 = data[i].wsub2;
                    var wsub3 = data[i].wsub3;
                    var wsub4 = data[i].wsub4;
                    var wsub7 = data[i].wsub7;
                    var wsub8 = data[i].wsub8;
                    var wsub9 = data[i].wsub9;

                    var wgd1 = data[i].wgd1;
                    var wgd10 = data[i].wgd10;
                    var wgd2 = data[i].wgd2;
                    var wgd3 = data[i].wgd3;
                    var wgd4 = data[i].wgd4;
                    var wgd7 = data[i].wgd7;
                    var wgd8 = data[i].wgd8;
                    var wgd9 = data[i].wgd9;

                    //var windexno = data[i].index;
                    var windexno = data[i].sindex;
                    var wname = data[i].wname;
                    var remark = data[i].remark;

                    //console.log(student_name + '-' + student_no);

                    html += "<tr><td rowspan='8'>" + uin + "</td><td rowspan='8'>" + student_no + "</td><td rowspan='8'>" + windexno + "</td><td rowspan='8'>" + student_name + "</td><td>" + ssub1 + "</td><td>" + sgd1 + "</td><td>" + wgd1 + "</td><td>" + wsub1 + "</td><td rowspan='8'>" + wname + "</td><td>" + remark + "</td></tr>";

                    html += "<tr><td>" + ssub2 + "</td><td>" + sgd2 + "</td><td>" + wgd2 + "</td><td>" + wsub2 + "</td></tr>";
                    html += "<tr><td>" + ssub3 + "</td><td>" + sgd3 + "</td><td>" + wgd3 + "</td><td>" + wsub3 + "</td></tr>";
                    html += "<tr><td>" + ssub4 + "</td><td>" + sgd4 + "</td><td>" + wgd4 + "</td><td>" + wsub4 + "</td></tr>";
                    html += "<tr><td>" + ssub7 + "</td><td>" + sgd7 + "</td><td>" + wgd7 + "</td><td>" + wsub7 + "</td></tr>";
                    html += "<tr><td>" + ssub8 + "</td><td>" + sgd8 + "</td><td>" + wgd8 + "</td><td>" + wsub8 + "</td></tr>";
                    html += "<tr><td>" + ssub9 + "</td><td>" + sgd9 + "</td><td>" + wgd9 + "</td><td>" + wsub9 + "</td></tr>";
                    html += "<tr><td>" + ssub10 + "</td><td>" + sgd10 + "</td><td>" + wgd10 + "</td><td>" + wsub10 + "</td></tr>";
                }
                document.getElementById("export_veriBody").innerHTML = html;
                $("#export_btn").html("Search");
                $("#exportForm").trigger('reset');
                document.getElementById("exportTableVerify").style.display = 'block';
                document.getElementById("exportTable").style.display = 'none';
                document.getElementById("uploadBody").style.display = 'none';
                document.getElementById("exportBody").style.display = 'none';
                document.getElementById("veriBody").style.display = 'none';
                document.getElementById("gradBody").style.display = 'none';
            } else if (category == 'waec') {

            } else {
                $("#export_btn").html("Search");
                $("#exportForm").trigger('reset');
                new PNotify({
                    title: "Information",
                    text: response,
                    type: "info",
                    styling: "bootstrap3"
                });
            }

        }
    })
}

function upload_results() {
    var loading = new PNotify({
        text: 'Please Wait',
        icon: 'fas fa-spinner fa-pulse',
        type: 'success',
        styling: 'bootstrap3',
        hide: false,
        shadow: false,
        modules: {
            Buttons: {
                closer: false,
                sticker: false
            },
            Animate: {
                animate: true,
                inClass: 'bounceInLeft',
                outClass: 'bounceOutRight'
            }
        }
    });

    var form = document.querySelector("#result_upload_form");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        // url: '../js/plugins/uploader-master/uploader-master/demo/backend/upload.php',
        url: 'upload.php',
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            $("#result_upload_form").trigger('reset');
            PNotify.removeAll();
            new PNotify({
                title: "Information",
                text: response,
                type: "info",
                styling: "bootstrap3"
            });
        }
    })
}

function print_verify() {
    printJS({
        printable: 'export_verifyTable',
        type: 'html',
        targetStyles: ['*'],
        documentTitle: '',
        css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css"]
    })
}

function load_verification() {
    $("#veriTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_verification.php',

        success: function (json) {
            //console.log("Verify");
            //console.log(json);
            var data = JSON.parse(json);
            var html = '';
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var uin = data[i].uin;
                var indexno = data[i].indexno;
                var cand_name = data[i].cand_name;
                var entryyear = data[i].entryyear;
                var currentlevel = data[i].currentlevel + '00';
                var study_status = data[i].study_status;
                var progname = data[i].progname;
                var qualification_status = data[i].qualification_status;

                html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + indexno + "</td><td>" + cand_name + "</td><td>" + entryyear + "</td><td>" + currentlevel + "</td><td>" + study_status + "</td><td>" + progname + "</td><td>" + qualification_status + "</td><td><div class='hidden'><button onclick='details(\"" + uin + "," + indexno + "\")' class='btn btn-sm btn-success'>Details</button></div></td></tr>";
                //html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + stdno + "</td><td>" + candname + "</td><td>" + entry_year + "</td><td>" + current_level + "</td><td>" + studystatus + "</td><td>" + prog + "</td><td>" + qualification_status + "</td><td><div class='hidden'><button onclick='details(\"" + uin + "," + stdno + "\")' class='btn btn-sm btn-success'>Details</button></div></td></tr>";

            }
            $("#veriTableBody").html(html);
            $("#veriTable").DataTable({
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
        }
    })
}

function add_other_veri() {
    var form = document.querySelector("#otherveriForm");
    var formdata = new FormData(form);

    var index = $("#indexno").val();
    var uin = $("#uin").val();
    var certname = $("#certName").val();
    var classobtained = $("#classObtained").val();

    if (index == '' || uin == '' || certname == '' || classobtained == '') {
        new PNotify({
            title: 'Information',
            text: "Incomplete Fields",
            type: 'info',
            styling: 'bootstrap3'
        })
    } else {
        $.ajax({
            type: 'POST',
            url: 'addOtherVeri.php',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response == '1') {
                    new PNotify({
                        title: 'Success',
                        text: 'Result Uploaded Successfully',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    $("#otherveriForm").trigger('reset');
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
}

function search() {

    $("#editModal").modal('show');
    $("#edit").modal('hide');
    var form = document.querySelector("#editForm");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'searchOtherVeri.php',
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,

        success: function (json) {
            console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var indexnum = data[i].indexnum;
                var uin = data[i].uin;
                var exam_date = data[i].exam_date;
                var institution = data[i].institution;
                var cert_name = data[i].cert_name;
                var prog = data[i].prog;
                var class_ = data[i].class;

                document.getElementById("e_indexno").value = indexnum;
                document.getElementById("e_uin").value = uin;
                document.getElementById("e_examDate").value = exam_date;
                document.getElementById("e_instName").value = institution;
                document.getElementById("e_certName").value = cert_name;
                document.getElementById("e_certAward").value = prog;
                document.getElementById("e_classObtained").value = class_;

                $("#editForm").trigger('reset');
            }
        }
    })
}

function edit_other_veri() {
    var form = document.querySelector("#e_otherveriForm");
    var formdata = new FormData(form);

    var e_index = $("#e_indexno").val();
    var e_uin = $("#e_uin").val();
    var e_certname = $("#e_certName").val();
    var e_classobtained = $("#e_classObtained").val();

    if (e_index == '' || e_uin == '' || e_certname == '' || e_classobtained == '') {
        new PNotify({
            title: 'Information',
            text: "Incomplete Fields",
            type: 'info',
            styling: 'bootstrap3'
        })
    } else {
        $.ajax({
            type: 'POST',
            url: 'editOtherVeri.php',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response == '1') {
                    new PNotify({
                        title: 'Success',
                        text: 'Result Uploaded Successfully',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    $("#otherveriForm").trigger('reset');
                    $("#editModal").modal('hide');
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
}

$(document).ready(function () {
    load_verification();
    search_format();
})
