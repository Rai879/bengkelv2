<?= $this->extend('layout/menu') ?>

<?= $this->section('title'); ?>
<h1><i class="bi bi-tools"></i> Edit Parts</h1>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header mb-3">
        <button type="button" onclick="window.location='<?= base_url('parts') ?>'" class="btn btn-warning"><i class="bi bi-backspace-fill"></i> Back</button>
    </div>
    <div class="card-body">
        <div class="card-title">

        </div>
        <?= form_open_multipart('', ['id' => 'formSave']) ?>
        <?= csrf_field() ?>
        <input type="hidden" value="<?= $id ?>" id="id" name="id">
        <div class="row mb-3">
            <label for="nameparts" class="col-sm-2 col-form-label">Parts Name</label>
            <div class="col-sm-10" style="height: 60px;">
                <input type="text" class="form-control" value="<?= $nameparts ?>" name="nameparts" id="nameparts">
                <div class="invalid-feedback" id="errorName">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="price" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10" style="height: 60px;">
                <input type="text" class="form-control" value="<?= $price ?>" name="price" id="price">
                <div class="invalid-feedback" id="errorPrice">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="suite" class="col-sm-2 col-form-label">Suite</label>
            <div class="col-sm-10" style="height: 60px;">
                <input type="text" class="form-control" value="<?= $suite ?>" name="suite" id="suite">
                <div class="invalid-feedback" id="errorSuite">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
            <div class="col-sm-10" style="height: 60px;">
                <input type="number" class="form-control" value="<?= $quantity ?>" name="quantity" id="quantity">
                <div class="invalid-feedback" id="errorQuantity"></div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="currentImage" class="col-sm-2 col-form-label">Current Image</label>
            <div class="col-sm-10">
                <img src="<?= $icon ?>" class="img-thumbnail" style="width: 300px" alt="">
            </div>
        </div>
        <div class="row mb-3">
            <label for="iconUpload" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-10" style="height: 60px;">

                <input type="file" class="form-control" name="iconUpload" id="iconUpload">
                <div class="invalid-feedback" id="errorIconUpload">
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" id="updateParts" class="btn btn-primary">Submit</button>
        </div>
        <?= form_close() ?>
    </div>
</div>

<script>
    $('#updateParts').click(function(e) {
        e.preventDefault();

        let form = $('#formSave')[0];

        let data = new FormData(form);

        $.ajax({
            type: "post",
            url: "<?= site_url('parts/update') ?>",
            data: data,
            dataType: "json",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('#updateParts').prop('disabled', true)
                $('#updateParts').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function() {
                $('#updateParts').prop('disabled', false)
                $('#updateParts').html('Save')
            },
            success: function(response) {
                if (response.error) {
                    let dataError = response.error;
                    if (dataError.errorName) {
                        $('#errorName').html(dataError.errorName).show();
                        $('#nameparts').addClass('is-invalid');
                    } else {
                        $('#errorName').fadeOut();
                        $('#nameparts').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorPrice) {
                        $('#errorPrice').html(dataError.errorPrice).show();
                        $('#price').addClass('is-invalid');
                    } else {
                        $('#errorPrice').fadeOut();
                        $('#price').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorSuite) {
                        $('#errorSuite').html(dataError.errorSuite).show();
                        $('#suite').addClass('is-invalid');
                    } else {
                        $('#errorSuite').fadeOut();
                        $('#suite').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorPassword) {
                        $('#errorPassword').html(dataError.errorPassword).show();
                        $('#password').addClass('is-invalid');
                    } else {
                        $('#errorPassword').fadeOut();
                        $('#password').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorPasswordConfirm) {
                        $('#errorPasswordConfirm').html(dataError.errorPasswordConfirm).show();
                        $('#password_confirm').addClass('is-invalid');
                    } else {
                        $('#errorPasswordConfirm').fadeOut();
                        $('#password_confirm').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorLevel) {
                        $('#errorLevel').html(dataError.errorLevel).show();
                        $('#level').addClass('is-invalid');
                    } else {
                        $('#errorLevel').fadeOut();
                        $('#level').removeClass('is-invalid').addClass('is-valid');
                    }
                    if (dataError.errorUploadImage) {
                        $('#errorUploadImage').html(dataError.errorUploadImage).show();
                        $('#image').addClass('is-invalid');
                    } else {
                        $('#errorUploadImage').fadeOut();
                        $('#image').removeClass('is-invalid').addClass('is-valid');
                    }
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        html: response.success
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location="<?= site_url('parts') ?>";
                        }
                    });
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    })
</script>
<?= $this->endSection() ?>