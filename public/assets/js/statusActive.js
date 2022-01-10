$(document).ready(function(){
    $('.toggle-class').on('change', function () {
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let idbarang = $(this).data('idbarang');
        // Jangan pakai attr, bakal error! Pakai prop
        // Ingat! prop untuk ubah boolean. Attr hanya untuk ubah string
        let status = $(this).prop('checked') === true ? 1 : 0;
        console.info(`Status: ${status}`);
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/merchantStatus',
            data: {
                'status': status, 
                'idbarang': idbarang
            },
            success: function(data) {
                console.log(data.status);
            }
        });
    });
});