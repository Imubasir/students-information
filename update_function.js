$(document).ready(function () {
    update_student_biodata("20022842,MW/2132/20,100");
})

function update_student_biodata(std_ids) {
    var values = std_ids.split(",");
    var uin = values[0];
    var index = values[1];
    var level = values[2];

    var formdata = new FormData();
    formdata.append("uin", uin);
    formdata.append("index", index);
    formdata.append("level", level);

    $.ajax({
        type: 'POST',
        url: 'update_biodata.php',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,

        success: function (response) {
            console.log(response);
        }
    })
}
