<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Delete Data</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <?= $this->session->flashdata('message'); ?>
        <div class="mt-2"></div>
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="fs-6">Delete Data Klub</h3>
                        <a href="<?= base_url() ?>home/delete/klub" onclick="return confirm('Anda yakin?');" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i> Delete</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="fs-6">Delete Data Skor</h3>
                        <a href="<?= base_url() ?>home/delete/skor" onclick="return confirm('Anda yakin?');" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>