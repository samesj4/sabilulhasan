<div class="container-fluid " id="div_berita">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">                         
                            <div class="col-md-12 input-group input-group-sm">
                                <input type="text" name="search_berita_by" id="search_berita_by" 
								class="form-control float-right" placeholder="Berdasarkan Nama">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>

                    </div>
                    <div class="card-tools">                        
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_berita()"><i class="fa fa-plus-square"></i> Tambah  berita</a>
                            </li>                           
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_berita">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-sm text-xsmall" style="font-size: 12px;">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 250px;">Judul berita</th>
                                <th>Tanggal</th>
                                <th style="width: 750px;">Ringkasan</th>                             
                            </tr>
                        </thead>
                        <tbody id="data_list_berita">
                            <!-- Data akan di-load dengan AJAX -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="col-sm-12 form-group row float-left" style="margin-bottom: 0px;">
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-sm" name="baris" id="baris">
                                                <option value="10">10</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                                <option value="500">500</option>
                                                <option value="all">Semua</option>
                                            </select>
                                        </div>
                                        <label for="baris" class="col-sm-3 col-form-label">Baris Data</label>
                                    </div>
                                </td>
                                <td >
                                    <ul class="pagination justify-content-center">
                                        <!-- Pagination akan dimuat di sini -->
                                    </ul>
                                </td>
                                <td  style="text-align: right">
                                    <label><small>Total berita: <span id="total_berita"></span></small></label>
                                </td>
                            </tr>
                            <tr>
                                
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="berita_tambah_edit">

        </div>
    </div>
</div>
<script>
function loadberita(page = 1) {
    var baris = $('#baris').val();
    var search_berita_by = $('#search_berita_by').val();

    $.ajax({
        url: "<?= site_url('Cberita/search_berita') ?>",
        type: "POST",
        data: { page: page, baris: baris, search_berita_by: search_berita_by },
        dataType: "json",
        success: function (response) {
            if (response.sukses === 'ya') {
                $('#data_list_berita').html(response.list_berita);
                $('#total_berita').text(response.total_berita);

                var total_pages = Math.ceil(response.total_berita / response.baris);
                var pagination_html = '';

                for (var i = 1; i <= total_pages; i++) {
                    var active = (i === response.current_page) ? 'active' : '';
                    pagination_html += '<li class="page-item ' + active + '">';
                    pagination_html += '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                }

                $('.pagination').html(pagination_html);
                cancel_berita();
            } else {
                $('#databerita').html('<tr><td colspan="8">Tidak ditemukan</td></tr>');
                cancel_berita();
            }
        },
        error: function (jqXHR, textStatus) {
            alert("Error: " + textStatus);
        }
    });
}

$(document).ready(function () {
    loadberita(1);  // Fungsi ini sekarang bisa dipanggil di mana saja

    $('#search_berita_by, #baris').on('input change', function () {
        loadberita(1);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        loadberita(page);
    });

    $('#search_berita_by').focus();
});

function form_tambah_berita() {
        $.post('tambah-berita', function (Res) {
            $('#list_berita').removeClass('col-md-12');
            $('#list_berita').addClass('col-md-7');
            $('#berita_tambah_edit').html(Res);
        });
}
function form_edit_berita(id) {
        $.post('edit-berita', {id: id}, function (Res) {
            $('#list_berita').removeClass('col-md-12');
            $('#list_berita').addClass('col-md-7');
            $('#berita_tambah_edit').html(Res);
        });
}

function form_hapus_berita(id){
        $.post('hapus-berita', {id: id}, function (Res) {
            alert_pesan('success', 'Data berhasil dihapus');
            loadberita(1);
        });
}

function cancel_berita() {
        $('#berita_tambah_edit').html('');
        $('#list_berita').removeClass('col-md-7');
        $('#list_berita').addClass('col-md-12');
}
</script>