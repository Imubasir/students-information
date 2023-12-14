// function load_data() {
//     $("#cert_table").dataTable().fnDestroy();
//     $.ajax({
//         url: 'load_data.php',

//         success: function(json) {
//             // console.log(json);
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
//                     var button = "<button onclick='details(\"" + index + "\")'>View Details</button>";
//                 }


//                 html += "<tr><td>" + a + "</td><td>" + index + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + graddate + "</td><td>" + iss_date + "</td><td>" + button + "</td></tr>";
//             }
//             $("#cert_bdy").html(html);
//             $("#cert_table").DataTable();
//         }
//     })
// }

function Search() {
    var student_id = $("#student_uin").val();

    if (student_id == '') {
        new PNotify({
            title: 'Error',
            text: 'Input Student ID / UIN',
            type: 'error',
            styling: 'bootstrap3'
        })
    } else {
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: 'student_id=' + student_id,

            success: function(response) {
                //console.log(response);
                var data = JSON.parse(response);
                if (data) {

                    $.ajax({
                        type: 'POST',
                        url: 'fetch_bio.php',
                        data: 'student_id=' + student_id,

                        success: function(json) {
                            //console.log(json);
                            var data_ = JSON.parse(json);
                            var html = '';
                            for (var i = 0; i < data_.length; i++) {
                                var indexno = data_[i].indexno;
                                var surname = data_[i].surname;
                                var middlename = data_[i].middlename;
                                var firstname = data_[i].firstname;
                                var name = surname + " " + middlename + " " + firstname;
                                var progname = data_[i].progname;

                                html += "<tr><td>" + indexno + "</td><td>" + name + "</td><td>" + progname + "</td><td><button class='btn btn-sm btn-success' onclick='issue_disp(\"" + indexno + "\")'>Issue</button></td></tr>";

                            }
                            $("#issue_body").html(html);
                            // $("#disp_table").DataTable();
                            document.getElementById("div_table").style.display = 'block';
                            document.getElementById("entire").style.display = 'none';
                        }
                    })
                } else {
                    new PNotify({
                        title: 'ERROR',
                        text: 'Payments Not Made',
                        type: 'error',
                        styling: 'bootstrap3'

                    })
                }

            }
        })
    }

}

function details(id) {
    document.getElementById("issue_btn").disabled = true;
    $("#cert_detail").modal('show');
    $.ajax({
        type: 'POST',
        url: 'details.php',
        data: 'id=' + id,

        success: function(response) {
            var data = JSON.parse(response);

            var html = '';
            for (var i = 0; i < data.length; i++) {
                var certno = data[i].certno;
                var index = data[i].indexno;
                var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                var gradclass = data[i].gradclass;
                var qualification = data[i].qualification_status;
                var issue = data[i].issued;
                var prog = data[i].progname;

                souvernir_status(index);

                html += "<tr><td style='text-align:center' colspan='2'><img class='align-self-center rounded-circle mr-3' src='../images/avatar.png' width='150px' height='150px'></td></tr>";
                html += "<tr><td style='font-weight: bold;'>Index Number</td><td>" + index + "</td></tr><tr><td style='font-weight: bold;'>Name</td><td>" + name + "</td></tr><tr><td style='font-weight: bold;'>Programme</td><td>" + prog + "</td></tr><tr><td style='font-weight: bold;'>Class</td><td>" + gradclass + "</td></tr><tr><td style='font-weight: bold;'>Graduation Fee</td><td id='fee'>Verifying...</td></tr><tr><td style='font-weight: bold;'>Clearance</td><td id='status'></td></tr>";
            }
            $("#det_body").html(html);
            // if (issue == '1') {
            //     document.getElementById("issue_btn").disabled = true;
            //     $("#issue_btn").html("Already Issued");
            // } else {
            //     document.getElementById("issue_btn").disabled = false;
            //     $("#issue_btn").html("Issue");
            // }

            $("#issue_btn").unbind('click').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: 'update_issue.php',
                    data: 'id=' + index,

                    success: function(response) {
                        if (response == "1") {
                            new PNotify({
                                title: 'Success',
                                text: 'Certificate Issued',
                                type: 'success',
                                styling: 'bootstrap3'
                            })
                            load_data();
                            $("#cert_detail").modal('hide');
                        } else if (response == '2') {
                            new PNotify({
                                title: 'Failed to Issue',
                                text: 'Certificate Already Issued',
                                type: 'info',
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



function souvernir_status(id) {
    $.ajax({
        url: 'getUser.php',

        success: function(username) {
            document.getElementById("issue_btn").disabled = true;
            $.ajax({
                type: 'POST',
                url: 'https://collections.uds.edu.gh/payment/status',
                data: 'student_id=' + id + '&fee_type=graduation',

                success: function(json_) {
                    var result = JSON.parse(json_);
                    for (var i = 0; i < result.length; i++) {
                        var status = result[i].payment_status;
                        var state = result[i].status;
                        var paid = result[i].amount_paid;
                        var due = result[i].amount_due;

                        if (state == 'failed') {
                            $("#fee").html("<span style='color:red;font-weight:bold;'>Response Error</span>");
                            document.getElementById("issue_btn").disabled = true;
                        } else {
                            if (status == 'false') {
                                $("#fee").html("<span style='color:red;font-weight:bold;'>Not Paid</span>");
                                document.getElementById("issue_btn").disabled = true;
                            } else if (paid == due) {
                                $("#fee").html("<span style='color:red;font-weight:bold;'>Amount Paid</span>");
                                document.getElementById("issue_btn").disabled = false;
                            }
                        }

                    }

                    $.ajax({
                        type: 'POST',
                        url: 'https://collections.uds.edu.gh/souvenir/status',
                        data: 'student_id=' + id + '&username=' + username,

                        success: function(json) {
                            var data = JSON.parse(json);
                            var check_status = '';
                            for (var i = 0; i < data.length; i++) {
                                var check_status = data[i].status;

                                if (check_status == '0') {
                                    var _status = "<span style='font-weight:bold;color:darkgreen;'>Gown Not Returned</span>";
                                    document.getElementById("issue_btn").disabled = true;
                                } else if (check_status == '1') {
                                    var _status = "<span style='font-weight:bold;color:red;'>Gown Returned</span>";
                                    document.getElementById("issue_btn").disabled = false;
                                } else {
                                    var _status = "<span style='font-weight:bold;color:black;'>Gown Not Taken</span>";
                                }

                                $("#status").html(_status);
                            }
                        }
                    })

                    $.ajax({
                        type: 'POST',
                        url: 'details.php',
                        data: 'id=' + id,

                        success: function(response) {
                            var data = JSON.parse(response);

                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                                var certno = data[i].certno;
                                var index = data[i].indexno;
                                var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                                var gradclass = data[i].gradclass;
                                var qualification = data[i].qualification_status;
                                var issue = data[i].issued;
                                var prog = data[i].progname;

                                if (issue == '1') {
                                    $("#issue_btn").html("Already Issued");
                                    document.getElementById("issue_btn").disabled = true;
                                } else {
                                    document.getElementById("issue_btn").disabled = false;
                                    $("#issue_btn").html("Issue");
                                }
                            }
                        }
                    })
                }
            })
        }
    })
}

function gradSearch() {
    document.getElementById("entire").style.display = 'block';
    document.getElementById("div_table").style.display = 'none';
    // $("#gradSearch").modal('show');

    // $("#gradsearchBtn").on('click', function() {
    //     $("#cert_table").dataTable().fnDestroy();
    //     var form = document.querySelector("#gradForm");
    //     var formdata = new FormData(form);

    //     $.ajax({
    //         type: 'POST',
    //         url: 'gradsearch.php',
    //         data: formdata,
    //         cache: false,
    //         contentType: false,
    //         processData: false,

    //         success: function(response) {
    //             console.log(response);
    //             var data = JSON.parse(response);
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
    //                     var button = "<button onclick='details(\"" + index + "\")'>View Details</button>";
    //                 }


    //                 html += "<tr><td>" + a + "</td><td>" + index + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + graddate + "</td><td>" + iss_date + "</td><td>" + button + "</td></tr>";
    //             }
    //             document.getElementById("cert_bdy").innerHTML = html;
    //             $("#cert_table").DataTable();
    //             $("#gradForm").trigger('reset');
    //             $("#gradSearch").modal('hide');
    //         }
    //     })
    // })
}

function issue_disp(id) {
    $.ajax({
        type: 'POST',
        url: 'final_issue.php',
        data: 'id=' + id,

        success: function(json) {
            //console.log(json);
            $("#cert_detail").modal('show');
            document.getElementById("issue_btn").style.disabled = true;
            var data = JSON.parse(json);

            if (data.length == 0) {
                // alert("Gown Not Taken");
                $("#disp_status").html("Gown Not Taken");
                document.getElementById("issue_btn").style.disabled = false;
            } else if (data.length > 0) {
                // var data = JSON.parse(json);
                for (var i = 0; i < data.length; i++) {
                    var status = data[i].status;

                    if (status == 0) {
                        $("#disp_status").html("Gown Not Returned");
                        document.getElementById("issue_btn").style.disabled = true;
                    } else if (status == 1) {
                        $("#disp_status").html("Gown Returned");
                        document.getElementById("issue_btn").style.disabled = false;
                    }
                }
            } else {
                new PNotify({
                    title: 'ERROR',
                    text: 'Not Graduate',
                    type: 'info',
                    styling: 'bootstrap3'
                })
                document.getElementById("issue_btn").style.disabled = true;
            }
        }
    })
}



$(document).ready(function() {
    // load_data();
})