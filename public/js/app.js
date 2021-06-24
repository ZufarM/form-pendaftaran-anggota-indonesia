$( document ).ready(function() {
    //untuk memanggil plugin select2
    $('#provinsi').select2({
        placeholder: 'Pilih Provinsi',
        language: "id"
    });
    $('#kota').select2({
        placeholder: 'Pilih Kota/Kabupaten',
        language: "id"
    });
    $('#kecamatan').select2({
        placeholder: 'Pilih Kecamatan',
        language: "id"
    });
    $('#kelurahan').select2({
        placeholder: 'Pilih Kelurahan',
        language: "id"
    });

    //saat pilihan provinsi di pilih, maka akan mengambil data kota
    //di data-wilayah.php menggunakan ajax
    $("#provinsi").change(function(){
        $("img#load1").show();
        var id_provinces = $(this).val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "data-wilayah.php?jenis=kota",
            data: "id_provinces="+id_provinces,
            success: function(msg){
                $("select#kota").html(msg);
                $("img#load1").hide();
                getAjaxKota();
            }
        });
    });

    //saat pilihan kota di pilih, maka akan mengambil data kecamatan
    //di data-wilayah.php menggunakan ajax
    $("#kota").change(getAjaxKota);
    function getAjaxKota(){
        $("img#load2").show();
        var id_regencies = $("#kota").val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "data-wilayah.php?jenis=kecamatan",
            data: "id_regencies="+id_regencies,
            success: function(msg){
                $("select#kecamatan").html(msg);
                $("img#load2").hide();
                getAjaxKecamatan();
            }
        });
    }

    //saat pilihan kecamatan di pilih, maka akan mengambil data kelurahan
    //di data-wilayah.php menggunakan ajax
    $("#kecamatan").change(getAjaxKecamatan);
    function getAjaxKecamatan(){
        $("img#load3").show();
        var id_district = $("#kecamatan").val();
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "data-wilayah.php?jenis=kelurahan",
            data: "id_district="+id_district,
            success: function(msg){
                $("select#kelurahan").html(msg);
                $("img#load3").hide();
            }
        });
    }
});
