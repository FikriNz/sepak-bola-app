<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Club</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
        </div>
    </div>

    <h2>Form add club</h2>
    <div class="col-lg-12 col-md-12">
        <?= $this->session->flashdata('message'); ?>
        <div class="mt-2"></div>
        <form action="<?= base_url() ?>home/add_club" method="POST">
            <div class="mb-3">
                <label for="nama_klub" class="form-label">Nama Klub 1</label>
                <input type="text" name="nama_klub" class="form-control" id="nama_klub">
                <?= form_error('nama_klub', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="kota_klub" class="form-label">Kota Klub</label>
                <input type="text" name="kota_klub" class="form-control" id="kota_klub">
                <?= form_error('kota_klub', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>