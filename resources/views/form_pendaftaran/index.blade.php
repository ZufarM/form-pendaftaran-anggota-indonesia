<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pendaftaran Anggota Perpustakaan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('select2-4.0.6-rc.1/dist/css/select2.min.css')}}">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('select2-4.0.6-rc.1/dist/js/select2.min.js')}}"></script>
    <script src="{{ asset('select2-4.0.6-rc.1/dist/js/i18n/id.js')}}"></script>
</head>
<body>
<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-offset-2  col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Form Pendaftaran Anggota Perpustakaan</b></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nama lengkap</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="nama_lengkap" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Provinsi</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="provinsi" id="provinsi">
                                    <option></option>
                                    @foreach($provinsi as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ asset('img/loading.gif')}}" width="35" id="load1" style="display:none;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" >Kota/Kabupaten</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kota" id="kota">
                                    <option></option>
                                </select>
                                <img src="{{ asset('img/loading.gif')}}" width="35" id="load2" style="display:none;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" >Kecamatan</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kecamatan" id="kecamatan">
                                    <option></option>
                                </select>
                                <img src="{{ asset('img/loading.gif')}}" width="35" id="load3" style="display:none;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" >Kelurahan</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kelurahan" id="kelurahan">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-default">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
                url: "{{ route('data_wilayah') }}?jenis=kota",
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
                url: "{{ route('data_wilayah') }}?jenis=kecamatan",
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
                url: "{{ route('data_wilayah') }}?jenis=kelurahan",
                data: "id_district="+id_district,
                success: function(msg){
                    $("select#kelurahan").html(msg);
                    $("img#load3").hide();
                }
            });
        }
    });

</script>
</body>
</html>
