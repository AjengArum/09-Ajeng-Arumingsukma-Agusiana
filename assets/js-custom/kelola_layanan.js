get_data();

$("#tb_tentor").select2({
	width: "100%",
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id_layanan = button.data("id");
	// var id = "L1";
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data('" + id_layanan + "')");
	// modalButton.data("id",id_layanan);
});

function delete_form() {
	$("[name='id_layanan']").val("");
	$("#id_tentor").val("").trigger("change");
	$("[name='nama_layanan']").val("");
	$("[name='keterangan']").val("");
	$("[name='biaya']").val("");
	$("[name='kuota']").val("");
}

function delete_error() {
	$("#error-id_layanan").hide();
	$("#error-id_tentor").hide();
	$("#error-nama_layanan").hide();
	$("#error-keterangan").hide();
	$("#error-biaya").hide();
	$("#error-kuota").hide();
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
					{ data: "nama_layanan" },
                    { data: "keterangan" },
					{ data: "biaya" },
                    { data: "kuota" },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (
                                '<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" title="lihat" onclick="submit(' + row.id_layanan + ')"><i class="ion-edit"></i></button> ' +
                                '<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' + 
								row.id_layanan +
                                '"><i class="ion-trash-b"></i></button> '
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
		$("[name='title']").text("Tambah Layanan");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Layanan");

    $.ajax({
        type: "POST",
        data: "id_layanan=" + x,
        url: base_url + "/" + _controller + "/get_data_id",
        dataType: "json",
        success: function (hasil) {
            $("[name='id_layanan']").val(hasil[0].id_layanan);
            $("[name='id_tentor']").val(hasil[0].id_tentor).trigger("change");
            $("[name='nama_layanan']").val(hasil[0].nama_layanan);
            $("[name='keterangan']").val(hasil[0].keterangan);
            $("[name='biaya']").val(hasil[0].biaya);
            $("[name='kuota']").val(hasil[0].kuota);
        },
    });
}
    delete_form();
 delete_error();
}


function insert_data() {
	var formData = new FormData();
	//formData.append("id_layanan", $("[name='id_layanan']").val());
	formData.append("id_tentor", $("#id_tentor").val());
	formData.append("nama_layanan", $("[name='nama_layanan']").val());
	formData.append("keterangan", $("[name='keterangan']").val());
	formData.append("biaya", $("[name='biaya']").val());
	formData.append("kuota", $("[name='kuota']").val());

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

function edit_data() {
	var formData = new FormData();
	formData.append("id_layanan", $("[name='id_layanan']").val());
	formData.append("id_tentor", $("#id_tentor").val());
	formData.append("nama_layanan", $("[name='nama_layanan']").val());
	formData.append("keterangan", $("[name='keterangan']").val());
	formData.append("biaya", $("[name='biaya']").val());
	formData.append("kuota", $("[name='kuota']").val());

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

function delete_data(x) {
    $.ajax({
		type: "POST",
		data: "id_layanan=" + x,
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
