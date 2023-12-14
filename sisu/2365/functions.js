$(document).ready(function() {
    load_announce();
});

function load_announce () {
    $.ajax({
        url: 'announce.php',
        
        success:function(resp) {
            var data = JSON.parse(resp);
            var html = '';
            
            for(var i = 0; i<data.length; i++) {
                var cat = data[i].category;
                var header = data[i].header;
                var content = data[i].content;
                var upload_by = data[i].uploaded_by;
                var upload_date = moment(data[i].upload_date).format("DD MMM YYYY");
                
                html += "<li><div class='block'><div class='tags'><a href='' class='tag'><span>"+cat+"</span></a></div><div class='block_content'><h2 class='title'><a>"+header+"</a></h2><div class='byline'><span>"+upload_date+"</span> by <a>"+upload_by+"</a></div><p class='excerpt'>"+content+"</p></div></div></li>";
            }
            document.getElementById("timeline").innerHTML = html;
        }
    })
}