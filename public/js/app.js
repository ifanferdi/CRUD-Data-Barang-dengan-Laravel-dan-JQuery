$(function () {
    tampilData();

    $('#formTambah').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
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

function tampilData() {
    $.get($(location).attr('href') + '/tampilData', {}, function (data) {
        $("#data").html(data);

    });
}
