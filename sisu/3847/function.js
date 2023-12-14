$(document).ready(function() {
    load_data();
    pg_load_data();
    $("#add").on('hidden.bs.modal', function() {
        $("#progForm").trigger('reset');
    });
});

function load_data() {
    $("#progTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var prog_id = data[i].progid;
                var prog = data[i].progname;
                var faculty = data[i].facultyname;
                var dept = data[i].deptname;
                var campus = data[i].campus_descr;
                var duration = data[i].duration;

                html += "<tr><td>" + a + "</td><td>" + prog + "</td><td>" + dept + "</td><td>" + faculty + "</td><td>" + duration + "</td><td>" + campus + "</td><td style='width: 20%;'><button onclick='edit(\"" + prog_id + "\")' class='btn btn-sm btn-success'>Edit</button>&nbsp;&nbsp;<button onclick='del(\"" + prog_id + "\")' class='btn btn-sm btn-danger'>Delete</button></td></tr>";
            }
            document.getElementById("progBody").innerHTML = html;
            $("#progTable").DataTable();
        }

    });
}

function pg_load_data() {
    $("#pg_progTable").dataTable().fnDestroy();
    $.ajax({
        url: 'pg_load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var prog_id = data[i].progid;
                var prog = data[i].progname;
                var faculty = data[i].facultyname;
                var dept = data[i].deptname;
                var campus = data[i].campus_descr;
                var duration = data[i].duration;

                html += "<tr><td>" + a + "</td><td>" + prog + "</td><td>" + dept + "</td><td>" + faculty + "</td><td>" + duration + "</td><td>" + campus + "</td><td style='width: 20%;'><button onclick='pg_edit(\"" + prog_id + "\")' class='btn btn-sm btn-success'>Edit</button>&nbsp;&nbsp;<button onclick='pg_del(\"" + prog_id + "\")' class='btn btn-sm btn-danger'>Delete</button></td></tr>";
            }
            document.getElementById("PG_progBody").innerHTML = html;
            $("#pg_progTable").DataTable();
        }

    });
}

function addProgramme() {
    $("#add").modal('show');

    $("#addBtn").unbind('click').on('click', function() {
        var form = document.querySelector("#progForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'addProg.php',
            data: formdata,
            contentType: false,
            processData: false,
            cache: false,

            success: function(response) {
                if (response == '1') {
                    load_data();
                    $("#add").modal('hide');
                } else {
                    alert(response);
                }
            }
        })
    })
}

function PG_addProgramme() {
    $("#pg_add").modal('show');

    $("#pg_addBtn").unbind('click').on('click', function() {
        var form = document.querySelector("#pg_progForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'pg_addprog.php',
            data: formdata,
            contentType: false,
            processData: false,
            cache: false,

            success: function(response) {
                if (response == '1') {
                    pg_load_data();
                    $("#pg_add").modal('hide');
                    $("#pg_progForm").trigger('reset');
                } else {
                    alert(response);
                }
            }
        })
    })
}

function edit(id) {
    $("#edit").modal('show');
    $.ajax({
        type: 'POST',
        url: 'select_edit.php',
        data: 'id=' + id,

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {

                var prog_id = data[i].progid;
                var prog = data[i].progname;
                var progfull = data[i].fullname;
                var faculty = data[i].facultyname;
                var dept = data[i].deptid;
                var campus = data[i].campus_descr;
                var duration = data[i].duration;


                document.getElementById("e_progname").value = prog;
                document.getElementById("e_progfullname").value = progfull;
                document.getElementById("e_dept").value = dept;
                document.getElementById("e_duration").value = duration;
            }

            $("#editBtn").unbind('click').on('click', function() {
                var form = document.querySelector("#editForm");
                var formdata = new FormData(form);
                formdata.append("key", id);

                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,

                    success: function(response) {
                        if (response == '1') {
                            $("#edit").modal('hide');
                            load_data();
                        } else {
                            alert(response);
                        }
                    }
                });
            })
        }
    })
}

function pg_edit(id) {
    $("#pg_edit").modal('show');
    $.ajax({
        type: 'POST',
        url: 'pg_select_edit.php',
        data: 'id=' + id,

        success: function(response) {
            // console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {

                var prog_id = data[i].progid;
                var prog = data[i].progname;
                var progfull = data[i].fullname;
                var faculty = data[i].facultyname;
                var dept = data[i].deptid;
                var campus = data[i].campus_descr;
                var duration = data[i].duration;


                document.getElementById("pg_e_progname").value = prog;
                document.getElementById("pg_e_progfullname").value = progfull;
                document.getElementById("pg_e_dept").value = dept;
                document.getElementById("pg_e_duration").value = duration;
            }

            $("#pg_editBtn").unbind('click').on('click', function() {
                var form = document.querySelector("#pg_editForm");
                var formdata = new FormData(form);
                formdata.append("key", id);

                $.ajax({
                    type: 'POST',
                    url: 'pg_edit.php',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,

                    success: function(response) {
                        //console.log(response);
                        if (response == '1') {
                            $("#pg_edit").modal('hide');
                            load_data();
                        } else {
                            alert(response);
                        }
                    }
                });
            })
        }
    })
}

function del(id) {
    $("#delBody").html("Confirm Deletion of " + id + "");
    $("#delModal").modal('show');

    $("#delBtn").unbind('click').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'del.php',
            data: 'id=' + id,

            success: function(response) {
                if (response == "1") {
                    new PNotify({
                        title: 'Success',
                        text: 'Programme Deleted',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    load_data();
                    $("#delModal").modal('hide');
                } else {
                    new PNotify({
                        title: 'Error',
                        text: response,
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                }
            }
        });
    });
}

function pg_del(id) {
    $("#pgdelBody").html("Confirm Deletion of " + id + "");
    $("#pgdelModal").modal('show');

    $("#pgdelBtn").unbind('click').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'pg_del.php',
            data: 'id=' + id,

            success: function(response) {
                if (response == "1") {
                    new PNotify({
                        title: 'Success',
                        text: 'Programme Deleted',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    pg_load_data();
                    $("#pgdelModal").modal('hide');
                } else {
                    new PNotify({
                        title: 'Error',
                        text: response,
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                }
            }
        });
    });
}