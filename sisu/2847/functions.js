// function Search() {
//     var student_id = $("#student_uin").val();

//     if (student_id == '') {
//         new PNotify({
//             title: 'Error',
//             text: 'Input Student ID / UIN',
//             type: 'error',
//             styling: 'bootstrap3'
//         })
//     } else {
//         $.ajax({
//             type: 'POST',
//             url: 'search.php',
//             data: 'student_id=' + student_id,

//             success: function(response) {
//                 console.log(response);
//                 var data = JSON.parse(response);
//                 if (data.length > 0) {

//                     $.ajax({
//                         type: 'POST',
//                         url: 'fetch_bio.php',
//                         data: 'student_id=' + student_id,

//                         success: function(json) {
//                             console.log(json);
//                             var data_ = JSON.parse(json);
//                             var html = '';
//                             for (var i = 0; i < data_.length; i++) {
//                                 var indexno = data_[i].indexno;
//                                 var surname = data_[i].surname;
//                                 var middlename = data_[i].middlename;
//                                 var firstname = data_[i].firstname;
//                                 var name = surname + " " + middlename + " " + firstname;
//                                 var progname = data_[i].progname;

//                                 html += "<tr><td>" + indexno + "</td><td>" + name + "</td><td>" + progname + "</td><td><button class='btn btn-sm btn-success' onclick='issue_disp(\"" + indexno + "\")'>Issue</button></td></tr>";

//                             }
//                             $("#issue_body").html(html);
//                             // $("#disp_table").DataTable();
//                             document.getElementById("div_table").style.display = 'block';
//                             document.getElementById("entire").style.display = 'none';
//                         }
//                     })
//                 } else {
//                     new PNotify({
//                         title: 'ERROR',
//                         text: 'Payments Not Made',
//                         type: 'error',
//                         styling: 'bootstrap3'

//                     })
//                 }

//             }
//         })
//     }

// }

// function load_data() {
//     $("#cert_table").dataTable().fnDestroy();
//     $.ajax({
//         url: 'load_data.php',

//         success: function(json) {
//             console.log(json);
//             var data = JSON.parse(json);
//             var html = '';
//             for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
//                 var index = data[i].indexno;
//                 var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
//                 var certno = data[i].certno;
//                 var prog = data[i].progname;
//                 var gradclass = data[i].gradclass;
//                 var graddate = data[i].graddate;
//                 if (data[i].issued_date) {
//                     var iss_date = moment(data[i].issued_date).format("DD MMM YYYY");
//                 } else {
//                     var iss_date = "";
//                 }

//                 if (certno == '' || certno == null) {
//                     var button = "";
//                 } else {
//                     var button = "<button class='btn btn-sm btn-success' onclick='issue_disp(\"" + index + "\")'>Issue</button>";
//                 }

//                 html += "<tr><td>" + a + "</td><td>" + index + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + graddate + "</td><td>" + iss_date + "</td><td>" + button + "</td></tr>";
//             }

//             $("#cert_bdy").html(html);
//             $("#cert_table").DataTable();
//         }
//     })
// }

function gradSearch() {
    $("#cert_table").dataTable().fnDestroy();
    $("#studentSearchModal").modal('show');

    $("#studentsearchBtn").unbind('click').on('click', function() {
        $("#studentsearchBtn").html("<img src='../images/ellipse.gif' width='25px' height='25px'>");
        document.getElementById("studentsearchBtn").disabled = true;

        var form = document.querySelector("#enrollForm");
        var formdata = new FormData(form);

        $.ajax({
            type: 'POST',
            url: 'gradsearch.php',
            data: formdata,
            cache: false,
            contentType: false,
            processData: false,

            success: function(json) {
                //console.log(json);
                var data = JSON.parse(json);
                var html = '';
                for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                    var index = data[i].indexno;
                    var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                    var certno = data[i].certno;
                    var prog = data[i].progname;
                    var gradclass = data[i].gradclass;
                    var graddate = data[i].graddate;

                    if (data[i].issued_date) {
                        var iss_date = moment(data[i].issued_date).format("DD MMM YYYY");
                    } else {
                        var iss_date = "";
                    }

                    if (certno == '' || certno == null) {
                        var button = "";
                    } else {
                        var button = "<button class='btn btn-sm btn-success' onclick='issue_disp(\"" + index + "\")'>Issue</button>";
                    }

                    html += "<tr><td>" + a + "</td><td>" + index + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + graddate + "</td><td>" + iss_date + "</td><td>" + button + "</td></tr>";

                }
                $("#studentsearchBtn").html("Search");
                document.getElementById("studentsearchBtn").disabled = false;
                $("#enrollForm").trigger('reset');
                $("#studentSearchModal").modal('hide');
                $("#cert_bdy").html(html);
                $("#cert_table").DataTable();
            }
        })
    })
}

function issue_disp(id) {
    $("#gown_status").html("");
    $("#pay_status").html("");


    $.ajax({
        type: 'POST',
        url: 'final_issue.php',
        data: 'id=' + id,

        success: function(json) {
            fetch_bio(id);
            // console.log(json);
            $("#cert_detail").modal('show');
            document.getElementById("issue_btn").disabled = true;
            var data = JSON.parse(json);

            if (json == 0) {
                new PNotify({
                    title: 'ERROR',
                    text: 'Already Issued',
                    type: 'info',
                    styling: 'bootstrap3'
                })
            } else if (data.length == 0) {
                $("#gown_status").html("Gown Not Taken");
                document.getElementById("issue_btn").disabled = false;
                check_payment(id);
            } else if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var status = data[i].status;

                    if (status == 0) {
                        $("#gown_status").html("Gown Not Returned");
                        document.getElementById("issue_btn").disabled = true;
                    } else if (status == 1) {
                        $("#gown_status").html("Gown Returned");
                        document.getElementById("issue_btn").disabled = false;
                    }
                }
            } else {
                new PNotify({
                    title: 'ERROR',
                    text: json,
                    type: 'info',
                    styling: 'bootstrap3'
                })
                document.getElementById("issue_btn").disabled = true;
            }

            $("#issue_btn").unbind('click').on('click', function() {
                // var certno = $("#cert_no").val();
                var clearence_status = $("#clearence_status").val();
                // alert(certno);
                if (clearence_status == '0') {
                    new PNotify({
                        title: 'Error',
                        text: 'Clearence Not Submitted',
                        type: 'error',
                        styling: 'bootstrap3'
                    })
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'update_grad.php',
                        data: 'student_id=' + id,

                        success: function(response) {
                            if (response == '1') {
                                new PNotify({
                                    title: 'Success',
                                    text: 'Certificate Issued',
                                    type: 'success',
                                    styling: 'bootstrap3'
                                })
                                $("#cert_detail").modal('hide');
                                reload();
                            } else {
                                new PNotify({
                                    title: 'ERROR',
                                    text: 'Issue Failed',
                                    type: 'error',
                                    styling: 'bootstrap3'
                                })
                            }
                        }
                    })
                }

            })
        }
    })
}

function fetch_bio(id) {
    $.ajax({
        type: 'POST',
        url: 'fetch_bio.php',
        data: 'id=' + id,

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var surname = data[i].surname;
                var middlename = data[i].middlename;
                var firstname = data[i].firstname;
                var prog = data[i].progname;

                $("#name").html(surname + " " + middlename + " " + firstname);
                $("#prog").html(prog);

            }
        }
    })
}

function check_payment(id) {
    $.ajax({
        type: 'POST',
        url: 'check_payment.php',
        data: 'student_id=' + id,

        success: function(json_) {
            // var result = JSON.parse(json_);
            // for (var i = 0; i < result.length; i++) {
            // var status = result[i].payment_status;

            // if (state == 'failed') {
            //     $("#pay_status").html("Response Error");
            //     document.getElementById("issue_btn").disabled = true;
            // } else {
            if (json_ != '1') {
                $("#pay_status").html("Amount Not Paid");
                document.getElementById("issue_btn").disabled = true;
            } else if (json_ == '1') {
                $("#pay_status").html("Amount Paid");
                document.getElementById("issue_btn").disabled = false;
            }
            // }

            // }
        }

    })
}


$(document).ready(function() {
    // load_data();
})