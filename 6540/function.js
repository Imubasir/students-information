$(document).ready(function () {
    keep_open("keep-open,index");
    load_data();
});

function addHall() {
    $("#addHall").modal('show');
    $("#addBtn").off("click").on("click", function () {
        var formdata = new FormData(document.querySelector("#HallForm"));
        $.ajax({
            type: 'POST',
            url: 'addHall.php',
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response == '1') {
                    new PNotify({
                        title: 'Success',
                        text: 'Hall Added Successfully',
                        type: 'success',
                        styling: 'bootstrap3'
                    })
                    load_data();
                    $("#addHall").modal('hide');
                    ("#HallForm").trigger('reset');
                } else {
                    console.log(response);
                    new PNotify({
                        title: 'Error',
                        text: 'Addition Failed',
                        type: 'error',
                        styling: 'bootstrap3'
                    })
                }
            }
        })
    })
}

function load_data() {
    $.ajax({
        url: 'load_data.php',

        success: function (json) {
            console.log(json);
            var data = JSON.parse(json);
            var html = "";
            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var hallID = data[i].hall_id;
                var hallName = data[i].hall_name;
                var hallGender = data[i].hall_gender;
                var hallCampus = data[i].campus_descr;
                var hallCapacity = data[i].hall_capacity;

                var delBtn = "<button onclick='del(\"" + hallID + "\")' class='btn btn-sm btn-danger'>Delete</button>";
                var editBtn = "<button onclick='edit(\"" + hallID + "\")' class='btn btn-sm btn-info'>Edit</button>";

                html += "<tr><td>" + a + "</td><td>" + hallName + "</td><td>" + hallCapacity + "</td><td>" + hallGender + "</td><td>" + hallCampus + "</td><td>" + delBtn + " " + editBtn + "</td></tr>";
            }
            $("#hall_body").html(html);
            $("#hall_tbl").DataTable();
        }
    })
}

function del(id) {
    $("#confirmDel").modal("show");

    $("#delBtn").off('click').on('click', function () {
        $.ajax({
            type: 'POST',
            url: 'del.php',
            data: 'id=' + id,

            success: function (response) {
                if (response == '1') {
                    new PNotify({
                        title: 'Success',
                        text: 'Hall Deleted',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    $("#confirmDel").modal("hide");
                    load_data();
                } else {
                    console.log(response);
                    new PNotify({
                        title: 'Error',
                        text: 'Deletion Failed',
                        type: 'error',
                        styling: 'bootstrap3'
                    })
                }
            }
        })
    })

}

function edit(id) {
    $("#editHall").modal('show');
    $.ajax({
        type: 'POST',
        url: 'selectEdit.php',
        data: 'id=' + id,

        success: function (json) {
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var hallID = data[i].hall_id;
                var hallName = data[i].hall_name;
                var hallGender = data[i].hall_gender;
                var hallCampus = data[i].hall_campus_id;
                var hallCapacity = data[i].hall_capacity;

                $("#Ehall_name").val(hallName);
                $("#Ehall_gender").val(hallGender);
                $("#Ehall_campus").val(hallCampus);
                $("#Ehall_capacity").val(hallCapacity);
            }

            $("#editBtn").off('click').on('click', function () {
                var formdata = new FormData(document.querySelector("#editForm"));
                formdata.append("Ehall_id", hallID);
                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                    data: formdata,
                    cache: false,
                    processData: false,
                    contentType: false,

                    success: function (response) {
                        if (response == '1') {
                            new PNotify({
                                title: 'Success',
                                text: 'Hall Updated Successfully',
                                type: 'success',
                                styling: 'bootstrap3'
                            })
                            load_data();
                            $("#editHall").modal('hide');
                            ("#EditForm").trigger('reset');
                        } else {
                            console.log(response);
                            new PNotify({
                                title: 'Error',
                                text: 'Update Failed',
                                type: 'error',
                                styling: 'bootstrap3'
                            })
                        }
                    }
                })
            })
        }
    })
}
