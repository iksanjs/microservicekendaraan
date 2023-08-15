<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BPKB extends Model
{
    protected $table = 'b_p_k_b_s';
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $primaryKey = 'id';
    protected $fillable = ['no_polisi', 'nama_bpkb', 'posisi_bpkb','approval', 'keterangan'];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'no_polisi', 'no_polisi');
    }
}
