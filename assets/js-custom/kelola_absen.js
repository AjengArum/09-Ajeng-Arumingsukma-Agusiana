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

// function previewImage(event) {
//     const imageInput = event.target;
//     const imagePreview = document.getElementById("imagePreview");

//     if (imageInput.files && imageInput.files[0]) {
//         const reader = new FileReader();

//         reader.onload = function (e) {
//             imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Image" class="img-thumbnail" style="width: 100px; height: auto;">`;
//         };
//         $("#error-bukti").html("");

//         reader.readAsDataURL(imageInput.files[0]);
//     } else {
//         imagePreview.innerHTML = "";
//     }
// }

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
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (
                                '<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
                                row.id_absensi +
                                '"><i class="ion-trash-b"></i></button> ' +
                                '<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" title="lihat" onclick="submit(' + row.id_absensi + ')"><i class="ion-edit"></i></button> '
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

function insert_data() {
    var formData = new FormData();
    formData.append("id_user", $("#id_user").val());
    formData.append("tanggal", $("[name='tanggal']").val());
    formData.append("materi", $("[name='materi']").val());
    formData.append("status", $("[name='status']").val());

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
        data: "id_absensi=" + x,
        dataType: "json",
        url: base_url + "/" + _controller + "/delete_data",
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
    formData.append("id_absensi", $("[name='id_absensi']").val());
    formData.append("id_user", $("#id_user").val());
    formData.append("tanggal", $("[name='tanggal']").val());
    formData.append("materi", $("[name='materi']").val());
    formData.append("status", $("[name='status']").val());

    $.ajax({
        type: "POST",
        url: base_url + _controller + "/edit_data",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.errors) {
                for (var fieldName in response.errors) {
                    $("#error-" + fieldName).show();
                    $("#error-" + fieldName).html(response.errors[fieldName]);
                }
            } else if (response.success) {
                $(".bs-example-modal-lg").modal("hide");
                get_data();
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error: " + error);
        },
    });
}
