<!-- view absen -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Absensi</li>
                </ol>
            </div>
            <h4 class="page-title"> Absensi Tentor </h4><br>
            <p class="text-muted font-14">Berikut ini adalah data absensi tentor pada Lembaga Bimbingan Belajar Ang
                Lesson <br></p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('KelolaAbsensi_admin/export_pdf') ?>" method="post">
            <div class="form-group">
                <label for="filterUser">Filter data</label>
                <select class=" select2 form-control mb-3 custom-select" id="filterUser" name="filterUser"
                    onchange="get_data()">
                    <option value="">Semua tentor</option>
                    <?php foreach ($select as $row): ?>
                        <option value="<?php echo $row->ID; ?>">
                            <?php echo $row->username; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Export</button> -->
        </form>
        <hr>
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tentor</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Materi</th>
                    <th width="15%">Bukti</th>
                    <th width="15%">Status</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
            data-target=".bs-example-modal-lg" onclick="submit('tambah')">
            <i class="mdi mdi-plus"></i>Tambah Absen
        </button>
    </div>
</div>


<!-- Modal untuk hapus data -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title center" id="exampleModalLabel"><i class="mdi mdi-alert"></i> Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-6">
                    <button type="button" id="btn-hapus" data-dismiss="modal"
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
                    <label for="example-text-input" class="col-sm-3 col-form-label">Tentor</label>
                    <div class="col-sm-9">
                    <input class="form-control" type="hidden" id="id_absensi" name="id_absensi">
                        <select class="select2 form-control mb-3 custom-select" id="id_user" name="id_user">
                            <option value="">Pilih Tentor</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->ID; ?>">
                                    <?php echo $row->username; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-id_user"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="tgl_absen" name="tgl_absen"
                            placeholder="Masukkan tanggal"></textarea>
                        <small class="text-danger pl-1" id="error-tgl_absen"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Materi</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="3" id="materi" name="materi"
                            placeholder="Masukkan Materi"></textarea>
                        <small class="text-danger pl-1" id="error-materi"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label>Bukti</label>
                    <input type="file" name="bukti" id="bukti" class="form-control" onchange="previewImage(event)">
                    <small class="text-gray pl-1" id="file-label"></small><br>
                    <div id="imagePreview"></div>
                    <small class="text-danger pl-1" id="error-bukti"></small>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-2">
                    <select class="select2 form-control mb-3 custom-select" id="status" name="status">
                    <option value="">Pilih Status</option>
                            <option value="menunggu_validasi">Menunggu Validasi</option>
                            <option value="tervalidasi">Tervalidasi</option>
                         </select>
                        <small class="text-danger pl-1" id="error-status"></small>
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

    <script>
        var base_url = '<?php echo base_url() ?>';
        var _controller = '<?= $this->router->fetch_class() ?>';
    </script>