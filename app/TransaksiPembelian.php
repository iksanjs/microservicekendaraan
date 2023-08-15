<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    protected $table = 'transaksi_pembelians';
    /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
    protected $primaryKey = 'id_transaksipembelian';
    protected $fillable = ['tanggal_transaksi_p', 'pembayaran_transaksi_p', 'bukti_transaksi_p', 
                        'id_pengajuanpembelian', 'id_sppk',  'approval', 'keterangan', 'status_st'];

}