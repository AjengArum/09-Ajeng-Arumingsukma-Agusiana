<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Data Tagihan</li>
                </ol>
            </div>
            <h4 class="page-title">Data Tagihan</h4><br>
            <p class="text-muted font-14">Berikut ini adalah data tagihan pada Lembaga Bimbingan Belajar Ang Lesson <br>
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
    <form action="<?= base_url('Pembayaran_pm/export_pdf') ?>" method="post">
            <div class="form-group">
                <label for="filterUser">Filter data</label>
                <select class=" select2 form-control mb-3 custom-select" id="filterUser" name="filterUser"
                    onchange="get_data()">
                    <option value="">Semua Murid</option>
                    <?php foreach ($select as $row): ?>
                        <option value="<?php echo $row->ID; ?>">
                            <?php echo $row->username; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Export</button>
        </form>    
        <hr>
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                <th width="20%">Username</th>
                    <th width="20%">bulan</th>
                    <th width="20%">Jumlah</th>
                    <th width="5%">Status</th>
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