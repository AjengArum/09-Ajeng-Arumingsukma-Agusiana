get_data();

$("#filterUser").select2({
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
	var formData = new FormData();
    formData.append("id_user", $("#filterUser").val());
	$.ajax({
		url: base_url + "/" + _controller + "/get_data",
        method: "POST",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
		success: function (data) {
			var table = $("#example").DataTable({
				destroy: true,
                searching: false,
				scrollY: 320,
				data: data,
				columns: [
					{ data: "username" },
					{ data: "bulan" },
					{ data: "jumlah" },
					{ data: "status_tagihan" },
					// {
					// 	data: null,
					// 	render: function (data, type, row) {
					// 		return (
					// 			'<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
					// 			row.id_tagihan +
					// 			'"><i class="ion-trash-b"></i></button> ' +
					// 			'<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" title="lihat" onclick="submit(' + row.id_tagihan + ')"><i class="ion-edit"></i></button> '
					// 		);

					// 	},
					// },
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
