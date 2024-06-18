<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Layanan</li>
                </ol>
            </div>
            <h4 class="page-title"> Data Layanan </h4><br>
            <p class="text-muted font-14">Berikut ini adalah daftar layanan yang ada pada Lembaga Bimbingan Belajar Ang Lesson <br>
                Klik "Tambah Layanan" untuk menambah data layanan baru
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="20%">Tentor</th>
                    <th width="20%">Nama Layanan</th>
                    <th width="20%">Keterangan</th>
                    <th width="10%">Biaya</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
            data-target=".bs-example-modal-lg" onclick="submit('tambah')">
            <i class="ion-plus-circled"></i> Tambah Layanan
        </button>
    </div>
</div>

<!-- Modal untuk tambah kategori -->
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
                    <input class="form-control" type="hidden" id="id_layanan" name="id_layanan">
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
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama Layanan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="nama_layanan" name="nama_layanan"
                            placeholder="Masukkan nama layanan"></textarea>
                        <small class="text-danger pl-1" id="error-nama_layanan"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="2" id="keterangan" name="keterangan"
                            placeholder="Masukkan keterangan"></textarea>
                        <small class="text-danger pl-1" id="error-keterangan"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Biaya</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="biaya" name="biaya"
                            placeholder="Masukkan biaya"></textarea>
                        <small class="text-danger pl-1" id="error-biaya"></small>
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
                    <!-- <input type="hidden" name="id" class="form-control"> -->
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

<!-- Modal untuk lihat surat -->
<!-- <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Layanan >> Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">ID Layanan</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="id_layanan_1" name="id_layanan_1"
                            placeholder="Masukkan id layanan">
                        <small class="text-danger pl-1" id="error-id_layanan_1"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Tentor</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="tentor" name="tentor">
                            <option value="">Pilih Tentor</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id_tentor; ?>">
                                    <?php echo $row->tentor; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-tentor"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama Layanan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="nama_layanan_1" name="nama_layanan_1"
                            placeholder="Masukkan nama layanan"></textarea>
                        <small class="text-danger pl-1" id="error-nama_layanan_1"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="2" id="keterangan_1" name="keterangan_1"
                            placeholder="Masukkan keterangan"></textarea>
                        <small class="text-danger pl-1" id="error-keterangan_1"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Biaya</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="biaya_1" name="biaya_1"
                            placeholder="Masukkan biaya"></textarea>
                        <small class="text-danger pl-1" id="error-biaya_1"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kuota</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="kuota_1" name="kuota_1"
                            placeholder="Masukkan kuota"></textarea>
                        <small class="text-danger pl-1" id="error-kuota_1"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-3">
                    <button type="button" id="btn-update" onclick="edit_data()"
                        class="btn btn-outline-primary btn-block">Update file</button>
                </div>
            </div> -->
        <!-- </div>
    </div>
</div> -->

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>