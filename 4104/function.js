$(document).ready(function() {
    load_data();
    pg_load_data();
    $("#add").on('hidden.bs.modal', function() {
        $("#courseForm").trigger('reset');
    })
});

function load_data() {
    $("#courseTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var code = data[i].coursecode;
                var title = data[i].coursetitle;
                var credit = data[i].credit;
                var dept = data[i].deptname;

                html += "<tr><td>" + a + "</td><td>" + code + "</td><td>" + title + "</td><td>" + credit + "</td><td>" + dept + "</td><td><button onclick='edit(\"" + code + "\")' class='btn btn-sm btn-success'>Edit</button>&nbsp;&nbsp;<button onclick='del(\"" + code + "\")' class='btn btn-sm btn-danger'>Delete</button></td></tr>";
            }
            document.getElementById("courseBody").innerHTML = html;
            $("#courseTable").DataTable();
        }

    });
}

function addCourse() {
    $("#add").modal('show');

    $("#addBtn").unbind('click').on('click', function() {
        var form = document.querySelector("#courseForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'addCourse.php',
            data: formdata,
            contentType: false,
            processData: false,
            cache: false,

            success: function(response) {
                if (response == '1') {
                    load_data();
                    $("#add").modal('hide');
                    new PNotify({
                        title: 'Success',
                        text: 'Course Added',
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
}

function edit(id) {
    $("#edit").modal('show');
    $.ajax({
        type: 'POST',
        url: 'select_edit.php',
        data: 'id=' + id,

        success: function(response) {
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var code = data[i].coursecode;
                var title = data[i].coursetitle;
                var credit = data[i].credit;
                var dept = data[i].deptid;

                document.getElementById("e_code").value = code;
                document.getElementById("e_title").value = title;
                document.getElementById("e_credits").value = credit;
                document.getElementById("e_dept").value = dept;
            }

            $("#editBtn").unbind('click').on('click', function() {
                var form = document.querySelector("#editForm");
                var formdata = new FormData(form);
                formdata.append("key", code);

                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,

                    success: function(response) {
                        //console.log(response);
                        if (response == '1') {
                            $("#edit").modal('hide');
                            load_data();
                            new PNotify({
                                title: 'Success',
                                text: 'Course Edited',
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
                });
            })
        }
    })
}

function del(id) {
    $("#delBody").html("Confirm Deletion of Course" + id + "");
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
                        text: 'Course Deleted',
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

//-------------------------------------------------

function pg_load_data() {
    $("#courseTable").dataTable().fnDestroy();
    $.ajax({
        url: 'pg_load_data.php',

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var code = data[i].coursecode;
                var title = data[i].coursetitle;
                var credit = data[i].credit;
                var dept = data[i].deptname;

                html += "<tr><td>" + a + "</td><td>" + code + "</td><td>" + title + "</td><td>" + credit + "</td><td>" + dept + "</td><td><button onclick='edit(\"" + code + "\")' class='btn btn-sm btn-success'>Edit</button>&nbsp;&nbsp;<button onclick='del(\"" + code + "\")' class='btn btn-sm btn-danger'>Delete</button></td></tr>";
            }
            document.getElementById("pg_courseBody").innerHTML = html;
            $("#pg_courseTable").DataTable();
        }

    });
}

function pg_addCourse() {
    $("#pg_add").modal('show');

    $("#pg_addBtn").unbind('click').on('click', function() {
        var form = document.querySelector("#pg_courseForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'pg_addCourse.php',
            data: formdata,
            contentType: false,
            processData: false,
            cache: false,

            success: function(response) {
                if (response == '1') {
                    load_data();
                    $("#pg_add").modal('hide');
                    new PNotify({
                        title: 'Success',
                        text: 'Course Added',
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
}

function pg_edit(id) {
    $("#pg_edit").modal('show');
    $.ajax({
        type: 'POST',
        url: 'pg_select_edit.php',
        data: 'id=' + id,

        success: function(response) {
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var code = data[i].coursecode;
                var title = data[i].coursetitle;
                var credit = data[i].credits;
                var dept = data[i].deptid;

                document.getElementById("e_code").value = code;
                document.getElementById("e_title").value = title;
                document.getElementById("e_credits").value = credit;
                document.getElementById("e_dept").value = dept;
            }

            $("#pg_editBtn").unbind('click').on('click', function() {
                var form = document.querySelector("#editForm");
                var formdata = new FormData(form);
                formdata.append("key", code);

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
                            new PNotify({
                                title: 'Success',
                                text: 'Course Edited',
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
                });
            })
        }
    })
}

function pg_del(id) {
    $("#pg_delBody").html("Confirm Deletion of Course" + id + "");
    $("#pg_delModal").modal('show');

    $("#pg_delBtn").unbind('click').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'pg_del.php',
            data: 'id=' + id,

            success: function(response) {
                if (response == "1") {
                    new PNotify({
                        title: 'Success',
                        text: 'Course Deleted',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    load_data();
                    $("#pg_delModal").modal('hide');
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