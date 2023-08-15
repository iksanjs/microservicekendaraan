<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $primaryKey = 'id';
    protected $fillable = ['no_polisi', 'merk', 'tipe', 'kategori', 'kondisi', 'no_rangka', 'no_mesin',
                        'tahun', 'warna', 'tanggal_beli', 'harga_off', 'bbn', 'otr', 'karoseri', 'total',
                        'rate', 'harga_sewa', 'lokasi', 'status', 'approval', 'keterangan'];

}