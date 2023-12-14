$(document).ready(function() {
    search_format();
})

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
        data: 'id=' + id + '&transid=' + trans,

        success: function(response) {
            // console.log(response);
            var data = JSON.parse(response);
            //            console.log(data);
            var html = '';

            var name = data.firstname + ' ' + data.middlename + ' ' + data.surname;
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

            var student_no = data.student_no;
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
            var uin = data.uin;
            var name = data.name;
            var student_no = data.stdno;


            var wsub1 = data.wsub1;
            var wsub10 = data.wsub10;
            var wsub2 = data.wsub2;
            var wsub3 = data.wsub3;
            var wsub4 = data.wsub4;
            var wsub7 = data.wsub7;
            var wsub8 = data.wsub8;
            var wsub9 = data.wsub9;


            html += "<tr><td rowspan='8'>" + uin + "</td><td rowspan='8'>" + student_no + "</td><td rowspan='8'>" + windexno + "</td><td rowspan='8'>" + name + "</td><td>" + ssub1 + "</td><td>" + sgd1 + "</td><td>" + wgd1 + "</td><td>" + wsub1 + "</td><td rowspan='8'>" + wname + "</td></tr>";

            html += "<tr><td>" + ssub2 + "</td><td>" + sgd2 + "</td><td>" + wgd2 + "</td><td>" + wsub2 + "</td></tr>";
            html += "<tr><td>" + ssub3 + "</td><td>" + sgd3 + "</td><td>" + wgd3 + "</td><td>" + wsub3 + "</td></tr>";
            html += "<tr><td>" + ssub4 + "</td><td>" + sgd4 + "</td><td>" + wgd4 + "</td><td>" + wsub4 + "</td></tr>";
            html += "<tr><td>" + ssub7 + "</td><td>" + sgd7 + "</td><td>" + wgd7 + "</td><td>" + wsub7 + "</td></tr>";
            html += "<tr><td>" + ssub8 + "</td><td>" + sgd8 + "</td><td>" + wgd8 + "</td><td>" + wsub8 + "</td></tr>";
            html += "<tr><td>" + ssub9 + "</td><td>" + sgd9 + "</td><td>" + wgd9 + "</td><td>" + wsub9 + "</td></tr>";
            html += "<tr><td>" + ssub10 + "</td><td>" + sgd10 + "</td><td>" + wgd10 + "</td><td>" + wsub10 + "</td></tr>";

            document.getElementById("verify_body").innerHTML = html;
        }
    })
}

function gradSearch() {
    $("#gradSearch").modal('show');

    $("#gradsearchBtn").unbind('click').on('click', function() {
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

            success: function(response) {
                // console.log(response);
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
                    var status = data[i].qualification_status;

                    html += "<tr><td>" + a + "</td><td>" + uin + "</td><td>" + indexno + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + progname + "</td><td>" + gradclass + "</td><td>" + graddate + "</td><td>" + status + "</td></tr>";
                }
                document.getElementById("gradTableBody").innerHTML = html;
                $("#gradTable").DataTable({
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
                $("#gradForm").trigger('reset');
                $("#gradSearch").modal('hide');
            }
        })
    })
}

function veriSearch() {
    $("#veriSearch").modal('show');

    $("#verisearchBtn").on('click', function() {
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

            success: function(response) {
                // console.log(response);
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
                $("#veriTable").DataTable();
                $("#veriForm").trigger('reset');
                $("#veriSearch").modal('hide');
            }
        });
    })
}

function search_format() {
    var catSelector = document.getElementById("category");
    catSelector.addEventListener("change", function() {
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

    var form = document.querySelector("#exportForm");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'exportsearch.php',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,

        success: function(response) {
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
                    var sgd1 = data[i].sgd1;
                    var sgd10 = data[i].sgd10;
                    var sgd2 = data[i].sgd2;
                    var sgd3 = data[i].sgd3;
                    var sgd4 = data[i].sgd4;
                    var sgd7 = data[i].sgd7;
                    var sgd8 = data[i].sgd8;
                    var sgd9 = data[i].sgd9;

                    var ssub1 = data[i].ssub1;
                    var ssub10 = data[i].ssub10;
                    var ssub2 = data[i].ssub2;
                    var ssub3 = data[i].ssub3;
                    var ssub4 = data[i].ssub4;
                    var ssub7 = data[i].ssub7;
                    var ssub8 = data[i].ssub8;
                    var ssub9 = data[i].ssub9;

                    var wgd1 = data[i].wgd1;
                    var wgd10 = data[i].wgd10;
                    var wgd2 = data[i].wgd2;
                    var wgd3 = data[i].wgd3;
                    var wgd4 = data[i].wgd4;
                    var wgd7 = data[i].wgd7;
                    var wgd8 = data[i].wgd8;
                    var wgd9 = data[i].wgd9;

                    var windexno = data[i].index;
                    var wname = data[i].wname;
                    var uin = data[i].uin;
                    var name = data[i].name;
                    var student_no = data[i].stdno;

                    var wsub1 = data[i].wsub1;
                    var wsub10 = data[i].wsub10;
                    var wsub2 = data[i].wsub2;
                    var wsub3 = data[i].wsub3;
                    var wsub4 = data[i].wsub4;
                    var wsub7 = data[i].wsub7;
                    var wsub8 = data[i].wsub8;
                    var wsub9 = data[i].wsub9;

                    html += "<tr><td rowspan='8'>" + uin + "</td><td rowspan='8'>" + student_no + "</td><td rowspan='8'>" + windexno + "</td><td rowspan='8'>" + name + "</td><td>" + ssub1 + "</td><td>" + sgd1 + "</td><td>" + wgd1 + "</td><td>" + wsub1 + "</td><td rowspan='8'>" + wname + "</td></tr>";

                    html += "<tr><td>" + ssub2 + "</td><td>" + sgd2 + "</td><td>" + wgd2 + "</td><td>" + wsub2 + "</td></tr>";

                    html += "<tr><td>" + ssub3 + "</td><td>" + sgd3 + "</td><td>" + wgd3 + "</td><td>" + wsub3 + "</td></tr>";

                    html += "<tr><td>" + ssub4 + "</td><td>" + sgd4 + "</td><td>" + wgd4 + "</td><td>" + wsub4 + "</td></tr>";

                    html += "<tr><td>" + ssub7 + "</td><td>" + sgd7 + "</td><td>" + wgd7 + "</td><td>" + wsub7 + "</td></tr>";

                    html += "<tr><td>" + ssub8 + "</td><td>" + sgd8 + "</td><td>" + wgd8 + "</td><td>" + wsub8 + "</td></tr>";

                    html += "<tr><td>" + ssub9 + "</td><td>" + sgd9 + "</td><td>" + wgd9 + "</td><td>" + wsub9 + "</td></tr>";

                    html += "<tr><td>" + ssub10 + "</td><td>" + sgd10 + "</td><td>" + wgd10 + "</td><td>" + wsub10 + "</td></tr>";
                }

                document.getElementById("export_veriBody").innerHTML = html;

                document.getElementById("exportTableVerify").style.display = 'block';
                document.getElementById("exportTable").style.display = 'none';
                document.getElementById("uploadBody").style.display = 'none';
                document.getElementById("exportBody").style.display = 'none';
                document.getElementById("veriBody").style.display = 'none';
                document.getElementById("gradBody").style.display = 'none';
            } else if (category == 'waec') {

            }

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