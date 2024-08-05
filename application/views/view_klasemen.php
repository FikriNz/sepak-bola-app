<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">View Klasemen</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!-- <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div> -->
        </div>
    </div>

    <h2>Section title</h2>
    <div class="table-responsive small">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Klub</th>
                    <th scope="col">Ma</th>
                    <th scope="col">Me</th>
                    <th scope="col">S</th>
                    <th scope="col">K</th>
                    <th scope="col">GM</th>
                    <th scope="col">GK</th>
                    <th scope="col">Point</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data as $d) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d->nama_klub ?></td>
                        <td><?= $d->main ?></td>
                        <td><?= $d->menang ?></td>
                        <td><?= $d->seri ?></td>
                        <td><?= $d->kalah ?></td>
                        <td><?= $d->goal_menang ?></td>
                        <td><?= $d->goal_kalah ?></td>
                        <td><?= $d->point ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>