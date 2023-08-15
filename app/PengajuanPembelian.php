<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class PengajuanPembelian extends Model
{
    protected $table = 'pengajuan_pembelians';
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $primaryKey = 'id_pengajuanpembelian';
    protected $fillable = ['nama_p_dealer', 'tanggal_p_dealer', 'harga_p_dealer', 
                        'nama_pt_karoseri', 'tanggal_p_karoseri', 'harga_p_karoseri', 
                        'dealer', 'merk', 'tipe', 'tahun', 'warna', 'deskripsi', 
                        'harga', 'bbn', 'otr', 'karoseri', 'total', 'id_sppk', 'approval', 'keterangan', 'status_transaksi'];

    public static function getDataFromLumenSewa($id_sppk)
    {
        $url = 'http://localhost:8003/api/sewa/sppks/' . $id_sppk;

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                return $response->json();
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

    // ...
}