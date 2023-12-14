$(document).ready(function() {
	// $("#query_tbl").DataTable();
	load_prog();
})

function search() {
	$("#searchBtn").html("Processing...");
	var formdata = new FormData(document.querySelector("#searchForm"));

	$.ajax({
		type: 'POST',
		url: 'search.php',
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,

		success: function(json) {
			$("#searchBtn").html("Search");
			// console.log(json);
			var data = JSON.parse(json);
			var html = "";
			var printout = "";
			for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
				var studentid = data[i].indexno;
				var uin = data[i].uin;
				var certno = data[i].certno;
				if (data[i].middlename == '') {
					var name = data[i].firstname + "  " + data[i].surname;
				} else {
					var name = data[i].firstname + " " + data[i].middlename + " " + data[i].surname;
				}
				var prog = data[i].progname;
				var gradclass = data[i].gradclass;
				var graddate = data[i].graddate;
				var qual = data[i].qualification_status;
				var gradyear = "November 2022";
				var gradday = "30th";
				var category = "Bachelor of Science";

				html += "<tr><td>" + a + "</td><td>" + studentid + "</td><td>" + uin + "</td><td>" + certno + "</td><td>" + name + "</td><td>" + prog + "</td><td>" + gradclass + "</td><td>" + graddate + "</td><td>" + qual + "</td><td><button onclick='print(\"" + uin + "\");' class='btn btn-sm btn-info'><i class='fa fa-print'></i> Print</button></td></tr>";

				printout += '<div class="page-break-before: always;"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><p id="certName" class="style1" style="text-align:center;font-size:50px;word-break:keep-all;">' + name + '</p><br><br><p id="certYear" class="style2" style="margin-left:55%;font-size:50px;">' + graddate + '</p><br><br><br><h1 style="display:absolute;text-align:center;font-size:65px;font-family:Batang;color:#989898;margin-top:20px;">' + category + '</h1><br><br><div style="margin-top:-20px;"></div><p id="certProgramme" style="text-align:center;font-family:BodoniMT;font-size:55px;">' + prog + '</p><p id="certClass" style="text-align:center;font-family:BodoniMT;font-size:45px;margin-top:-8px;">' + gradclass + '</p><p id="certDay" class="style2" style="text-align:center;margin-left:20%;font-size:50px;margin-top:-10px;">' + gradday + '</p><p id="certMonth" class="style3" style="text-align:center;margin-left:20%;font-size:50px;margin-top:-20px;font-weight:bold;">' + gradyear + '</p><p id="certUIN" class="style4">' + uin + '</p><img src="../images/registrar.png" style="width:35%;margin-top:-25px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/vc.png" style="display:inline;width:40%;margin-top:-25px;"><div class="page-break-after:always;"></div></div>';
			}
			$("#query_body").html(html);
			$("#query_tbl").DataTable();
			$("#printCert").html(printout);
		}

	})
}

function load_prog() {
	$.ajax({
		url: 'load_prog.php',

		success: function(json) {
			var data = JSON.parse(json);
			var option = "<option selected disabled>Select Programme</option>";
			for (var i = 0; i < data.length; i++) {
				var id = data[i].progid;
				var progname = data[i].progname;

				option += "<option value = '" + id + "'>" + progname + "</option>";
			}
			$("#prog_id").html(option);
		}
	})
}

function printCert() {
	printJS({
		printable: 'printCert',
		type: 'html',
		targetStyles: ['*'],
		documentTitle: '',
		css: ["../vendor/datatables/dataTables.bootstrap4.css", "../vendor/fontawesome-free/css/all.min.css", "../vendor/bootstrap/css/bootstrap.min.css", "certStyle.css"]
	})
}

function printAll() {

}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}