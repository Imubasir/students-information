$(document).ready(function() {
    $.ajax({
        url: '../source.php',

        success: function(e) {
            var data = JSON.parse(e);


            var source = new Array();
            for (var i = 0; i < data.length; i++) {

                source.push(data[i].first_name + " " + data[i].middle_name) + " " + data[i].last_name;
            }
            var uniq = Array.from(new Set(source));

            //console.log(source.toString());
            $("#to").tagging(uniq);
        }
    });
});

$("#composeBtn").on('click', function() {
    $(".compose").slideToggle();
})

function load_mails_content(id) {
    $.ajax({
        type: 'POST',
        url: 'load_mail.php',
        data: 'id=' + id,

        success: function(response) {
            //console.log(response);
            var data = JSON.parse(response);
            var html = '';

            for (var i = 0; i < data.length; i++) {
                var source = data[i].sender;
                var s_id = data[i].id;
                var subj = data[i].subject;
                var issue = data[i].message;
                var date = moment(data[i].date).fromNow();

                document.getElementById("content").innerHTML = issue;
                document.getElementById("source").innerHTML = source;
                document.getElementById("subject").innerHTML = subj;
                document.getElementById("date").innerHTML = date;
            }
        }
    })
}

$("#send").unbind('click').on('click', function() {
    var mess = $("#editor").html();
    var receipt = $("#to").val();
    var subj = $("#subject").val();

    $.ajax({
        type: 'POST',
        url: 'message.php',
        data: 'key=' + receipt + '&value=' + mess + '&subj=' + subj,

        success: function(resp) {
            if (resp == '1') {
                new PNotify({
                    title: 'Success',
                    text: 'Message Sent',
                    type: 'success',
                    styling: 'bootstrap3'
                });

                document.getElementById("editor").html = '';
                document.getElementById("to").value = '';
                document.getElementById("subject").value = '';
            } else {
                new PNotify({
                    title: 'Error',
                    text: resp,
                    type: 'error',
                    styling: 'bootstrap3'
                });
            }
        }
    })
});

$(".reply").on('click', function() {
    $(".compose_reply").slideToggle();

    $("#send_reply").unbind('click').on('click', function() {

        var prep = "Reply to: ";
        var sub = prep.concat($("#subject").html());
        var send = $("#source").html();
        var rep = $('#reply_editor').html();
        if (send == '') {

        } else {
            $.ajax({
                type: 'POST',
                url: 'message.php',
                data: 'key=' + send + '&subj=' + sub + '&value=' + rep,

                success: function(resp) {
                    if (resp == '1') {
                        new PNotify({
                            title: 'Success',
                            text: 'Message Sent',
                            type: 'success',
                            styling: 'bootstrap3'
                        });

                    } else {
                        new PNotify({
                            title: 'Error',
                            text: resp,
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                }
            });
        }
    })
});

$(".reply_close").on('click', function() {
    $(".compose_reply").slideToggle();
});