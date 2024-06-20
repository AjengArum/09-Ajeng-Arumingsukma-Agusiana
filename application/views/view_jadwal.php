<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Jadwal</li>
                </ol>
            </div>
            <h4 class="page-title">Jadwal</h4><br>
            <p class="text-muted font-14">Berikut ini adalah jadwal bimbingan pada Lembaga Bimbingan Belajar Ang Lesson <br>
                Klik "Tambah" pada kolom aksi untuk menambah jadwal
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="25%">Layanan</th>
                    <th width="20%">Hari</th>
                    <th width="20%">Jam Mulai</th>
                    <th width="20%">Jam Berakhir</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
            data-animation="bounce" data-target=".bs-example-modal-lg" onclick="submit('tambah')">
            <i class="ion-plus-circled"></i> Tambah Jadwal
        </button>
    </div>
</div>

<!-- Modal untuk arsipkan surat -->
<div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" name="title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Layanan</label>
                    <div class="col-sm-9">
                    <input class="form-control" type="hidden" id="id_jadwal" name="id_jadwal">
                        <select class="select2 form-control mb-3 custom-select" id="id_layanan" name="id_layanan">
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id_layanan; ?>">
                                    <?php echo $row->nama_layanan; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-id_layanan"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Hari</label>
                    <div class="col-sm-9">
                        <select required class="form-control" id="hari" name="hari">
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                         </select>
                        <small class="text-danger pl-1" id="error-hari"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                    <div class="col-sm-9">
                        <select required class="form-control" id="jam_mulai" name="jam_mulai">
                            <option value="15.00">15.00</option>
                            <option value="16.00">16.00</option>
                            <option value="17.00">17.00</option>
                            <option value="18.00">18.00</option>
                            <option value="19.00">19.00</option>
                         </select>
                        <small class="text-danger pl-1" id="error-jam_mulai"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Jam Berakhir</label>
                    <div class="col-sm-9">
                        <select required class="form-control" id="jam_berakhir" name="jam_berakhir">
                            <option value="16.00">16.00</option>
                            <option value="17.00">17.00</option>
                            <option value="18.00">18.00</option>
                            <option value="19.00">19.00</option>
                            <option value="20.00">20.00</option>
                         </select>
                        <small class="text-danger pl-1" id="error-jam_berakhir"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                            <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-outline-primary">Simpan</button>
                            <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-outline-primary">Edit</button>
                        </div>
        </div>
    </div>
</div>

<!-- Modal untuk hapus data -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title center" id="exampleModalLabel"><i class="mdi mdi-alert"></i> Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-6">
                    <button type="button" id="btn-hapus" ata-dismiss="modal"
                        class="btn btn-outline-primary btn-block">Ya!</button>
                </div>
                <div class="col-lg-6">
                    <button type="button" id="btn-cancel" data-dismiss="modal"
                        class="btn btn-outline-danger btn-block">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk lihat surat -->
<!-- <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Jadwal >> Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Tentor</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="id_tentor" name="id_tentor">
                            <option value="">Pilih Tentor</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id_tentor; ?>">
                                    <?php echo $row->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-id_tentor"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Ruangan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="ruang" name="ruang"
                            placeholder="Masukkan nama ruangan"></textarea>
                        <small class="text-danger pl-1" id="error-ruang"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Hari</label>
                    <div class="col-sm-9">
                        <select required class="form-control" id="hari" name="hari">
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                        </select>
                        <small class="text-danger pl-1" id="error-hari"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                    <div class="col-sm-9">
                        <select required class="form-control" id="jam_mulai" name="jam_mulai">
                            <option value="15.00">15.00</option>
                            <option value="16.00">16.00</option>
                            <option value="17.00">17.00</option>
                            <option value="18.00">18.00</option>
                            <option value="19.00">19.00</option>
                        </select>
                        <small class="text-danger pl-1" id="error-jam_mulai"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Jam Berakhir</label>
                    <div class="col-sm-9">
                        <select required class="form-control" id="jam_berakhir" name="jam_berakhir">
                            <option value="16.00">16.00</option>
                            <option value="17.00">17.00</option>
                            <option value="18.00">18.00</option>
                            <option value="19.00">19.00</option>
                            <option value="20.00">20.00</option>
                        </select>
                        <small class="text-danger pl-1" id="error-jam_berakhir"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-3">
                    <button type="button" id="btn-update" onclick="update_data()"
                        class="btn btn-outline-primary btn-block">Update file</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- 
<script>
function getTutorColor(tutorName) {
    // Convert the tutor name to a hexadecimal hash
    var hash = 0;
    for (var i = 0; i < tutorName.length; i++) {
        hash = tutorName.charCodeAt(i) + ((hash << 5) - hash);
    }
    // Convert the hash to a hexadecimal color
    var color = '#';
    for (var i = 0; i < 3; i++) {
        var value = (hash >> (i * 8)) & 0xFF;
        color += ('00' + value.toString(16)).substr(-2);
    }
    return color;
}
</script>

<script>
$(document).ready(function() {
    // Loop through each day to create a row in the table
    ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'].forEach(function(day) {
        var dayIndex = getDayIndex(day.toLowerCase());
        var newRow = '<tr><th style="vertical-align: middle;">' + day + '</th>';
        for (var i = 0; i < 6; i++) {
            newRow += '<td></td>';
        }
        newRow += '</tr>';
        $('table tbody').append(newRow);
    });

    $.ajax({
        url: base_url + _controller + "/get_data",
        method: "GET",
        dataType: "json",
        success: function(data) {
            $.each(data, function(index, item) {
                var tutorColor = getTutorColor(item.nama_tentor);
                var startHour = parseInt(item.jam_mulai.split(':')[0]);
                var endHour = parseInt(item.jam_berakhir.split(':')[0]);
                var day = $('table tbody tr:contains(' + item.hari + ')th').text().toLowerCase();
                for (var hour = startHour; hour <= endHour; hour++) {
                    $('table tbody tr:eq(' + (getDayIndex(item.hari)) + ') td:eq(' + (hour - 15) + ')').css('background-color', tutorColor).text(item.ruang);
                }
            });
        }
    });
});

</script> -->

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>