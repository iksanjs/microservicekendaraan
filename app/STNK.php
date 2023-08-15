<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STNK extends Model
{
    protected $table = 's_t_n_k_s';
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $primaryKey = 'id';
    protected $fillable = ['no_polisi', 'tanggal_jt_stnk', 'tanggal_bayar_stnk', 
                        'biaya_stnk', 'approval', 'keterangan'];
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'no_polisi', 'no_polisi');
    }
}