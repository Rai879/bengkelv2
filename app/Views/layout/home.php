<?= $this->extend('layout/menu') ?>

<?= $this->section('title'); ?>
<h1><i class="bi bar-chart-line-fill"></i> Dashboard</h1>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
    Welcome to Dashboard!
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?= $this->endSection() ?>