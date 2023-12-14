$(document).ready(function() {
	// load_programme();
	// load_faculty();
	// load_campus();
	load_entry_year();
})

function load_entry_year() {
	$.ajax({
		url: 'load_entryyear.php',

		success: function(json) {
			console.log(json);
			var data = JSON.parse(json);
			var option = "<option selected='' disabled=''>Select Entry Year</option>";
			for (var i = 0; i < data.length; i++) {
				var year = data[i].entryyear;

				option += "<option value = '" + year + "'>" + year + "</option>";
			}
			$("#year").html(option);
		}
	})
}

function load_programme() {
	$.ajax({
		url: 'load_programme.php',

		success: function(json) {
			console.log(json);
			var data = JSON.parse(json);
			var option = "<option disabled selected>Select Programme</option>";
			for (var i = 0; i < data.length; i++) {
				var prog = data[i].progname;
				var progid = data[i].progid;

				option += "<option value = '" + progid + "'>" + prog + "</option>";
			}
			$("#programme").html(option);
		}
	})
}

function load_faculty() {
	$.ajax({
		url: 'load_faculty.php',

		success: function(json) {
			var data = JSON.parse(json);
			var option = "<option disabled selected>Select Faculty</option>";
			for (var i = 0; i < data.length; i++) {
				var fac = data[i].facultyname;
				var facid = data[i].facultyid;

				option += "<option value = '" + facid + "'>" + fac + "</option>";
			}
			$("#faculty").html(option);
		}
	})
}

function load_campus() {
	$.ajax({
		url: 'load_campus.php',

		success: function(json) {
			var data = JSON.parse(json);
			var option = "<option disabled selected>Select Campus</option>";
			for (var i = 0; i < data.length; i++) {
				var campus = data[i].campus_descr;
				var campusid = data[i].campus_id;

				option += "<option value = '" + campusid + "'>" + campus + "</option>";
			}
			$("#campus").html(option);
		}
	})
}

function generate_data() {
	var formdata = new FormData(document.querySelector("#search_form"));

	$.ajax({
		type: 'POST',
		url: 'generate.php',
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,

		success: function(json) {
			console.log(json);
			var html = "";
			// var data = JSON.parse(json);
			// for (var i = 0, a=1; i < data.length,a<data.length+1; i++,a++) {
			// data[i].uin;
			// data[i].surname;
			// data[i].middlename;
			// data[i].firstname;
			// data[i].gender;
			// data[i].dob;
			// data[i].pob;
			// data[i].htown;
			// data[i].rob;
			// data[i].religion;
			// data[i].denomination;
			// data[i].homeaddress;
			// data[i].fonnumber;
			// data[i].guardian_contact;
			// data[i].disability_status;
			// data[i].disability_descr;
			// data[i].guardian_name;
			// data[i].guardian_address;
			// data[i].relation_guardian;
			// data[i].occupation_guardian;
			// data[i].sponsor;
			// data[i].sprogid;
			// data[i].entryyear;
			// data[i].entrylevel;
			// data[i].currentlevel;
			// data[i].option_id;
			// data[i].nationality;
			// data[i].qualification_status;
			// data[i].study_status;
			// data[i].study_duration;
			// data[i].admission_category;
			// data[i].fee_category;
			// data[i].residence_status;
			// data[i].first_choice;
			// data[i].second_choice;
			// data[i].third_choice;

			html += "<tr><td>"+a+"</td></tr>";
			// }
		}
	})
}