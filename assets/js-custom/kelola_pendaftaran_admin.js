get_data();

$("#tb_member").select2({
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
	var id = button.data("id_pendaftaran");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data(" + id + ")");
});

function delete_error() {
	$("#error-id_pendaftaran").hide();
	$("#error-nama").hide();
	$("#error-id_layanan").hide();
	$("#error-asal_sekolah").hide();
	$("#error-kelas").hide();
    $("#error-status_daftar").hide();
}

function delete_form() {
	$("[name='id_pendaftaran']").val("");
	$("#tb_member").val("").trigger("change");
    $("#tb_layanan").val("").trigger("change");
    $("#tb_member").val("").trigger("change");
	$("#tb_member").val("").trigger("change");
	$("[name='status_daftar']").val("");
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
					{ data: "id_pendaftaran" },
					{ data: "nama" },
					{ data: "id_layanan" },
					{ data: "asal_sekolah" },
                    { data: "kelas" },
                    { data: "status_daftar" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
								row.id +
								'"><i class="ion-trash-b"></i></button> ' +
								'<button class="btn btn-success" title="unduh" onclick="downloadFile(\'' +
								row.file_name +
								'\')"><i class="ion-ios7-cloud-download"></i></button> ' +
								'<button class="btn btn-info" data-toggle="modal" data-target="#lihat" title="lihat" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button> '
							);
						},
					},
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

function insert_data() {
	var formData = new FormData();
	formData.append("id_pendaftaran", $("[name='id_pendaftaran']").val());
	formData.append("nama", $("#tb_member").val());
	formData.append("id_layanan", $("#tb_layanan").val());
	formData.append("asal_sekolah", $("#tb_member").val());
    formData.append("kelas", $("#tb_member").val());
    formData.append("status_daftar", $("[name='status_daftar']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error();
			if (response.errors) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function delete_data(x) {
	$.ajax({
		type: "POST",
		data: "id_pendaftaran=" + x,
		dataType: "json",
		url: base_url + _controller + "/delete_data",
		success: function (response) {
			if (response.success) {
				$(".bs-example-modal-center").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
	});
}

function submit(x) {
	$.ajax({
		type: "POST",
		data: "id_pendaftaran=" + x,
		url: base_url + "/" + _controller + "/get_data_id",
		dataType: "json",
		success: function (hasil) {
			$("[name='id_pendaftaran']").val(hasil[0].id);
			$("[name='nama']").val(hasil[0].nama);
			$("[name='id_layanan']").val(hasil[0].id_layanan);
			$("[name='asal_sekolah']").val(hasil[0].asal_sekolah);
            $("[name='kelas']").val(hasil[0].kelas);
			$("[name='status_daftar']").val(hasil[0].status_daftar);
		},
	});
	delete_error();
	delete_form();
}

function update_data() {
	var formData = new FormData();
	formData.append("id_pendaftaran", $("[name='id_pendaftaran']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/edit_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.errors) {
				delete_error();
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$("#lihat").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
