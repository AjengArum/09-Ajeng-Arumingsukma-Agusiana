<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Tentor</li>
                </ol>
            </div>
            <h4 class="page-title"> Tentor </h4><br>
            <p class="text-muted font-14">Berikut ini adalah daftar tentor yang mengajar pada Lembaga Bimbingan Belajar Ang Lesson <br>
                Klik "Tambah Tentor" untuk menambah data tentor baru
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
    <a href="<?= base_url('KelolaTentor_admin/export_pdf') ?>" class="btn btn-primary">Export</a>    
    <hr>
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="20%">Username</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Jenjang</th>
                    <th width="20%">Foto</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" 
            data-target=".bs-example-modal-lg" onclick="submit('tambah')">
            <i class="mdi mdi-plus"></i>Tambah Tentor
        </button>
    </div>
</div>

<!-- Modal untuk menambah dan mengedit data tentor -->
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
                        <input class="form-control" type="hidden" id="id_tentor" name="id_tentor">
                        <select class="select2 form-control mb-3 custom-select" id="id_user" name="id_user">
                            <option value="">Pilih Username</option>
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
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="nama" name="nama"
                            placeholder="Masukkan nama"></textarea>
                        <small class="text-danger pl-1" id="error-nama"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Jenjang</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="jenjang" name="jenjang"
                            placeholder="Masukkan jenjang yang di ajar"></textarea>
                        <small class="text-danger pl-1" id="error-jenjang"></small>
                    </div>
                </div>  
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" onchange="previewImage(event)">
                    <small class="text-gray pl-1" id="file-label"></small><br>
                    <div id="imagePreview"></div>
                    <small class="text-danger pl-1" id="error-foto"></small>
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
                <h5 class="modal-title center" id="exampleModalLabel"><i class="mdi mdi-alert"></i></h5>
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
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Tentor >> Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">ID Tentor</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="id_tentor_1" name="id_tentor_1"
                            placeholder="Masukkan id tentor">
                        <small class="text-danger pl-1" id="error-id_tentor_1"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama Tentor</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="user" name="user">
                            <option value="">Pilih Username</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->ID; ?>">
                                    <?php echo $row->username; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-user"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="nama_1" name="nama_1"
                            placeholder="Masukkan nama"></textarea>
                        <small class="text-danger pl-1" id="error-nama_1"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kelas dan Jenjang</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="kelas_jenjang_1" name="kelas_jenjang_1"
                            placeholder="Masukkan kelas dan jenjang yang di ajar"></textarea>
                        <small class="text-danger pl-1" id="error-kelas_jenjang_1"></small>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="1" id="mapel_1" name="mapel_1"
                            placeholder="Masukkan mata pelajaran yang diampu"></textarea>
                        <small class="text-danger pl-1" id="error-mapel_1"></small>
                    </div>
                </div>     
            </div>
            <div class="modal-footer d-flex justify-content-start">
                    <button type="button" id="btn-update" onclick="edit_data()"
                        class="btn btn-outline-primary btn-block">Update file</button>
            </div>
        </div>
    </div>
</div>  -->

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>