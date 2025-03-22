<div class="card card-info">
    <div class="card-header p-2">
        <h6 class="card-title">Tambahkan Data berita</h6>
    </div>
    <div class="card-body p-2">
        <form class="form-horizontal" id="data_simpan_berita" enctype="multipart/form-data">
            <div class="card-body p-2">

                <div class="form-group row">
                    <label for="namaberita" class="col-sm-4 col-form-label col-form-label-sm">Judul berita</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="namaberita" name="namaberita">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jabatan" class="col-sm-4 col-form-label col-form-label-sm">Tanggal</label>
                    <div class="col-sm-8">
                        <input type="date" id="tanggal" name="tanggal">
                    </div>
                </div>

                
                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label col-form-label-sm">Ringkasan</label>
                    <div class="col-sm-8">
                    <textarea id="ringkasan" name="ringkasan" rows="4" cols="50"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-4 col-form-label col-form-label-sm">Gambar</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control form-control-sm" id="foto" name="foto">
                    </div>
                </div>
            </div>
        </form>
        <div class="card-footer p-2 text-right">
            <button type="submit" class="btn btn-sm btn-info" onclick="tambah_data_berita()">Simpan</button>
            <button type="button" class="btn btn-sm btn-default" onclick="cancel_berita()">Batal</button>
        </div>
    </div>
</div>


<script>
    function tambah_data_berita() {
        var formData = new FormData($('#data_simpan_berita')[0]);

        $.ajax({
            url: '<?php echo site_url('Cberita/simpan_berita') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    loadberita(1);
                } else {
                    alert_pesan('error', data.pesan);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Gagal menyimpan data!");
            }
        });
    }

   
</script>
