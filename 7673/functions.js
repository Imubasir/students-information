$(document).ready(function() {
    load_data();
    $("#add").on('hidden.bs.modal', function() {
        document.getElementById("addCampus_name").value = '';
        document.getElementById("addRegion").value = '';
    });
});

function load_data() {
    $.ajax({
        url: 'load_data.php',

        success: function(response) {
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                var id = data[i].campus_id;
                var campus = data[i].campus_descr;
                var region = data[i].regionname;

                html += "<tr><td>" + a + "</td><td>" + campus + "</td><td>" + region + "</td><td><button class='btn btn-sm btn-success' onclick='edit(\"" + id + "\")'>Edit</button>&nbsp;&nbsp;<button class='btn btn-sm btn-danger' onclick='del(\"" + id + "\")'>Delete</button></td></tr>";
            }
            document.getElementById("campusBody").innerHTML = html;
        }
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
                var campus = data[i].campus_descr;
                var region = data[i].region;

                document.getElementById("campus_name").value = campus;
                document.getElementById("region").value = region;
            }

            $("#updateBtn").unbind('click').on('click', function() {
                var ed_campus = $("#campus_name").val();
                var ed_region = $("#region").val();

                $.ajax({
                    type: 'POST',
                    url: 'edit.php',
                    data: 'id=' + id + '&name=' + ed_campus + '&region=' + ed_region,

                    success: function(response) {
                        if (response == '1') {
                            load_data();
                            $("#edit").modal('hide');
                            new PNotify({
                                title: 'Success',
                                text: "Campus Edited",
                                type: 'success',
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
            })

        }
    })
}

function addCampus() {
    $("#add").modal('show');

    $("#addBtn").unbind('click').on('click', function() {
        var add_campus = $("#addCampus_name").val();
        var add_region = $("#addRegion").val();

        $.ajax({
            type: 'POST',
            url: 'add.php',
            data: 'name=' + add_campus + '&add_region=' + add_region,

            success: function(response) {
                if (response == '1') {
                    load_data();
                    $("#add").modal('hide');
                    new PNotify({
                        title: 'Success',
                        text: "Campus Added",
                        type: 'success',
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
    })

}

function del(id) {
    $.ajax({
        type: 'POST',
        url: 'del.php',
        data: 'id=' + id,

        success: function(resp) {
            if (resp == '1') {
                new PNotify({
                    title: 'Success',
                    text: 'Campus Deleted',
                    type: 'success',
                    styling: 'bootstrap3'
                })
                load_data();
            } else {
                new PNotify({
                    title: 'Error',
                    text: resp,
                    type: 'error',
                    styling: 'bootstrap3'
                })
            }
        }
    })
}