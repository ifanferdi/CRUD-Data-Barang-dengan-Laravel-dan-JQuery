$(function () {
    tampilData();

    $('#formCari').on('submit', function (e) {
        e.preventDefault();
        var cari = $('#cari').val();
        if (cari != "") {
            $.ajax({
                type: 'get',
                url: $(this).attr('action'),
                data: "key=" + cari,
                beforeSend: function () {
                    $('#formCari button[type=submit]').attr('disable', 'disabled');
                    $('#formCari button[type=submit]').html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function () {
                    $('#formCari button[type=submit]').removeAttr('disable');
                    $('#formCari button[type=submit]').html("<i class='fas fa-search'></i>");
                },
                success: function (data) {
                    $("#data").html(data);
                }
            });
        } else {
            tampilData();
        }
    });

    $('#cari').keyup(function () {
        var cari = $('#cari').val();
        if (cari == "") {
            tampilData();
        }
    });

    $('#formUbah').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('#formUbah .invalid-feedback').html('');
                $('#formUbah button[type=submit]').attr('disable', 'disabled');
                $('#formUbah .form-control').removeClass('is-invalid');
                $('#formUbah button[type=submit]').html("<i class='fa fa-spin fa-spinner'></i>");
            },
            complete: function () {
                $('#formUbah button[type=submit]').removeAttr('disable');
                $('#formUbah button[type=submit]').html("Ubah");
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('#formUbah #' + prefix).addClass('is-invalid');
                        $('#formUbah .' + prefix + '_error').html(val[0]);
                    });
                } else {
                    $.each(data.error, function (prefix, val) {
                        $('#formUbah #' + prefix).removeClass('is-invalid');
                        $('#formUbah .' + prefix + '_error').html('');
                        $('#formUbah')[0].reset();
                    });
                    alert(data.sukses);
                    $('#modalUbah').modal('toggle');
                    tampilData();
                }
            }
        });
    });

    $('#formUbah').on('reset', function () {
        $('#formUbah .form-control').html('');
        $('#formUbah .form-control').removeClass('is-invalid');
        $('#formUbah .invalid-feedback').html('');
    });

    $('#formHapus').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $('#formHapus button[type=submit]').attr('disable', 'disabled');
                $('#formHapus button[type=submit]').html("<i class='fa fa-spin fa-spinner'></i>");
            },
            complete: function () {
                $('#formHapus button[type=submit]').removeAttr('disable');
                $('#formHapus button[type=submit]').html("Hapus");
            },
            success: function (data) {
                alert(data.sukses);
                $('#modalHapus').modal('toggle');
                tampilData();
            }
        });
    });

    $('#formTambah').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(document).find('#formTambah .invalid-feedback').html('');
                $('#formTambah button[type=submit]').attr('disable', 'disabled');
                $('#formTambah .form-control').removeClass('is-invalid');
                $('#formTambah button[type=submit]').html("<i class='fa fa-spin fa-spinner'></i>");
            },
            complete: function () {
                $('#formTambah button[type=submit]').removeAttr('disable');
                $('#formTambah button[type=submit]').html("Simpan");
            },
            success: function (data) {
                if (data.status == 0) {
                    $.each(data.error, function (prefix, val) {
                        $('#formTambah #' + prefix).addClass('is-invalid');
                        $('#formTambah .' + prefix + '_error').html(val[0]);
                    });
                } else {
                    $.each(data.error, function (prefix, val) {
                        $('#formTambah #' + prefix).removeClass('is-invalid');
                        $('#formTambah .' + prefix + '_error').html('');
                    });
                    $('#formTambah')[0].reset();
                    alert(data.sukses);
                    $('#modalTambah').modal('toggle');
                    tampilData();
                }
            }
        });
    });

    $('#formTambah').on('reset', function () {
        $('#formTambah .form-control').html('');
        $('#formTambah .form-control').removeClass('is-invalid');
        $('#formTambah .invalid-feedback').html('');
    });
});

function hapus(id) {
    $('#modalHapus').modal('show');
    $('#modalHapus form').attr('action', $(location).attr('href') + '/' + id)
}

function ubah(idBarang) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $(location).attr('href') + '/getInventory',
        data: "id=" + idBarang,
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#modalUbah').modal('show');
            $('#modalUbah #gambar').val('')
            $('#modalUbah form').attr('action', $(location).attr('href') + '/' + idBarang + '/edit');
            $('#modalUbah #nama_barang').val(data.nama_barang);
            $('#modalUbah #kode_barang').val(data.kode_barang);
            $('#modalUbah #harga_jual').val(data.harga_jual);
            $('#modalUbah #harga_beli').val(data.harga_beli);
            $('#modalUbah #stok').val(data.stok);
            $('#modalUbah #gambarLama').val(data.gambar);
            $('#modalUbah .img-preview').attr('src', 'http://localhost:8000/' + 'storage/' + data.gambar);
            $('#modalUbah .img-preview').addClass('mb-3');
        }
    });
}

function tampilData() {
    $.get($(location).attr('href') + '/tampilData', {}, function (data) {
        $("#data").html(data);
    });
}
