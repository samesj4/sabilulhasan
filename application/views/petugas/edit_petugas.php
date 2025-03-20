<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Edit Data Petugas</h3>
    </div>
    <div class="card-body p-0">
        <form class="form-horizontal" id="data_edit_petugas">
            <div class="card-body">
                
                <input type="hidden" class="form-control form-control-sm" id="id" name="id" value="<?= $petugas['id'] ?>">

                <div class="form-group row">
                    <label for="namapetugas" class="col-sm-4 col-form-label">Nama Petugas</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="namapetugas" name="namapetugas" value="<?= $petugas['namapetugas'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="username" name="username" value="<?= $petugas['username'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="jabatan" name="jabatan" value="<?= $petugas['jabatan'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nohp" class="col-sm-4 col-form-label">No HP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nohp" name="nohp" value="<?= $petugas['nohp'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="level" class="col-sm-4 col-form-label">Level</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm" name="level" id="level">
                            <option value="">Pilih</option>
                            <option value="1" <?= ($petugas['level'] == 1) ? 'selected' : '' ?>>Super Admin</option>
                            <option value="2" <?= ($petugas['level'] == 2) ? 'selected' : '' ?>>Administrasi</option>
                            <option value="3" <?= ($petugas['level'] == 3) ? 'selected' : '' ?>>Keuangan</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="statususer" class="col-sm-4 col-form-label">Status User</label>
                    <div class="col-sm-8">
                        <select class="form-control form-control-sm" name="statususer" id="statususer">
                            <option value="aktif" <?= ($petugas['statususer'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= ($petugas['statususer'] == 'nonaktif') ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-4 col-form-label">Foto</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control form-control-sm" id="foto" name="foto">
                        <br>
                        <img src="<?= base_url('assets/image/petugas/' . $petugas['foto']) ?>" alt="Foto Petugas" width="100">
                    </div>
                </div>

            </div>            
        </form>
        <div class="card-footer p-1">
            <button type="submit" class="btn btn-danger" onclick="edit_data_petugas()">Edit Data Petugas</button>
            <button type="button" class="btn btn-default float-right" onclick="cancel_petugas()">Cancel</button>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#namapetugas').focus();
    });

    function edit_data_petugas() {
        let formData = new FormData($('#data_edit_petugas')[0]);

        $.ajax({
            url: '<?= site_url('Cpetugas/update_petugas') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.sukses === 'ya') {
                    alert('Data petugas berhasil diperbarui');
                    loadPetugas(1);
                } else {
                    alert('Gagal memperbarui data: ' + data.pesan);
                }
            }
        });
    }


</script>
