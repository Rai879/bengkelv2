<?= $this->extend('layout/menu') ?>

<?= $this->section('title'); ?>
<h1><i class="bi bi-tools"></i> Parts</h1>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <button type="button" onclick="window.location='<?= base_url('parts/add') ?>'" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Add Parts</button>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Nama</th>
                    <th>Price</th>
                    <th>Suite</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                foreach ($parts as $row):
                ?>
                    <tr>
                        <td><img class="img-thumbnail" style="width: 100px;" src="<?= $row['icon'] ?>" alt=""></td>
                        <td><?= $row['namaparts'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['suite'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td>
                            <button type="button" class="btn btn-success"
                            onclick="window.location='/parts/edit/<?= $row['idparts'] ?>'">
                                <i class="bi bi-pencil-square"></i></button>
                            <button type="button" class="btn btn-danger" 
                            onclick="deleteItem('<?= $row['idparts'] ?>', '<?= $row['namaparts'] ?>')">
                            <i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteItem(id, name) {
        Swal.fire({
            title: "Delete this parts?",
            html: `Are you sure want to delete <strong>${name}</strong>`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('parts/delete') ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: response.success,
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>