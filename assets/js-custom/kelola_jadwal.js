get_data();

$("#tb_layanan").select2({
	width: "100%",
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id_jadwal = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data('" + id_jadwal + "')");
});

function delete_form() {
	$("[name='id_jadwal']").val("");
	$("#id_layanan").val("").trigger("change");
	$("[name='jam_mulai']").val("");
	$("[name='jam_berakhir']").val("");
}

function delete_error() {
	$("#error-id_jadwal").hide();
	$("#error-id_layanan").hide();
	$("#error-jam_mulai").hide();
	$("#error-jam_berakhir").hide();
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
                    { data: "nama_layanan" },
                    { data: "hari" },
                    { data: "jam_mulai" },
                    { data: "jam_berakhir" },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return (
                                '<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
                                row.id_jadwal +
                                '"><i class="ion-trash-b"></i></button> ' +
                                '<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg" title="lihat" onclick="submit(' + row.id_jadwal + ')"><i class="ion-edit"></i></button> '
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
		$("[name='title']").text("Tambah Jadwal");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Jadwal");

		$.ajax({
			type: "POST",
			data: "id_jadwal=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name='id_jadwal']").val(hasil[0].id_jadwal);
                $("[name='id_layanan']").val(hasil[0].id_layanan).trigger("change");
				$("[name='hari']").val(hasil[0].hari);
				$("[name='jam_mulai']").val(hasil[0].jam_mulai);
				$("[name='jam_berakhir']").val(hasil[0].jam_berakhir);
			},
		});
	}
        delete_error();
	delete_form();
}

function insert_data() {
	var formData = new FormData();
	//formData.append("id_jadwal", $("[name='id_jadwal']").val());
	formData.append("id_layanan", $("#id_layanan").val());
	formData.append("hari", $("[name='hari']").val());
	formData.append("jam_mulai", $("[name='jam_mulai']").val());
	formData.append("jam_berakhir", $("[name='jam_berakhir']").val());

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
		data: "id_jadwal=" + x,
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
	formData.append("id_jadwal", $("[name='id_jadwal']").val());
	formData.append("id_layanan", $("#id_layanan").val());
	formData.append("hari", $("[name='hari']").val());
	formData.append("jam_mulai", $("[name='jam_mulai']").val());
	formData.append("jam_berakhir", $("[name='jam_berakhir']").val());

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

// function updateScheduleTable() {
//     // Reset warna latar belakang pada seluruh kolom tabel
//     $('table tbody td').css('background-color', '');

//     // Ambil data jadwal dari form input
//     var ruang = $('#ruang').val();
//     var hari = $('#hari').val();
//     var jamMulai = parseFloat($('#jam_mulai').val());
//     var jamBerakhir = parseFloat($('#jam_berakhir').val());

//     // Hitung indeks baris dan kolom pada tabel untuk mengubah warna latar belakang
//     var rowIdx = $('table tbody tr:contains(' + hari + ')').index();
//     var startColIdx = Math.floor(jamMulai - 15);
//     var endColIdx = Math.floor(jamBerakhir - 15);

//     // Ubah warna latar belakang pada sel-sel yang sesuai dengan data jadwal
//     for (var colIdx = startColIdx; colIdx <= endColIdx; colIdx++) {
//         $('table tbody tr:eq(' + rowIdx + ') td:eq(' + colIdx + ')').css('background-color', 'blue').text(ruang);
//     }
// }

// // Panggil fungsi updateScheduleTable saat form input berubah
// $('#ruang, #hari, #jam_mulai, #jam_berakhir').on('change', function() {
//     updateScheduleTable();
// });

// // Panggil fungsi updateScheduleTable saat halaman dimuat
// $(document).ready(function() {
//     updateScheduleTable();
// });

