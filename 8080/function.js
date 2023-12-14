function search_data() {
    var id = $("#sid").val();

    if (id == '') {

    } else {
        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: 'id=' + id,

            success: function(json) {
                console.log(json);
                if (json == '0') {
                    $("#status").html("Record Not Found");
                    $("#indexno").html("");
                    $("#name").html("");
                    $("#prog").html("");
                    $("#campus").html("");
                    $("#dept").html("");
                    $("#option").html("");

                    $("#mod_span").html("");
                    localStorage.setItem("status", "");
                } else {

                    // console.log(json);
                    var data = JSON.parse(json);
                    for (var i = 0; i < data.length; i++) {
                        var indexno = data[i].indexno;
                        var uin = data[i].uin;
                        var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                        var prog = data[i].progname;
                        var campus = data[i].campus_descr;
                        var dept = data[i].deptname;
                        var option = data[i].option_title;
                        if(data[i].date_modified) {
                            var mod_date = moment(data[i].date_modified).format("DD-MMM-YYYY HH:mm:ss");
                        } else {
                            var mod_date = '';
                        }


                        $("#indexno").html(indexno);
                        $("#name").html(name);
                        $("#prog").html(prog);
                        $("#campus").html(campus);
                        $("#dept").html(dept);
                        $("#option").html(option);
                        var modif_date = "<br><span id='mod_span'><span style='color:black;font-size:14px;font-weight:bold;'>Last Date Modified:</span><br> " + mod_date + "</span> ";
                        $("#modified_date").html(modif_date);

                        $("#status").html("Record Found");
                        localStorage.setItem("status", uin);
                        $("#editBtn").unbind('click').on('click', function(){
                            ug_editBiodata(uin);
                        })

                    }
                }
            }
        })
    }

}

function ug_editBiodata(id) {
    $("#ug_editModal").modal('show');

    var status = localStorage.getItem("status");
    var status = id;

    if (status != "") {
        $.ajax({
            type: 'POST',
            url: 'load_data.php',
            data: 'id=' + status,

            success: function(json) {
                alert(json);
                var data = JSON.parse(json);
                for (var i = 0; i < data.length; i++) {
                    var indexno = data[i].indexno;
                    var uin = data[i].uin;
                    var surname = data[i].surname;
                    var mname = data[i].middlename;
                    var fname = data[i].firstname;
                    var gender = data[i].gender;
                    var dob = data[i].dob;
                    // var dob = moment(data[i].dob).format("DD-MMM-YYYY");
                    var pob = data[i].pob;
                    var htown = data[i].htown;
                    var region = data[i].regionid;
                    var homeaddress = data[i].homeaddress;
                    var fonnumber = data[i].fonnumber;
                    var disability_status = data[i].disability_status;
                    var disability_descr = data[i].disability_descr;
                    var guardian_name = data[i].guardian_name;
                    var guardian_address = data[i].guardian_address;
                    var progid = data[i].sprogid;
                    var entryyear = data[i].entryyear;
                    var entrylevel = data[i].entrylevel;
                    var currentlevel = data[i].currentlevel;
                    var option = data[i].option_id;
                    var nationality = data[i].nationality;
                    var qualification_status = data[i].qualification_status;
                    var username = data[i].username;
                    var inst_mail = data[i].inst_mail;
                    var password = data[i].password;
                    var pic_id = data[i].pic_id;
                    var study_status = data[i].study_status;
                    var fee_category = data[i].fee_category;
                    var admn_category = data[i].admission_category;

                    document.getElementById("edit_indexno").value = indexno;
                    document.getElementById("uin").value = uin;
                    document.getElementById("sname").value = surname;
                    document.getElementById("mname").value = mname;
                    document.getElementById("fname").value = fname;
                    document.getElementById("gender").value = gender;
                    document.getElementById("dob").value = dob;
                    document.getElementById("pob").value = pob;
                    document.getElementById("htown").value = htown;
                    document.getElementById("rob").value = region;
                    document.getElementById("homeaddress").value = homeaddress;
                    document.getElementById("fonnumber").value = fonnumber;
                    document.getElementById("disability_status").value = disability_status;
                    document.getElementById("disability_descr").value = disability_descr;
                    document.getElementById("guardian_name").value = guardian_name;
                    document.getElementById("guardian_address").value = guardian_address;
                    document.getElementById("sprogid").value = progid;
                    document.getElementById("entryyear").value = entryyear;
                    document.getElementById("entrylevel").value = entrylevel;
                    document.getElementById("currentlevel").value = currentlevel;
                    document.getElementById("edit_option").value = option;
                    document.getElementById("nationality").value = nationality;
                    document.getElementById("qualification_status").value = qualification_status;
                    document.getElementById("username").value = username;
                    document.getElementById("inst_mail").value = inst_mail;
                    document.getElementById("study_status").value = study_status;
                    document.getElementById("fee_category").value = fee_category;
                    document.getElementById("admn_category").value = admn_category;
                }

                $("#defer_btn").unbind('click').on('click', function() {
                    defer(status);
                })

                $("#suspend_btn").unbind('click').on('click', function() {
                    suspend(status);
                })

                $("#withdraw_btn").unbind('click').on('click', function() {
                    withdraw(status);
                })

                $("#delete_btn").unbind('click').on('click', function() {
                    del(status);
                })
                // $("#ug_editModal").modal('hide');
            }
        })
    } else {

    }
}
/** --------------------------------------------------------------------------**/
/** POSTGRADUATE FUNCTIONS **/
/** --------------------------------------------------------------------------**/

function pg_search_data() {
    var pg_id = $("#pg_sid").val();

    if (pg_id == '') {

    } else {
        $.ajax({
            type: 'POST',
            url: 'pg_search.php',
            data: 'id=' + pg_id,

            success: function(json) {
                // console.log(json);
                if (json == '0') {
                    $("#pg_status").html("Record Not Found");
                    $("#pg_indexno").html("");
                    $("#pg_name").html("");
                    $("#pg_prog").html("");
                    $("#pg_campus").html("");
                    $("#pg_dept").html("");
                    $("#pg_option").html("");

                    $("#pg_mod_span").html("");
                    localStorage.setItem("pg_status", "");
                } else {

                    //console.log(json);
                    var data = JSON.parse(json);
                    for (var i = 0; i < data.length; i++) {
                        var indexno = data[i].indexno;
                        var uin = data[i].uin;
                        var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                        var prog = data[i].progname;
                        var campus = data[i].campus_descr;
                        var dept = data[i].deptname;
                        var option = data[i].option_title;
                        if (data[i].date_modified == null) {
                            var mod_date = "Not Yet";
                        } else {
                            var mod_date = moment(data[i].date_modified).format("DD-MMM-YYYY");

                        }


                        $("#pg_indexno").html(indexno);
                        $("#pg_name").html(name);
                        $("#pg_prog").html(prog);
                        $("#pg_campus").html(campus);
                        $("#pg_dept").html(dept);
                        $("#pg_option").html(option);
                        var modif_date = "<br><span id='pg_mod_span'><span style='color:black;font-size:14px;font-weight:bold;'>Last Date Modified:</span><br> " + mod_date + "</span> ";
                        $("#pg_modified_date").html(modif_date);

                        $("#pg_status").html("Record Found");
                        localStorage.setItem("pg_status", uin);

                    }


                }

            }
        })
    }

}

function pg_editBiodata() {

    var status = localStorage.getItem("pg_status");

    if (status != "") {
        $("#pg_editModal").modal('show');

        $.ajax({
            type: 'POST',
            url: 'pg_load_data.php',
            data: 'id=' + status,

            success: function(json) {
                console.log(json);
                var data = JSON.parse(json);
                for (var i = 0; i < data.length; i++) {
                    var indexno = data[i].indexno;
                    var uin = data[i].uin;
                    var surname = data[i].surname;
                    var mname = data[i].middlename;
                    var fname = data[i].firstname;
                    var gender = data[i].gender;
                    var dob = moment(data[i].dob).format("DD-MMM-YYYY");
                    var pob = data[i].pob;
                    var htown = data[i].htown;
                    var region = data[i].regionname;
                    var homeaddress = data[i].homeaddress;
                    var fonnumber = data[i].fonnumber;
                    var disability_status = data[i].disability_status;
                    var disability_descr = data[i].disability_descr;
                    var guardian_name = data[i].guardian_name;
                    var guardian_address = data[i].guardian_address;
                    var progid = data[i].sprogid;
                    var entryyear = data[i].entryyear;
                    var entrylevel = data[i].entrylevel;
                    var currentlevel = data[i].currentlevel;
                    var option = data[i].option_id;
                    var nationality = data[i].nationality;
                    var qualification_status = data[i].qualification_status;
                    var username = data[i].username;
                    var inst_mail = data[i].inst_mail;
                    var password = data[i].password;
                    var pic_id = data[i].pic_id;
                    var study_status = data[i].study_status;

                    document.getElementById("pg_edit_indexno").value = indexno;
                    document.getElementById("pg_uin").value = uin;
                    document.getElementById("pg_sname").value = surname;
                    document.getElementById("pg_mname").value = mname;
                    document.getElementById("pg_fname").value = fname;
                    document.getElementById("pg_gender").value = gender;
                    document.getElementById("pg_dob").value = dob;
                    document.getElementById("pg_pob").value = pob;
                    document.getElementById("pg_htown").value = htown;
                    document.getElementById("pg_rob").value = region;
                    document.getElementById("pg_homeaddress").value = homeaddress;
                    document.getElementById("pg_fonnumber").value = fonnumber;
                    document.getElementById("pg_disability_status").value = disability_status;
                    document.getElementById("pg_disability_descr").value = disability_descr;
                    document.getElementById("pg_guardian_name").value = guardian_name;
                    document.getElementById("pg_guardian_address").value = guardian_address;
                    document.getElementById("pg_sprogid").value = progid;
                    document.getElementById("pg_entryyear").value = entryyear;
                    document.getElementById("pg_entrylevel").value = entrylevel;
                    document.getElementById("pg_currentlevel").value = currentlevel;
                    document.getElementById("pg_edit_option").value = option;
                    document.getElementById("pg_nationality").value = nationality;
                    document.getElementById("pg_qualification_status").value = qualification_status;
                    document.getElementById("pg_username").value = username;
                    document.getElementById("pg_inst_mail").value = inst_mail;
                    document.getElementById("pg_study_status").value = study_status;
                }
            }
        })
    } else {

    }
}

function ug_update() {
    var form = document.querySelector("#ug_edit_form");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'ug_update.php',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,

        success: function(response) {
            if (response == "1") {
                new PNotify({
                    title: 'Success',
                    text: 'Record Updated',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $("#ug_editModal").modal('hide');
            } else {
                new PNotify({
                    title: 'Eror',
                    text: response,
                    type: 'error',
                    styling: 'bootstrap3'

                })
            }
        }
    })
}

function pg_update() {
    var form = document.querySelector("#pg_edit_form");
    var formdata = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'pg_update.php',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,

        success: function(response) {
            console.log(response);
            if (response == "1") {
                new PNotify({
                    title: 'Success',
                    text: 'Record Updated',
                    type: 'success',
                    styling: 'bootstrap3'

                })
            } else {
                new PNotify({
                    title: 'Eror',
                    text: response,
                    type: 'error',
                    styling: 'bootstrap3'

                })
            }
        }
    })
}

// Student Deferral
function defer(id) {
    // $("#actionModal").modal('show');
    document.getElementById("hide_date").style.display = 'block';

    $.ajax({
        type: 'POST',
        url: 'action_data.php',
        data: 'id=' + id,

        success: function(response) {

            //console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var study_status = data[i].study_status;
                var name = data[i].name;
                var prog = data[i].progname;
                var startd = data[i].startDate;
                var endd = data[i].endDate;
                var index = data[i].indexno;
                var date = data[i].date;
            }
            if (study_status == '') {
                study_status = "Unknown";
            }
            if (study_status != 'Deferred' && study_status != 'On-Going' && study_status != "GRADUATED" && study_status != "Unknown") {
                new PNotify({
                    title: "Deferral Failed",
                    text: "Student is Currently " + study_status + ". \n Please Re-Enroll to Continue With Current Action",
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else if (study_status == "GRADUATED") {
                new PNotify({
                    title: "Deferral Failed",
                    text: "Student is Currently " + study_status,
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else {
                if (study_status == "Deferred") {

                    $("#con_Action_Modal").modal('show');
                    $("#con_sid").html(index + " - " + name);
                    $("#con_prog").html(prog);
                    $("#startDate").html(startd);
                    $("#endDate").html(endd);
                    $(".con_status").html(study_status);

                    $("#confirmBtn").unbind('click').on('click', function() {
                        var reason = $("#reason").val();
                        $.ajax({
                            type: 'POST',
                            url: 'resumption.php',
                            data: 'id=' + id + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Re-Enrolled",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#con_Action_Modal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Re-Enrollment Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });

                } else {
                    $("#actionModal").modal('show');
                    $("#act_sid").html(index + " - " + name);
                    $("#act_prog").html(prog);
                    $("#cur_status").html(study_status);
                    $("#action_title").html("Deferral");

                    $("#processBtn").unbind('click').on('click', function() {
                        var reason = $("#action_reason").val();
                        var start = $("#start").val();
                        var end = $("#end").val();
                        if (start == '' && end == '') {
                            new PNotify({
                                title: "Error",
                                text: "Duration Not Stated",
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: 'process_deferral.php',
                                data: 'id=' + id + '&reason=' + reason + '&index=' + index + '&start=' + start + '&end=' + end,

                                success: function(json) {
                                    if (json == "1") {
                                        new PNotify({
                                            title: "Success",
                                            text: "Student Deferred",
                                            type: 'success',
                                            styling: 'bootstrap3'
                                        })
                                        $("#actionModal").modal('hide');
                                    } else {
                                        new PNotify({
                                            title: "Error",
                                            text: "Deferral Error" + json,
                                            type: 'error',
                                            styling: 'bootstrap3'
                                        })
                                    }
                                }
                            });
                        }

                    });
                }
            }
        }
    })
}

// Student Suspension
function suspend(id) {
    document.getElementById("hide_date").style.display = 'block';
    $.ajax({
        type: 'POST',
        url: 'action_data.php',
        data: 'id=' + id,

        success: function(response) {

            //console.log(response);
            var data = JSON.parse(response);
            for (var i = 0; i < data.length; i++) {
                var study_status = data[i].study_status;
                var name = data[i].name;
                var prog = data[i].progname;
                var startd = data[i].startDate;
                var endd = data[i].endDate;
                var index = data[i].indexno;
                var date = data[i].date;
            }
            if (study_status == '') {
                study_status = "Unknown";
            }
            if (study_status != 'Suspended' && study_status != 'On-Going' && study_status != "GRADUATED" && study_status != "Unknown") {
                new PNotify({
                    title: "Suspension Failed",
                    text: "Student is Currently " + study_status + ". \n Please Re-Enroll to Continue With Current Action",
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else if (study_status == "GRADUATED") {
                new PNotify({
                    title: "Suspension Failed",
                    text: "Student is Currently " + study_status,
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else {
                if (study_status == "Suspended") {

                    $("#con_Action_Modal").modal('show');
                    $("#con_sid").html(index + " - " + name);
                    $("#con_prog").html(prog);
                    $("#startDate").html(startd);
                    $("#endDate").html(endd);
                    $(".con_status").html(study_status);

                    $("#confirmBtn").unbind('click').on('click', function() {
                        $.ajax({
                            type: 'POST',
                            url: 'resumption.php',
                            data: 'id=' + id + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Re-Enrolled",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#con_Action_Modal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Re-Enrollment Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });

                } else {
                    $("#actionModal").modal('show');
                    $("#act_sid").html(index + " - " + name);
                    $("#act_prog").html(prog);
                    $("#status").html(study_status);
                    $("#action_title").html("Suspension");

                    $("#processBtn").unbind('click').on('click', function() {
                        var reason = $("#reason").val();
                        var start = $("#start").val();
                        var end = $("#end").val();

                        if (start == '' && end == '') {
                            new PNotify({
                                title: "Error",
                                text: "Duration Not Stated",
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: 'process_suspension.php',
                                data: 'id=' + id + '&reason=' + reason + '&index=' + index + '&start=' + start + '&end=' + end,

                                success: function(json) {
                                    if (json == "1") {
                                        new PNotify({
                                            title: "Success",
                                            text: "Student Suspended",
                                            type: 'success',
                                            styling: 'bootstrap3'
                                        })
                                        $("#actionModal").modal('hide');
                                    } else {
                                        new PNotify({
                                            title: "Error",
                                            text: "Deferral Error \n" + json,
                                            type: 'error',
                                            styling: 'bootstrap3'
                                        })
                                    }
                                }
                            });
                        }

                    });
                }
            }
        }
    })
}


// Student Withdrawal
function withdraw(id) {
    // $("#hide_date").style.display = 'none';
    document.getElementById("hide_date").style.display = 'none';
    $.ajax({
        type: 'POST',
        url: 'action_data.php',
        data: 'id=' + id,

        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            for (var i = 0; i < data.length; i++) {
                var study_status = data[i].study_status;
                var name = data[i].name;
                var prog = data[i].progname;
                var index = data[i].indexno;
                var date = data[i].date;
            }
            if (study_status == 'GRADUATED') {
                new PNotify({
                    title: "Suspension Failed",
                    text: "Student is Currently " + study_status,
                    type: 'info',
                    styling: 'bootstrap3'
                });
            } else {

                if (study_status == "Withdrawn") {

                    $("#con_Action_Modal").modal('show');


                    $("#con_sid").html(index + " - " + name);
                    $("#con_prog").html(prog);
                    $(".con_status").html(study_status);

                    $("#confirmBtn").unbind('click').on('click', function() {
                        $.ajax({
                            type: 'POST',
                            url: 'resumption.php',
                            data: 'id=' + id + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Re-Enrolled",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#con_Action_Modal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Re-Enrollment Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });

                } else {
                    $("#actionModal").modal('show');
                    $("#act_sid").html(index + " - " + name);
                    $("#act_prog").html(prog);
                    $("#status").html(study_status);
                    $("#action_title").html("Withdrawal");

                    $("#processBtn").unbind('click').on('click', function() {
                        var reason = $("#reason").val();
                        $.ajax({
                            type: 'POST',
                            url: 'process_withdrawal.php',
                            data: 'id=' + id + '&reason=' + reason + '&index=' + index,

                            success: function(json) {
                                if (json == "1") {
                                    new PNotify({
                                        title: "Success",
                                        text: "Student Withdrawn",
                                        type: 'success',
                                        styling: 'bootstrap3'
                                    })
                                    $("#actionModal").modal('hide');
                                } else {
                                    new PNotify({
                                        title: "Error",
                                        text: "Withdrawal Error \n" + json,
                                        type: 'error',
                                        styling: 'bootstrap3'
                                    });
                                }
                            }
                        });
                    });
                }
            }
        }
    })
}

function del(id) {
    $("#confirm").modal('show');

    $("#confirm_btn").unbind('click').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'delete.php',
            data: 'student_id=' + id,

            success: function(response) {
                if (response == 1) {
                    new PNotify({
                        title: "Success",
                        text: "Record Deleted",
                        type: 'success',
                        styling: 'bootstrap3'
                    })
                } else {
                    new PNotify({
                        title: "Error",
                        text: response,
                        type: 'error',
                        styling: 'bootstrap3'
                    })
                }
            }
        })
    })
}

$(document).ready(function() {
    localStorage.setItem("pg_status", "");
    localStorage.setItem("ug_status", "");
})