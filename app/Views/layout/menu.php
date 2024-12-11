<?= $this->extend('layout/main') ?>

<?= $this->section('menu') ?>
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= site_url('/') ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="<?= site_url('parts') ?>">
        <i class="bi bi-tools"></i>
        <span>Parts</span>
    </a>
</li>
<?= $this->endSection() ?>