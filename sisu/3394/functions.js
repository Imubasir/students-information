function edit(code) {
	$("#editModal").modal('show');
	$.ajax({
		type: 'POST',
		url: 'fetch_details.php',
		data: 'id=' + code,

		success: function(response) {
			var data = JSON.parse(response);
			for (var i = 0; i < data.length; i++) {
				var code = data[i].coursecode;
				var title = data[i].coursetitle;
				var credit = data[i].credit;
				var dept = data[i].deptid;

				document.getElementById("code").value = code;
				document.getElementById("title").value = title;
				document.getElementById("credits").value = credit;
				document.getElementById("dept").value = dept;
			}
			$("#conUpdate").unbind('click').on('click', function() {
				var form = document.querySelector("#editForm");
				var formdata = new FormData(form);

				formdata.append("key", code);
				$.ajax({
					type: 'POST',
					url: 'update.php',
					data: formdata,
					cache: false,
					processData: false,
					contentType: false,

					success: function(response) {
						if (response == '1') {
							new PNotify({
								title: 'Success',
								text: 'Course Edited',
								type: 'success',
								styling: 'bootstrap3'
							});
							$("#editModal").modal('hide');
							load_data();
						} else {
							new PNotify({
								title: 'Error',
								text: response,
								type: 'error',
								styling: 'bootstrap3'
							});
						}
					}
				})
			});
		}
	});
}

function del(code) {
	$("#delBody").html("Confirm Deletion of Course (" + code + ")");
	$("#delModal").modal('show');

	$("#conDelete").on('click', function() {
		$.ajax({
			type: 'POST',
			url: 'delCourse.php',
			data: 'id=' + code,

			success: function(response) {
				if (response == '1') {
					new PNotify({
						title: "Success",
						text: "Course Deleted",
						type: 'success',
						styling: 'bootstrap3'
					});
					load_data();
				} else {
					new PNotify({
						title: "Error",
						text: response,
						type: 'error',
						styling: 'bootstrap3'
					});
				}
			}
		});
	});
}

function load_data() {
	$("#courseTable").dataTable().fnDestroy();
	$.ajax({
		url: 'load_data.php',

		success: function(json) {
			var data = JSON.parse(json);
			var html = '';
			for (var i = 0, a = 1; i < data.length, a < data.length + 1; i++, a++) {
				var code = data[i].coursecode;
				var title = data[i].coursetitle;
				var credit = data[i].credit;
				var dept = data[i].deptname;

				html += "<tr><td>" + a + "</td><td>" + code + "</td><td>" + title + "</td><td>" + credit + "</td><td>" + dept + "</td><td><button onclick='edit(\"" + code + "\")' class='btn btn-sm btn-success'>Edit</button><button onclick='del(\"" + code + "\")' class='btn btn-sm btn-danger'>Delete</button></td></tr>";
			}
			// $("#courseBody").html(html);
			// document.getElementById("load_1").style.display = 'none';
			document.getElementById("courseBody").innerHTML = html;
			$("#courseTable").DataTable();
		}
	})
}

$(document).ready(function() {
	load_data();


});