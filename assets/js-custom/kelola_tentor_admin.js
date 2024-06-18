get_data();

$("#tb_user").select2({
	width: "100%",
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id_tentor = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data('" + id_tentor + "')");
});

function delete_form() {
	$("[name='id_tentor']").val("");
	$("#id_user").val("").trigger("change");
	$("[name='nama']").val("");
	$("[name='jenjang']").val("");;
	$("[name='foto']").val("");
	imagePreview.innerHTML = "";
}

function delete_error() {
	$("#error-id_tentor").hide();
	$("#error-id_user").hide();
	$("#error-nama").hide();
	$("#error-jenjang").hide();
	$("#error-foto").hide("");
	$("#file-label").hide("");
}

function previewImage(event) {
	const imageInput = event.target;
	const imagePreview = document.getElementById("imagePreview");

	if (imageInput.files && imageInput.files[0]) {
		const reader = new FileReader();

		reader.onload = function (e) {
			imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Image" class="img-thumbnail" style="width: 100px; height: auto;">`;
		};
		$("#error-foto").html("");

		reader.readAsDataURL(imageInput.files[0]);
	} else {
		imagePreview.innerHTML = "";
	}
}

function get_data() {
	//delete_error();
	$.ajax({
		url: base_url + "/" + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#example").DataTable({
				destroy: true,
				scrollY: 320,
				data: data,
				columns: [
					{ data: "username" },
					{ data: "nama" },
					{ data: "jenjang" },
                    { 
						data: "foto",
						render: function (data, type, row) {
							var imageUrl = base_url + "assets/file/" + data;
							return (
								'<img src="' +
								imageUrl +
								'" style="max-width: 200px;">'
							);
						}, 
					},
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
								row.id_tentor +
								'"><i class="ion-trash-b"></i></button> ' +
								'<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" title="lihat" onclick="submit(' + row.id_tentor + ')"><i class="ion-edit"></i></button> '
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

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Tentor");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Tentor");

		$.ajax({
			type: "POST",
			data: "id_tentor=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name='id_tentor']").val(hasil[0].id_tentor);
				$("[name='id_user']").val(hasil[0].id_user).trigger("change");
				$("[name='nama']").val(hasil[0].nama);
				$("[name='jenjang']").val(hasil[0].jenjang);
				var nama = hasil[0].foto;
				imagePreview.innerHTML = `<br><img src="${base_url}assets/file/${nama}" alt="Preview Image" class="img-thumbnail" style="width: 100px; height: auto;">`;
			},
		});
	}
	delete_error();
	delete_form();
}

function insert_data() {
	var formData = new FormData();
	//formData.append("id_tentor", $("[name='id_tentor']").val());
	formData.append("id_user", $("#id_user").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("jenjang", $("[name='jenjang']").val());
	
	var imageInput = $("[name='foto']")[0];
	if (imageInput.files.length > 0) {
		formData.append("foto", imageInput.files[0]);
	}

	$.ajax({
		type: "POST",
		url: base_url + "/" + _controller + "/insert_data",
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
		data: "id_tentor=" + x,
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

function edit_data() {
	var formData = new FormData();
	formData.append("id_tentor", $("[name='id_tentor']").val());
	formData.append("id_user", $("#id_user").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("jenjang", $("[name='jenjang']").val());
	
    var imageInput = $("[name='foto']")[0];
	if (imageInput.files.length > 0) {
		formData.append("foto", imageInput.files[0]);
	}

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
