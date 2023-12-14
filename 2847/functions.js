$(document).ready(function () {
    document.getElementById("std_cat").addEventListener("change", function () {
        var cat_value = $("#std_cat").val();
        load_programme(cat_value);
    })
})

function search() {
    var formdata = new FormData(document.querySelector("#searchForm"));
    if (!$("#std_cat").val()) {
        new PNotify({
            title: 'Notice',
            text: 'Select Category',
            type: 'notice',
            styling: 'bootstrap3'
        })
        return;
    }
    $("#searchBtn").html("Loading <img src='../images/ellipse.gif' height='20px' width='30px'>");
    $.ajax({
        type: 'POST',
        url: 'gradsearch.php',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,

        success: function (json) {
            console.log(json);
            var data = JSON.parse(json);
            if (data == '') {
                new PNotify({
                    title: 'Notice',
                    text: 'No Record Found',
                    type: 'notice',
                    styling: 'bootstrap3'
                })
                $("#searchBtn").html("<i class='fa fa-search'></i>  Search");
            } else {
                document.getElementById("body1").style.display = "none";
                document.getElementById("body2").style.display = "block";
                document.getElementById("body3").style.display = "none";

                var html = "";
                for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
                    var indexno = data[i].indexno;
                    var certno = data[i].certno;
                    var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
                    var progname = data[i].progname;
                    var graddate = data[i].graddate;
                    var isIsued = data[i].issued;

                    if (isIsued == 0) {
                        var issued = "Not Issued";
                    } else if (isIsued == 1) {
                        var issued = "Issued";
                    }

                    var btn = "<button class='btn btn-sm btn-success' onclick='issuance(\"" + indexno + "\")'>Click to Issue</button>";

                    html += "<tr><td>" + a + "</td><td>" + indexno + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + progname + "</td><td>" + graddate + "</td><td>" + issued + "</td><td>" + btn + "</td></tr>";
                }

                $("#search_results").html(html);
                $("#search_table").DataTable();
                $("#searchBtn").html("<i class='fa fa-search'></i>  Search");
            }
        }
    })
}


function load_programme(val) {
    $.ajax({
        type: 'POST',
        url: 'load_programme.php',
        data: 'value=' + val,

        success: function (json) {
            var option = "<option>Select Programme</option>";
            var data = JSON.parse(json);

            for (var i = 0; i < data.length; i++) {
                var progname = data[i].progname;
                var progid = data[i].progid;

                option += "<option value = '" + progid + "'>" + progname + "</option>";
            }

            $("#std_prog").html(option);
        }
    })
}

function issuance(id) {
    document.getElementById("body1").style.display = "none";
    document.getElementById("body2").style.display = "none";
    document.getElementById("body3").style.display = "block";

}

function bckHome() {
    document.getElementById("body1").style.display = "block";
    document.getElementById("body2").style.display = "none";
    document.getElementById("body3").style.display = "none";
}

function bckSearch() {
    document.getElementById("body1").style.display = "none";
    document.getElementById("body2").style.display = "block";
    document.getElementById("body3").style.display = "none";
}
