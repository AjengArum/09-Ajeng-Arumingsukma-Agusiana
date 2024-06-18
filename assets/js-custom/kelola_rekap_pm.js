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
    $("[name='tgl_absen']").val("");
    $("[name='materi']").val("");
    $("[name='bukti']").val("");
    imagePreview.innerHTML = "";
    $("[name='status']").val("");
}

function delete_error() {
    $("#error-id_absensi").hide("");
    $("#error-id_user").hide("");
    $("#error-tgl_absen").hide("");
    $("#error-materi").hide("");
    $("#error-bukti").hide("");
    $("#file-label").hide("");
    $("#error-status").hide("");
}

function previewImage(event) {
    const imageInput = event.target;
    const imagePreview = document.getElementById("imagePreview");

    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Image" class="img-thumbnail" style="width: 100px; height: auto;">`;
        };
        $("#error-bukti").html("");

        reader.readAsDataURL(imageInput.files[0]);
    } else {
        imagePreview.innerHTML = "";
    }
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
                    { data: "tgl_absen" },
                    { data: "materi" },
                    {
                        data: "bukti",
                        render: function (data, type, row) {
                            var imageUrl = base_url + "assets/file/" + data;
                            return (
                                '<img src="' +
                                imageUrl +
                                '" style="max-height: 200px; max-width: 150px;">'
                            );
                        },
                    },
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
            $("[name='tgl_absen']").val(hasil[0].tgl_absen);
            $("[name='materi']").val(hasil[0].materi);
            var nama = hasil[0].bukti;
            imagePreview.innerHTML = `<br><img src="${base_url}assets/file/${nama}" alt="Preview Image" class="img-thumbnail" style="width: 100px; height: auto;">`;
            $("[name='status']").val(hasil[0].status);
        },
    });
    }
    delete_form();
    delete_error();
}
