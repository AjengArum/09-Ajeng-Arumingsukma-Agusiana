<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Tagihan</li>
                </ol>
            </div>
            <h4 class="page-title"> Data Tagihan </h4><br>
            <p class="text-muted font-14">Berikut ini adalah data tagihan belum lunas murid yang ada pada Lembaga Bimbingan Belajar Ang Lesson <br>
                Klik "Tambah Tagihan" untuk menambah data tagihan baru
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="20%">Username</th>
                    <th width="20%">bulan</th>
                    <th width="20%">Jumlah</th>
                    <th width="5%">Status Tagihan</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
            data-target=".bs-example-modal-lg" onclick="submit('tambah')">
            <i class="mdi mdi-plus"></i>Tambah Tagihan
        </button>
    </div>
</div>

<!-- Modal untuk menambah dan mengedit data murid -->
<div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" name="title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                <input class="form-control" type="hidden" id="id_tagihan" name="id_tagihan">
                                    <select class="select2 form-control mb-3 custom-select" id="id_user" name="id_user">
                                        <option value="">Pilih username</option>
                                        <?php foreach ($select_user as $user): ?>
                                            <option value="<?php echo $user->ID; ?>">
                                                <?php echo $user->username; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger pl-1" id="error-id_user"></small>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Bulan</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="bulan" name="bulan" placeholder="Masukkan bulan">
                                    <small class="text-danger pl-1" id="error-bulan"></small>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" id="jumlah" name="jumlah" placeholder="Masukkan jumlah">
                                    <small class="text-danger pl-1" id="error-jumlah"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Status Tagihan</label>
                                <div class="col-sm-9">
                                    <select required class="form-control" id="status_tagihan" name="status_tagihan">
                                        <option value="belum lunas">Belum Lunas</option>
                                        <option value="lunas">Lunas</option>
                                    </select>
                                    <small class="text-danger pl-1" id="error-status_tagihan"></small>
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
<!-- <div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Murid >> Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                 <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">ID Murid</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="id_murid_1" name="id_murid_1"
                            placeholder="Masukkan id murid">
                        <small class="text-danger pl-1" id="error-id_murid_1"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                    <input class="form-control" type="hidden" id="id_murid" name="id_murid">
                        <input class="form-control" type="text" id="nama_1" name="nama_1"
                            placeholder="Masukkan nama">
                        <small class="text-danger pl-1" id="error-nama_1"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="id_user_1" name="id_user_1">
                            <option value="">Pilih Username</option>
                            <?php foreach ($select_user as $user): ?>
                                <option value="<?php echo $user->ID; ?>">
                                    <?php echo $user->username; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-id_user_1"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Layanan</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="id_layanan_1" name="id_layanan_1">
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id_layanan; ?>">
                                    <?php echo $row->nama_layanan; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-id_layanan_1"></small>
                    </div>
                </div>  
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Asal Sekolah</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="3" id="asal_sekolah_1" name="asal_sekolah_1"
                            placeholder="Masukkan Asal Sekolah"></textarea>
                        <small class="text-danger pl-1" id="error-asal_sekolah_1"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="3" id="kelas_1" name="kelas_1"
                            placeholder="Masukkan Kelas"></textarea>
                        <small class="text-danger pl-1" id="error-kelas_"></small>
                    </div>
                </div>    
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-3">
                    <button type="button" id="btn-update" onclick="edit_data()"
                        class="btn btn-outline-primary btn-block">Update file</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>