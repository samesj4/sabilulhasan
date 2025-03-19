<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .container { margin-top: 50px; }
        .panel { border-radius: 10px; }
        .panel-heading { font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">Admin Dashboard</div>
        <div class="panel-body">
            <p>Selamat datang, <strong><?= $petugas->namapetugas; ?></strong>!</p>
            <p>Username: <strong><?= $petugas->username; ?></strong></p>
            <p>Role: <strong><?= ucfirst($petugas->jabatan); ?></strong></p>
            <a href="<?= base_url('out'); ?>" class="btn btn-danger"><i class="fa fa-sign-out"></i> Logout</a>

        </div>
    </div>
</div>

<!-- Bootstrap JS (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
