<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary" style="height: 100vh;">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">App Sepak Bola</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url() ?>home/add_club">
                                <i class='bx bx-edit fs-6'></i> Input Data Klub
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url() ?>home/add_skor">
                                <i class='bx bx-edit-alt fs-6'></i> Input Data Skor A
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url() ?>home/add_skor_multipe">
                                <i class='bx bx-edit-alt fs-6'></i> Input Data Skor B
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url() ?>home/view_klasemen">
                                <i class='bx bx-grid-alt fs-6'></i> View Klasemen
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 text-danger" href="<?= base_url() ?>home/clear_data">
                                <i class='bx bx-trash fs-6'></i> Delete Data
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>