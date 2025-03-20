<div class="card card-info">
    <div class="card-header p-2">
        <h6 class="card-title">Tambahkan Data Petugas</h6>
    </div>
    <div class="card-body p-2">
        <form class="form-horizontal" id="data_simpan_petugas" enctype="multipart/form-data">
            <div class="card-body p-2">

                <div class="form-group row">
                    <label for="namapetugas" class="col-sm-4 col-form-label col-form-label-sm">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="namapetugas" name="namapetugas">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jabatan" class="col-sm-4 col-form-label col-form-label-sm">Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label col-form-label-sm">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control form-control-sm" id="alamat" name="alamat"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nohp" class="col-sm-4 col-form-label col-form-label-sm">No HP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nohp" name="nohp">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-4 col-form-label col-form-label-sm">Foto</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control form-control-sm" id="foto" name="foto">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label col-form-label-sm">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="username" name="username">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label col-form-label-sm">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control form-control-sm" id="password" name="password">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="level" class="col-sm-4 col-form-label col-form-label-sm">Level</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm" name="level" id="level">
                            <option value="">Pilih</option>
                            <option value="1">Super Admin</option>
                            <option value="2">Administrasi</option>
                            <option value="3">Keuangan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="statususer" class="col-sm-4 col-form-label col-form-label-sm">Status</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm" name="statususer" id="statususer">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

            </div>
        </form>
        <div class="card-footer p-2 text-right">
            <button type="submit" class="btn btn-sm btn-info" onclick="tambah_data_petugas()">Simpan</button>
            <button type="button" class="btn btn-sm btn-default" onclick="cancel_petugas()">Batal</button>
        </div>
    </div>
</div>


<script>
    function tambah_data_petugas() {
        var formData = new FormData($('#data_simpan_petugas')[0]);

        $.ajax({
            url: '<?php echo site_url('Cpetugas/simpan_petugas') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert_pesan('success', data.pesan);
                    loadPetugas(1);
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
