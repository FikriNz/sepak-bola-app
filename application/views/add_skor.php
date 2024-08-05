<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Skor</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
            </div>
        </div>
    </div>

    <h2>Form add skor</h2>
    <div class="col-lg-12 col-md-12">
        <?= $this->session->flashdata('message'); ?>
        <div class="mt-2"></div>
        <form action="<?= base_url() ?>home/add_skor" method="POST">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="nama_klub1" class="form-label">Nama Klub 1</label>
                        <!-- <input type="text" name="nama_klub1" class="form-control" id="nama_klub1"> -->
                        <select name="nama_klub1" id="nama_klub1" class="form-control">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach ($club as $c1) {
                            ?>
                                <option value="<?= $c1->rowid ?>"><?= $c1->nama_klub; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?= form_error('nama_klub1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="nama_klub2" class="form-label">Nama Klub 2</label>
                        <!-- <input type="text" name="nama_klub2" class="form-control" id="nama_klub2"> -->
                        <select name="nama_klub2" id="nama_klub2" class="form-control">
                            <option value="">--Pilih--</option>
                            <?php
                            foreach ($club as $c2) {
                            ?>
                                <option value="<?= $c2->rowid ?>"><?= $c2->nama_klub; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <?= form_error('nama_klub2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="skor_klub1" class="form-label">Skor Klub 1</label>
                        <input type="text" name="skor_klub1" class="form-control" id="skor_klub1">
                        <?= form_error('skor_klub1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="skor_klub2" class="form-label">Skor Klub 2</label>
                        <input type="text" name="skor_klub2" class="form-control" id="skor_klub2">
                        <?= form_error('skor_klub2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>