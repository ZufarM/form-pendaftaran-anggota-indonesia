<?php

namespace App\Http\Controllers;

use App\AlamatDistricts;
use App\AlamatProvinces;
use App\AlamatRegencies;
use App\AlamatVillages;
use Illuminate\Http\Request;

class FormPendaftaranController extends Controller
{

    public function form_pendaftaran()
    {
        $provinsi = AlamatProvinces::get();
        return view('form_pendaftaran.index', compact('provinsi'));
    }

    public function data_wilayah(Request $request)
    {
        switch ($request->jenis) {
            // kabupaten
            case 'kota':
                $id_provinces = $request->id_provinces;
                if($id_provinces == ''){
                    exit;
                }else{
                    $data = AlamatRegencies::where('province_id', '=', $id_provinces)->get();
                    foreach($data as $d){
                        echo '<option value="'.$d->id.'">'.$d->name.'</option>';
                    }
                    exit;
                }
                break;

            // kecamatan
            case 'kecamatan':
                $id_regencies = $request->id_regencies;
                if($id_regencies == ''){
                    exit;
                }else{
                    $data = AlamatDistricts::where('regency_id', '=', $id_regencies)->get();
                    foreach($data as $d){
                        echo '<option value="'.$d->id.'">'.$d->name.'</option>';
                    }
                    exit;
                }
                break;

            // kelurahan
            case 'kelurahan':
                $id_district = $request->id_district;
                if($id_district == ''){
                    exit;
                }else{
                    $data = AlamatVillages::where('district_id', '=', $id_district)->get();
                    foreach($data as $d){
                        echo '<option value="'.$d->id.'">'.$d->name.'</option>';
                    }
                    exit;
                }
                break;
        }
    }
}
