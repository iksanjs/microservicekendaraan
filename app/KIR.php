<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KIR extends Model
{
    protected $table = 'k_i_r_s';
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $primaryKey = 'id';
    protected $fillable = ['no_polisi', 'tanggal_jt_kir', 'tanggal_bayar_kir', 
                        'biaya_kir', 'approval', 'keterangan'];
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'no_polisi', 'no_polisi');
    }
}