<div class="container-fluid " id="div_petugas">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="row ">                         
                            <div class="col-md-12 input-group input-group-sm">
                                <input type="text" name="search_petugas_by" id="search_petugas_by" 
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
                                <a class="nav-link active" href="#" data-toggle="tab" onclick="form_tambah_petugas()"><i class="fa fa-plus-square"></i> Tambah  petugas</a>
                            </li>                           
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="list_petugas">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-sm text-xsmall" style="font-size: 12px;">
                        <thead class="bg bg-info">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Foto</th>
                                <th>Nama Petugas</th>
                                <th>Jabatan</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="data_list_petugas">
                            <!-- Data akan di-load dengan AJAX -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
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
                                <td colspan="2">
                                    <ul class="pagination justify-content-center">
                                        <!-- Pagination akan dimuat di sini -->
                                    </ul>
                                </td>
                                <td colspan="2" style="text-align: right">
                                    <label><small>Total petugas: <span id="total_petugas"></span></small></label>
                                </td>
                            </tr>
                            <tr>
                                
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5" id="petugas_tambah_edit">

        </div>
    </div>
</div>
<script>
function loadPetugas(page = 1) {
    var baris = $('#baris').val();
    var search_petugas_by = $('#search_petugas_by').val();

    $.ajax({
        url: "<?= site_url('Cpetugas/search_petugas') ?>",
        type: "POST",
        data: { page: page, baris: baris, search_petugas_by: search_petugas_by },
        dataType: "json",
        success: function (response) {
            if (response.sukses === 'ya') {
                $('#data_list_petugas').html(response.list_petugas);
                $('#total_petugas').text(response.total_petugas);

                var total_pages = Math.ceil(response.total_petugas / response.baris);
                var pagination_html = '';

                for (var i = 1; i <= total_pages; i++) {
                    var active = (i === response.current_page) ? 'active' : '';
                    pagination_html += '<li class="page-item ' + active + '">';
                    pagination_html += '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
                }

                $('.pagination').html(pagination_html);
                cancel_petugas();
            } else {
                $('#dataPetugas').html('<tr><td colspan="8">Tidak ditemukan</td></tr>');
                cancel_petugas();
            }
        },
        error: function (jqXHR, textStatus) {
            alert("Error: " + textStatus);
        }
    });
}

$(document).ready(function () {
    loadPetugas(1);  // Fungsi ini sekarang bisa dipanggil di mana saja

    $('#search_petugas_by, #baris').on('input change', function () {
        loadPetugas(1);
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        loadPetugas(page);
    });

    $('#search_petugas_by').focus();
});

function form_tambah_petugas() {
        $.post('tambah-petugas', function (Res) {
            $('#list_petugas').removeClass('col-md-12');
            $('#list_petugas').addClass('col-md-7');
            $('#petugas_tambah_edit').html(Res);
        });
}
function form_edit_petugas(id) {
        $.post('edit-petugas', {id: id}, function (Res) {
            $('#list_petugas').removeClass('col-md-12');
            $('#list_petugas').addClass('col-md-7');
            $('#petugas_tambah_edit').html(Res);
        });
}
function cancel_petugas() {
        $('#petugas_tambah_edit').html('');
        $('#list_petugas').removeClass('col-md-7');
        $('#list_petugas').addClass('col-md-12');
}
</script>