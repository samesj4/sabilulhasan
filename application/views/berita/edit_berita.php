<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Data berita</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_berita">
            <div class="card-body">
                
                <input type="hidden" class="form-control form-control-sm" id="id" name="id" value="<?= $berita['id'] ?>">

                <div class="form-group row">
                    <label for="namaberita" class="col-sm-4 col-form-label">Judul</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="judul" name="judul" value="<?= $berita['judul'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm-8">
                        <input type="date" id="tanggal" name="tanggal" value="<?= $berita['tanggal'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label col-form-label-sm">Ringkasan</label>
                    <div class="col-sm-8">
                    <textarea id="ringkasan" name="ringkasan" rows="4" cols="50"><?= $berita['ringkasan'] ?> </textarea>
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="foto" class="col-sm-4 col-form-label">Gambar</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control form-control-sm" id="foto" name="foto">
                        <br>
                        <img src="<?= base_url('assets/image/berita/' . $berita['gambar']) ?>" alt="Foto berita" width="100">
                    </div>
                </div>

            </div>            
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger" onclick="edit_data_berita()">Edit Data berita</button>
            <button type="button" class="btn btn-default float-right" onclick="cancel_berita()">Cancel</button>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#namaberita').focus();
    });

    function edit_data_berita() {
        let formData = new FormData($('#data_edit_berita')[0]);

        $.ajax({
            url: '<?= site_url('Cberita/update_berita') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert('Data berita berhasil diperbarui');
                    loadberita(1);
                } else {
                    alert('Gagal memperbarui data: ' + data.pesan);
                }
            }
        });
    }


</script>
