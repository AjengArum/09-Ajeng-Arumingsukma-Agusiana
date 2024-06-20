<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Data Pembayaran</li>
                </ol>
            </div>
            <h4 class="page-title"> Data Pembayaran </h4><br>
            <p class="text-muted font-14">Berikut ini adalah data tagihan lunas murid yang ada pada Lembaga Bimbingan Belajar Ang Lesson <br>
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
                    <th width="5%">Status</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
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

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>