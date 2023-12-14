$(document).ready(function() {
    load_data();
    $("#add").on('hidden.bs.modal', function() {
        $("#deptForm").trigger('reset');
    });
});

function load_data() {
    $("#deptTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var id = data[i].deptid;
                var name = data[i].deptname;
                var faculty = data[i].facultyname;
                var hod = data[i].hod;
                var campus = data[i].campus_descr;

                html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + faculty + "</td><td>" + hod + "</td><td>" + campus + "</td><td><button onclick='edit(\"" + id + "\")' class='btn btn-sm btn-success'>Edit</button>&nbsp;&nbsp;<button onclick='del(\"" + id + "\")' class='btn btn-sm btn-danger'>Delete</button></td></tr>";
            }
            document.getElementById("deptBody").innerHTML = html;
            $("#deptTable").DataTable();
        }

    });
}

function addDepartment() {
    $("#add").modal('show');

    $("#addBtn").unbind('click').on('click', function() {
        var form = document.querySelector("#deptForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'addDept.php',
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

                var dept = data[i].deptname;
                var hod = data[i].hod;
                var faculty = data[i].facultyid;
                var campus = data[i].campus;

                document.getElementById("e_deptname").value = dept;
                document.getElementById("e_hod").value = hod;
                document.getElementById("e_faculty").value = faculty;
                document.getElementById("e_campus").value = campus;
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
                        text: 'Department Deleted',
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