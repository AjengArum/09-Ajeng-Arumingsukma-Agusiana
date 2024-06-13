<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Pendaftaran</li>
                </ol>
            </div>
            <h4 class="page-title">Pendaftaran Masuk</h4><br>
            <p class="text-muted font-14">Berikut daftar pendaftaran yang masuk <br>
                Klik "Lihat" pada kolom aksi untuk melihat pendaftaran
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="10%">ID Pendaftaran</th>
                    <th width="15%">Nama</th>
                    <th width="30%">Layanan</th>
                    <th width="15%">Asal Sekolah</th>
                    <th width="10%">Kelas</th>
                    <th width="10%">Status Pendaftaran</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
            data-animation="bounce" data-target=".bs-example-modal-lg" onclick="delete_form(); delete_error();">
            <i class="ion-plus-circled"></i> Tambah Pendaftaran
        </button>
    </div>
</div>

<!-- Modal untuk arsipkan surat -->
<div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Pendaftaran >> Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">ID Pendaftaran</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="id_pendaftaran" name="id_pendaftaran"
                            placeholder="Masukkan ID Pendaftaran">
                        <small class="text-danger pl-1" id="error-id_pendaftaran"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="nama" name="nama">
                            <option value="">Pilih Nama Siswa</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id_member; ?>">
                                    <?php echo $row->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-nama"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Layanan</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="id_layanan" name="id_layanan">
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo $row->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-id_layanan"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Asal Sekolah</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="asal_sekolah" name="asal_sekolah">
                            <option value="">Pilih Asal Sekolah</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo $row->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-asal_sekolah"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="kelas" name="kelas">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo $row->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-kelas"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Status Pendaftaran</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="5" id="status_daftar" name="status_daftar"
                            placeholder="Masukkan Status Pendaftaran"></textarea>
                        <small class="text-danger pl-1" id="error-status_daftar"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-2">
                    <button type="button" id="btn-success" onclick="insert_data()"
                        class="btn btn-outline-primary btn-block">Simpan</button>
                </div>
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
<div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Pendaftaran >> Lihat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">ID Pendaftaran</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="hidden" id="id_pendaftaran" name="id_pendaftaran" readonly>
                        <input class="form-control" type="text" id="id_pendaftaran" name="id_pendaftaran" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="nama" name="nama" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Layanan</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="id_layanan" name="id_layanan" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Asal Sekolah</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="asal_sekolah" name="asal_sekolah" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="kelas" name="kelas" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Status Pendaftaran</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="5" id="status_daftar" name="status_daftar"
                            readonly></textarea>
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
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>