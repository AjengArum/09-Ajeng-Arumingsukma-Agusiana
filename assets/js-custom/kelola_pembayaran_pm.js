get_data();

$("#tb_murid").select2({
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
	$("#id_murid").val("").trigger("change");
	$("[name='bulan']").val("");
	$("[name='jumlah']").val("");
    $("[name='status_tagihan']").val("");
}

function delete_error() {
	$("#error-id_tagihan").hide();
	$("#error-id_murid").hide();
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
					{ data: "nama" },
					{ data: "bulan" },
					{ data: "jumlah" },
                    { data: "status_tagihan" },
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