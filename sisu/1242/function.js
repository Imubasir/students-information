$(document).ready(function() {

    load_data();
});

function load_data() {
    $("#userTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var sid = data[i].staff_ID;
                var name = data[i].first_name + " " + data[i].last_name;
                var username = data[i].username;
                var addedBy = data[i].added_by;
                var dateAdded = data[i].date_added;

                html += "<tr><td>" + a + "</td><td>" + name + "</td><td>" + username + "</td><td>" + addedBy + "</td><td>" + dateAdded + "</td><td style='width: 20%;'><button onclick='edit(\"" + username + "\")' class='btn btn-sm btn-success'>Edit</button>&nbsp;<button onclick='del(\"" + username + "\")'  class='btn btn-sm btn-danger'>Delete</button>&nbsp;<button onclick='accessCheck(\"" + username + "\")'  class='btn btn-sm btn-default'>Access</button></td></tr>";
            }
            document.getElementById("userBody").innerHTML = html;
            $("#userTable").DataTable();
        }
    });
}

function addUser() {
    $("#add").modal('show');

    $("#addBtn").unbind('click').on('click', function() {
        var form = document.querySelector("#userForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'adduser.php',
            data: formdata,
            contentType: false,
            processData: false,
            cache: false,

            success: function(response) {
                if (response == '1') {
                    load_data();
                    new PNotify({
                        title: 'Success',
                        text: 'New User Added',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    $("#add").modal('hide');
                    $("#userForm").trigger('reset');
                } else {
                    new PNotify({
                        title: 'Success',
                        text: response,
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }
            }
        })
    })
}

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};


function edit(id) {
    $("#edit").modal('show');
    $.ajax({
        type: 'POST',
        url: 'select_edit.php',
        data: 'id=' + id,

        success: function(response) {
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {

                var sid = data[i].staff_ID;
                var fname = data[i].first_name;
                var mname = data[i].middle_name;
                var lname = data[i].last_name;
                var dob = data[i].dob;
                var title = data[i].title
                var email = data[i].email;
                var gender = data[i].gender;
                var phone = data[i].phone;
                var picture = data[i].picture;
                var dept = data[i].department;
                var username = data[i].username;
                var status = data[i].status;

                document.getElementById("e_s_id").value = sid;
                document.getElementById("e_f_name").value = fname;
                document.getElementById("e_m_name").value = mname;
                document.getElementById("e_l_name").value = lname;
                document.getElementById("e_dob").value = dob;
                document.getElementById("e_title").value = title;
                document.getElementById("e_email").value = email;
                document.getElementById("e_gender").value = gender;
                document.getElementById("e_phone").value = phone;
                document.getElementById("e_dept").value = dept;
                document.getElementById("e_status").value = status;
                document.getElementById("e_output").src = picture;
            }

            $("#updateBtn").unbind('click').on('click', function() {
                var form = document.querySelector("#editForm");
                var formdata = new FormData(form);
                formdata.append("key", username);

                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    cache: false,

                    success: function(response) {
                        if (response == "1") {
                            new PNotify({
                                title: 'Success',
                                text: 'User Updated',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            $("#edit").modal('hide');
                            load_data();
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

function del(user) {
    $("#delBody").html("Confirm Deletion of " + user + "");
    $("#delModal").modal('show');

    $("#delBtn").unbind('click').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'del.php',
            data: 'user=' + user,

            success: function(response) {
                if (response == "1") {
                    new PNotify({
                        title: 'Success',
                        text: 'User Deleted',
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


function accessCheck(username) {
    $("#access").modal('show');
    $("#checkAll").click(function() {
        if ($(this).prop("checked") == true) {
            var tbl = document.getElementById("accessbody");
            var rowCount = tbl.rows.length;
            $('input[type="checkbox"]').attr('checked', true);

        } else if ($(this).prop("checked") == false) {
            $('input[type="checkbox"]').attr('checked', false);
        }
    })
    $.ajax({
            type: 'POST',
            url: 'accessChecker.php',

            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);

                var html = '';
                for (var i = 0; i < data.length; i++) {
                    var id = data[i].page_id;
                    var page = data[i].page;

                    html += "<tr><td class='check-mail'><input type = 'checkbox' class = 'i-checks' value = '" + id + "' id ='" + id + "'></td><td>" + page + "</td></tr>";

                    check(username + "," + id);
                }
                document.getElementById("accessbody").innerHTML = html;

                $("#add_access").unbind('click').on('click', function() {
                    var tbl = document.getElementById("accessbody");
                    var rowCount = tbl.rows.length;
                    for (var i = 0; i < rowCount; i++) {

                        var row = tbl.rows[i];
                        var chkbox = row.cells[0].getElementsByTagName('input')[0];
                        if (null != chkbox && true == chkbox.checked) {
                            var name = chkbox.value;

                            addAccess(name + ',' + username);

                        } else if (null != chkbox && false == chkbox.checked) {
                            var name = chkbox.value;

                            delAccess(name + ',' + username);
                        }
                    }
                    new PNotify({
                        title: 'Success',
                        text: 'User Access Level Updated',
                        type: 'success',
                        styling: 'bootstrap3'
                    })
                    $("#access").modal('hide');
                })
            }
        })
        // $("#access").modal('hide');
}

function check(para) {
    var data = para.split(",");
    for (var i = 0; i < data.length; i++) {
        var username = data[0];
        var input = data[1];

    }
    $.ajax({
        type: 'POST',
        url: 'checkStatus.php',
        data: 'id=' + input + '&user=' + username,

        success: function(e) {
            if (e == input) {
                document.getElementById(input).checked = true;
            }
        }
    })
}

function addAccess(input) {
    var data = input.split(",");
    for (var i = 0; i < data.length; i++) {
        var input = data[0];
        var name = data[1];
    }
    $.ajax({
        type: 'POST',
        url: 'addAccess.php',
        data: 'id=' + input + '&user=' + name,

        success: function(e) {
            // console.log(e);
        }
    })

}

function close() {
    $("#access").modal('hide');
}

function delAccess(input) {
    var data = input.split(",");
    for (var i = 0; i < data.length; i++) {
        var input = data[0];
        var name = data[1];
    }

    $.ajax({
        type: 'POST',
        url: 'delAccess.php',
        data: 'id=' + input + '&user=' + name,

        success: function(e) {
            if (e == 1) {
                new PNotify({
                    title: 'User Removed',
                    text: name + ' Access Revoked',
                    type: 'information',
                    styling: 'bootstrap3'
                })
            }
        }
    })
}