<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-hospital"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pendaftaran RS</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= ($pages == 'Dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manajemen Data
    </div>

    <li class="nav-item <?= ($pages == 'Data Pendaftaran') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('pendaftaran') ?>">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Data Pendaftaran</span></a>
    </li>

    <li class="nav-item <?= ($pages == 'Jadwal Pendaftaran') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('jadwal') ?>">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Jadwal Kalender</span></a>
    </li>

    <li class="nav-item <?= ($pages == 'Data Pasien') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('pasien') ?>">
            <i class="fas fa-fw fa-user-injured"></i>
            <span>Data Pasien</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaster"
            aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Master</span>
        </a>
        <div id="collapseMaster" class="collapse <?= ($pages == 'Data Poli' || $pages == 'Data Dokter' || $pages == 'Data User') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master:</h6>
                <a class="collapse-item <?= ($pages == 'Data Poli') ? 'active' : '' ?>" href="<?= base_url('poli') ?>">Data Poli</a>
                <a class="collapse-item <?= ($pages == 'Data Dokter') ? 'active' : '' ?>" href="<?= base_url('dokter') ?>">Data Dokter</a>
                <a class="collapse-item <?= ($pages == 'Data User') ? 'active' : '' ?>" href="<?= base_url('user') ?>">Data User</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>