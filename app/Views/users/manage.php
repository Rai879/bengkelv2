<?= $this->extend('layout/menu') ?>

<?= $this->section('title'); ?>
<h1><i class="bi bi-person-plus"></i> Manage Users</h1>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Form untuk menambah atau mengubah pengguna -->
<form method="POST" action="<?= base_url('users/save') ?>">
    <input type="hidden" name="id" value="<?= isset($user) ? $user['id'] : '' ?>">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= isset($user) ? $user['username'] : '' ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" <?= !isset($user) ? 'required' : '' ?>>
    </div>
    <div class="mb-3">
        <label for="level" class="form-label">Level</label>
        <select class="form-select" id="level" name="level" required>
            <option value="admin" <?= isset($user) && $user['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="staff" <?= isset($user) && $user['level'] == 'staff' ? 'selected' : '' ?>>Staff</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<!-- Tabel untuk menampilkan pengguna -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['level'] ?></td>
            <td>
                <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn btn-warning">Edit</a>
                <a href="<?= base_url('users/delete/' . $user['id']) ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?> 