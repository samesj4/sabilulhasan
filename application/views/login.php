<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sabilulhasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('vendor/dist/img/AdminLTELogo.png'); ?>" />

    <!-- Bootstrap CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- AdminLTE (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/css/AdminLTE.min.css">

    <!-- jQuery (CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

    <style>
        .panel-footer { padding-top: 0; padding-bottom: 0; }
        .small-box { margin-bottom: 0; border: none; }
        #h1 { font-family: Calibri; padding: 0; margin: 15px 0 0; font-size: 18px; }
        #h2 { font-family: Calibri; padding: 0; margin: 0 0 15px; font-size: 30px; font-weight: bold; }
        .alert-danger { display: none; padding: 5px; margin-bottom: 10px; }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="panel panel-success">
            <div class="small-box bg-primary">
                <div class="inner text-center">
                    <h4 id="h1">App . <b>SABILUL HASAN</b></h4>
                    <h4 id="h2">Administrasi Santri</h4>
                </div>
                <div class="icon">
                    <i class="fa fa-line-chart"></i>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="login-box-body text-center">
                        <form id="form_login">
                            <div class="form-group has-feedback">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                <span class="fa fa-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <span class="ion-android-lock form-control-feedback"></span>
                            </div>
                            <input type="hidden" id="csrf_token" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="alert alert-danger" id="tampil_pesan"></div>
                            <div class="form-group text-right">
                                <button type="button" id="masuk" class="btn btn-primary btn-sm btn-flat">Masuk</button>
                                <button type="button" id="batal" class="btn btn-default btn-sm btn-flat">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tampil_pesan(teks) {
            $("#tampil_pesan").html(teks).fadeIn().delay(2000).fadeOut();
        }

        $(document).ready(function () {
            $("#username").focus();

            $("#username, #password").keypress(function (e) {
                if (e.which === 13) {
                    $("#masuk").click();
                }
            });

            $("#batal").click(function () {
                $("#username, #password").val("");
                $("#tampil_pesan").hide();
            });

            $("#masuk").click(function () {
                var username = $("#username").val();
                var password = $("#password").val();
                var csrf_token = $("#csrf_token").val();

                if (username === "" || password === "") {
                    tampil_pesan("<i class='glyphicon glyphicon-alert'></i> Username dan Password wajib diisi.");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "<?= site_url('Clogin/auten'); ?>",
                    data: {
                        username: username,
                        password: password,
                        "<?= $this->security->get_csrf_token_name(); ?>": csrf_token // Gunakan nama token CSRF yang benar
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.pesan === "sukses") {
                            window.location.href = data.redirect;
                        } else {
                            tampil_pesan(data.pesan);
                        }
                    },
                    error: function () {
                        tampil_pesan("<i class='glyphicon glyphicon-alert'></i> Terjadi kesalahan, coba lagi.");
                    }
                });
            });

        });
    </script>
</body>
</html>

