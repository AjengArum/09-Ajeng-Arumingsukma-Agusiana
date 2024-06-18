<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Ang Lesson</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section>
    <h4>Dashboard Pemilik</h4>
    <hr>
    <div class="row">

    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card m-b-30" style="height: 200px;">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <!-- Bagian Kiri dengan Gambar -->
                <div class="col-2 align-self-center">
                    <img src="assets/file/logo_web.png" alt="Image" class="img-fluid">
                </div>

                <!-- Bagian Tengah dan Kanan dengan Teks -->
                <div class="col-9 text-left align-self-center">
                    <div class="m-l-10">
                        <h5 class="mt-0 round-inner">
                            LEMBAGA BIMBINGAN BELAJAR ANG LESSON
                        </h5>
                        <p class="mb-0 text-muted">Lembaga Bimbingan Belajar Ang Lesson merupakan lembaga bimbingan belajar yang telah menjadi mitra terpercaya orang tua selama 4 tahun dalam mendukung prestasi anak dalam bidang akademik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-12 col-xl-4">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-view-list"></i>
                            </div>
                        </div>
                        <div class="col-9 text-center align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0 round-inner">
                                    <?= $murid; ?>
                                </h5>
                                <p class="mb-0 text-muted">Jumlah Murid</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-xl-4">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-account-circle"></i>
                            </div>
                        </div>
                        <div class="col-9 text-center align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0 round-inner">
                                    <?= $tentor; ?>
                                </h5>
                                <p class="mb-0 text-muted">Jumlah Tentor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-lg-12 col-xl-4">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-currency-usd"></i>
                            </div>
                        </div>
                        <div class="col-9 text-center align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0 round-inner">
                                    <?= $tagihan; ?>
                                </h5>
                                <p class="mb-0 text-muted">Jumlah Tagihan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</section>