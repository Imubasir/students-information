if (window.IsDuplicate()) {
    alert("This is duplicate window\n\n Closing...");
    window.close();
}

$(document).ready(function() {




    getDate();
    // mcount();
    // tcount();
    // tasknot();
    // mnot();
    // checkTimeOut();

    // setInterval("mcount()", 5000);
    // setInterval("tcount()", 5000);
    // setInterval("tasknot()", 5000);
    // setInterval("mnot()", 5000);
    // setInterval("checkTimeOut()", 900);
});


function getDate() {
    var date = new Date();
    document.getElementById("footerDate").innerHTML = "University for Develoment Studies &copy;" + date.getFullYear();
}

function keep_open(ids) {
    var id = ids.split(",");
    for (var i = 0; i < id.length; i++) {
        var id1 = id[0];
        var id2 = id[1];
    }

    $('.' + id2).click();

    $('.' + id1).on({
        "shown.bs.dropdown": function() { $(this).attr('closable', false); },
        //"click":             function() { }, // For some reason a click() is sent when Bootstrap tries and fails hide.bs.dropdown
        "hide.bs.dropdown": function() { return $(this).attr('closable') == 'true'; }
    });

    $('.' + id1).children().first().on({
        "click": function() {
            $(this).parent().attr('closable', true);
        }
    })
}

function logout() {

    $.ajax({
        type: 'POST',
        url: '../php/logout.php',

        success: function(response) {
            if (response == 1) {
                $("#logoutModal").modal('hide');
                window.location.href = '../';
            } else {
                new PNotify({
                    title: 'Error...Log Out Failed',
                    text: response,
                    type: 'error',
                    styling: 'bootstrap3'
                })
            }
        }
    })
}

function mcount() {
    $.ajax({
        url: '../php/messagecount.php',

        success: function(response) {
            if (response == 0) {

            } else {

                document.getElementById("mcount").innerHTML = response;
            }
        }
    })
}

function tcount() {
    $.ajax({
        url: '../php/taskcount.php',

        success: function(response) {
            if (response == 0) {

            } else {

                document.getElementById("tcount").innerHTML = response;
            }
        }
    })
}

function mnot() {
    $.ajax({
        url: '../php/messagenot.php',

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            var html = '';
            for (var i = 0; i < data.length; i++) {
                var source = data[i].source;
                var subject = data[i].subject;

                html += "<a class='dropdown-item'>" + subject + ". From:" + source + "</a>"
            }

            if (data == '') {
                document.getElementById("messageBox").innerHTML = "<a class='dropdown-item'>No Notifications to Show</a>";
            } else {
                document.getElementById("messageBox").innerHTML = html;
            }
        }
    })
}

function tasknot() {
    $.ajax({
        url: '../php/tasknot.php',

        success: function(response) {

            var data = JSON.parse(response);
            var html = '';
            for (var i = 0, b = 1; i < data.length, b < data.length + 1; i++, b++) {
                var todo = data[i].todo;

                html += "<a class='dropdown-item'>Task " + b + " : " + todo + "</a>"
            }

            if (data == '') {
                document.getElementById("taskBox").innerHTML = "<a class='dropdown-item'>No Tasks to show</a>";
            } else {
                document.getElementById("taskBox").innerHTML = html;
            }
        }
    })
}

function checkTimeOut() {
    $.ajax({
        url: '../php/checktimeout.php',

        success: function(response) {
            if (response == 1) {
                window.location.href = '../';
            }
        }
    })
}

function getBalance(id) {
    var values = id.split(",");
    var indexno = values[0];
    var uin = values[1];

    var value = '';
    $.ajax({
        async: false,
        type: 'POST',
        url: '../php/getBalance.php',
        data: 'indexno=' + id + '&uin=' + uin,

        success: function(response) {
            value = response;
        }
    })
    return value;
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}