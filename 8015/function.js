$(document).ready(function () {
    load_data();
});

function load_data () {
    $("#logTable").dataTable().fnDestroy();
    $.ajax({
        url: 'load_data.php',
        
        success: function(response) {
            var data = JSON.parse(response);
            var html = '';
            
            for(var i = 0,a = 1; i<data.length, a<data.length+1; i++, a++) {
                var event = data[i].event;
                var time = moment(data[i].ttime).format("DD MMM YYYY H:m:s");
                var username = data[i].username;
                
                html += "<tr><td>"+a+"</td><td>"+event+"</td><td>"+username+"</td><td>"+time+"</td></tr>";
            }
            document.getElementById("logBody").innerHTML = html;
            $("#logTable").DataTable({
                dom: 'Bfrtip',
                    buttons: [{
                            extend: 'pdf',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                        },
                        {
                            extend: 'excel',
                        }
                    ]
            });
        }
    })
}