<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Pembayaran</li>
                </ol>
            </div>
            <h4 class="page-title">Pembayaran</h4><br>
            <p class="text-muted font-14">Berikut ini adalah tagihan pada Lembaga Bimbingan Belajar Ang Lesson <br>
                Klik "Tambah" pada kolom aksi untuk menambah tagihan
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
    <a href="<?= base_url('Tentor_Pm/export_pdf') ?>" class="btn btn-primary">Export</a>    
    <hr>
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="30%">Murid</th>
                    <th width="15%">Bulan</th>
                    <th width="30%">Jumlah</th>
                    <th width="15%">Status</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>