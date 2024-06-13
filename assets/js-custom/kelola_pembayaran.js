get_data();

$("#tb_user").select2({
	width: "100%",
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id_tagihan = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data('" + id_tagihan + "')");
});

function delete_form() {
	$("[name='id_tagihan']").val("");
	$("#id_user").val("").trigger("change");
	$("[name='bulan']").val("");
	$("[name='jumlah']").val("");
	$("[name='status_tagihan']").val("");
}

function delete_error() {
	$("#error-id_tagihan").hide();
	$("#error-id_user").hide();
	$("#error-bulan").hide();
	$("#error-jumlah").hide();
	$("#error-status_tagihan").hide();
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
					{ data: "username" },
					{ data: "bulan" },
					{ data: "jumlah" },
					{ data: "status_tagihan" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
								row.id_tagihan +
								'"><i class="ion-trash-b"></i></button> ' +
								'<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" title="lihat" onclick="submit(' + row.id_tagihan + ')"><i class="ion-edit"></i></button> '
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
		$("[name='title']").text("Tambah Tagihan");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Tagihan");

    $.ajax({
        type: "POST",
        data: "id_tagihan=" + x,
        url: base_url + "/" + _controller + "/get_data_id",
        dataType: "json",
        success: function (hasil) {
			$("[name='id_tagihan']").val(hasil[0].id_tagihan);
            $("[name='id_user']").val(hasil[0].id_user).trigger("change");
            $("[name='bulan']").val(hasil[0].bulan);
            $("[name='jumlah']").val(hasil[0].jumlah);
            $("[name='status_tagihan']").val(hasil[0].status_tagihan);
        },
    });
	}
    delete_error();
    delete_form();
}

function insert_data() {
	var formData = new FormData();
	//formData.append("id_murid", $("[name='id_murid']").val());
	formData.append("id_user", $("#id_user").val());
	formData.append("bulan", $("[name='bulan']").val());
	formData.append("jumlah", $("[name='jumlah']").val());
	formData.append("status_tagihan", $("[name='status_tagihan']").val());

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
		data: "id_tagihan=" + x,
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
	formData.append("id_tagihan", $("[name='id_tagihan']").val());
	formData.append("id_user", $("#id_user").val());
	formData.append("bulan", $("[name='bulan']").val());
	formData.append("jumlah", $("[name='jumlah']").val());
	formData.append("status_tagihan", $("[name='status_tagihan']").val());
  
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

