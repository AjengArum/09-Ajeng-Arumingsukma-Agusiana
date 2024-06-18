get_data();

$("#tb_user").select2({
	width: "100%",
});

$("#tb_layanan").select2({
	width: "100%",
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id_murid = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data('" + id_murid + "')");
});

function delete_form() {
	$("[name='id_murid']").val("");
	$("#id_user").val("").trigger("change");
	$("#id_layanan").val("").trigger("change");
	$("[name='nama']").val("");
	$("[name='asal_sekolah']").val("");
}

function delete_error() {
	$("#error-id_murid").hide();
	$("#error-id_user").hide();
	$("#error-id_layanan").hide();
	$("#error-nama").hide();
	$("#error-asal_sekolah").hide();
}

function get_data() {
	delete_error();
	$.ajax({
		url: base_url + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#example").DataTable({
				destroy: true,
				scrollY: 320,
				data: data,
				columns: [
					{ data: "nama" },
					{ data: "username" },
					{ data: "nama_layanan" },
					{ data: "asal_sekolah" },
				],
				initComplete: function () {
					$("th").css("text-align", "center");
					$("td").css("text-align", "center");
				},
			});
		},
		error: function (xhr, textStatus, errorThrown) {
			console.log(xhr.statusText);
		},
	});
}


