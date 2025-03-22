<!DOCTYPE html>
<html lang="en">
    <?php
    if (isset($this->session->userdata['logged_in'])) {
        $nama = $petugas->namapetugas;
        $level = $petugas->level;
        $jabatan = $petugas->jabatan;
        $foto = $petugas->foto;

    } else {
        header("location:login");
    }
    ?>
    <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sabilul Hasan</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="https://cdn.jsdelivr.net/gh/yourrepo/vendor/dist/img/AdminLTELogo.png" />

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Overlay Scrollbars (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.6.3/styles/overlayscrollbars.min.css">

    <!-- SweetAlert2 Theme Bootstrap 4 (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.2/sweetalert2.min.css">

    <!-- AdminLTE (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    <!-- EasyAutocomplete (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/EasyAutocomplete/1.3.5/easy-autocomplete.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/EasyAutocomplete/1.3.5/easy-autocomplete.themes.min.css">

    <!-- jQuery UI (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.min.css">

    <!-- Daterangepicker (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.css">

    <!-- Bootstrap Colorpicker (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.min.css">

    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-light navbar-white">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block" id="nama_link">
                        <a href="#" class="nav-link">Home / <small> Dashboard</small></a>
                    </li>                    
                </ul>
                <ul class="navbar-nav ml-auto">                    
                    <li class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="keluar"  href="<?= base_url('out'); ?>"><i class="fas fa-times"></i></a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar elevation-4 sidebar-dark-primary">
                <a href="#" class="brand-link ">
                    <img src="<?= site_url(); ?>assets/image/logo/logo.png" alt="Sip-Bos" class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-dark" style="color: white">Sabilul Hasan</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                        <img src="<?= site_url(); ?>assets/image/petugas/<?= empty($foto) ? 'default.jpg' : $foto; ?>" 
     class="img-circle elevation-2" alt="User Image">

                           
                        </div>
                        <div class="info">
                            <?php
                            if ($level=="1"){
                                $lvl="Super Admin";
                            }else if($level=="2"){
                                $lvl="Administrasi";
                            }else if($level=="3"){
                                $lvl="Keuangan";
                            }
                            ?>
                            <a href="#" class="d-block"><?= $nama ?></a>
                            <a href="#" class="d-block"><?= '<b>'.$lvl . '</b> ' . $jabatan ?></a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column  nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="#" class="nav-link active" onclick="home()">
                                    <i class="nav-icon fas fa-envelope "></i>
                                    <p>
                                        Home
                                    </p>
                                </a>
                            </li>
<<<<<<< HEAD
=======
                            <li class="nav-item">
                                <a href="#" class="nav-link " onclick="berita()">
                                    <i class="nav-icon fas fa-newspaper "></i>
                                    <p>
                                        Berita
                                    </p>
                                </a>
                            </li>
>>>>>>> ba995a9 (Menyelesaikan berita)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>
                                        Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                               <?php if ($level == "1") {
                                ?>
                                 <li class="nav-item" onclick="petugas()">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>PETUGAS</p>
                                        </a>
                                    </li>
                                <?php
                                }else{
                                    
                                }?>
                                   
                                    <!-- <li class="nav-item" onclick="santri()">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Santri</p>
                                        </a>
                                    </li>
                                     -->
                                    
                                    
                                    
									
                                </ul>
                            </li>
                            
                            
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-wrench"></i>
                                    <p>
                                        Santri
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item" onclick="santri()">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Santri</p>
                                        </a>
                                    </li>
                                    <li class="nav-item" onclick="data()">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Data</p>
                                        </a>
                                    </li>
                                   
                                    
									
                                </ul>
                            </li>
                          
                            
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-book mr-2"></i>
                                    <p>
                                        Keuangan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="settingkeuangan()">
                                            <i class="far fa-circle nav-icon text-primary"></i>
<<<<<<< HEAD
                                            <p>Settomg</p>
=======
                                            <p>Setting</p>
>>>>>>> ba995a9 (Menyelesaikan berita)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="dataorderbelum()">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Bayar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="dataorder()">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Data</p>
                                        </a>
                                    </li>                                  
                                </ul>
                            </li>
                            
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-users mr-2"></i>
                                    <p>
                                        Laporan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" onclick="laporan()">
                                            <i class="far fa-circle nav-icon text-primary"></i>
                                            <p>Laporan</p>
                                        </a>
                                    </li>                                   
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header"></div>
                <section class="content">
                    <!--konten-->
                    
                </section> 
            </div>
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
        <!-- jQuery (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Bootstrap Bundle (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

        <!-- Moment.js (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

        <!-- Inputmask (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

        <!-- Overlay Scrollbars (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/2.6.3/browser/overlayscrollbars.browser.es6.min.js"></script>

        <!-- SweetAlert2 (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.2/sweetalert2.all.min.js"></script>

        <!-- jQuery UI (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

        <!-- AdminLTE (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

        <!-- Chart.js (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

        <!-- EasyAutocomplete (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/EasyAutocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>

        <!-- Daterangepicker (CDN) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.min.js"></script>

    </body>

    <script type="text/javascript">
                                    $(function () {
                                        home();
                                    });
                                    function remove_add_class() {
                                        $('.nav-pills li a').click(function () {
                                            $('.nav-pills li a').removeClass('active');
                                            $(this).addClass('active');
                                        });
                                    }
                                    

                                    function home() {
                                        $.post('Home', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Home / <small> Dashboard</small></a>');
                                            remove_add_class();
                                        });
                                    }
<<<<<<< HEAD
=======

                                    function berita() {
                                        $.post('Berita', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Home / <small> Dashboard</small></a>');
                                            remove_add_class();
                                        });
                                    }
>>>>>>> ba995a9 (Menyelesaikan berita)
                                    function petugas() {
                                        $.post('Petugas', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Master / <small>  Petugas</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function anggota() {
                                        $.post('Anggota', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Master / <small>  Anggota</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function toko() {
                                        $.post('Tokoku', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Master / <small>  Toko</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function customer() {
                                        $.post('Customer', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Master / <small>  Customer</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function model() {
                                        $.post('Model', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Master / <small>  Model</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function penjualan() {
                                        $.post('Penjualan', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Penjualan / <small> Transaksi </small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function datapenjualan() {
                                        $.post('datapenjualan', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Penjualan / <small> Transaksi </small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function dataorder() {
                                        $.post('dataorder', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Order / <small> Order </small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function dataorderbelum() {
                                        $.post('dataorderbelum', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Order / <small> Order Belum</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function selisih() {
                                        $.post('selisih', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">SELISIH / <small> Selisih Harga </small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function persentase() {
                                        $.post('Persentase', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Master Data / <small> persentase </small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    
                                    function modal() {
                                        $.post('modal', function (Res) {
                                            $('.content').html(Res);
                                            $('#nama_link').html('<a href="#" class="nav-link">Lihat Modal / <small> Tambah Modal </small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function tarik() {
                                        $.post('pengeluaran', function (Res) {
                                            $('.content').html(Res);
											$('#nama_link').html('<a href="#" class="nav-link">modal / <small> Dashboard</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    
                                    function historykas() {
                                        $.post('historykas', function (Res) {
                                            $('.content').html(Res);
											$('#nama_link').html('<a href="#" class="nav-link">modal / <small> Dashboard</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function datapenjualananggota() {
                                        $.post('penjualananggota', function (Res) {
                                            $('.content').html(Res);
											$('#nama_link').html('<a href="#" class="nav-link">penjualananggota / <small> Transaksi</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    function piutang() {
                                        $.post('piutang', function (Res) {
                                            $('.content').html(Res);
											$('#nama_link').html('<a href="#" class="nav-link">piutang / <small> Data</small></a>');
                                            remove_add_class();
                                        });
                                    }
                                    
                                    function rp(angkanya) {
                                        var rupiah = new Intl.NumberFormat(['ban', 'id']).format(angkanya);
                                        return rupiah;
                                    }
                                    function alert_pesan(statusnya, pesannya) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                        Toast.fire({
                                            type: statusnya,
                                            title: pesannya
                                        });
                                    }
    </script>
</html>



