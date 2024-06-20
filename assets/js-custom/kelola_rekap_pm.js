get_data();

$("#filterUser").select2({
    width: "100%",
});

function showAlertifySuccess(message) {
    $("body").append(alertify.success(message));
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
    var button = $(e.relatedTarget);
    var id_absensi = button.data("id");
    var modalButton = $(this).find("#btn-hapus");
    modalButton.attr("onclick", "delete_data('" + id_absensi + "')");
});

function delete_form() {
    $("[name='id_absensi']").val("");
    $("#id_user").val("").trigger("change");
    $("[name='tanggal']").val("");
    $("[name='materi']").val("");
    $("[name='status']").val("");
}

function delete_error() {
    $("#error-id_absensi").hide("");
    $("#error-id_user").hide("");
    $("#error-tanggal").hide("");
    $("#error-materi").hide("");
    $("#error-status").hide("");
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
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    { data: "username" },
                    { data: "tanggal" },
                    { data: "materi" },
                    { data: "status" },
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
		$("[name='title']").text("Tambah Absensi");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Absensi");

    $.ajax({
        type: "POST",
        data: "id_absensi=" + x,
        url: base_url + "/" + _controller + "/get_data_id",
        dataType: "json",
        success: function (hasil) {
            $("[name='id_absensi']").val(hasil[0].id_absensi);
            $("[name='id_user']").val(hasil[0].id_user).trigger("change");
            $("[name='tanggal']").val(hasil[0].tanggal);
            $("[name='materi']").val(hasil[0].materi);
            $("[name='status']").val(hasil[0].status);
        },
    });
    }
    delete_form();
    delete_error();
}
