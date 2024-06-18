<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Data Murid</li>
                </ol>
            </div>
            <h4 class="page-title"> Data Murid </h4><br>
            <p class="text-muted font-14">Berikut ini adalah daftar murid yang ada pada Lembaga Bimbingan Belajar Ang Lesson <br>
                Klik "Tambah Murid" untuk menambah data murid baru
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
    <a href="<?= base_url('Murid_Pm/export_pdf') ?>" class="btn btn-primary">Export</a>    
    <hr>
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                <th width="20%">Nama</th>
                    <th width="20%">Username</th>
                    <th width="20%">Layanan</th>
                    <th width="20%">Asal Sekolah</th>
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