<?php


namespace App\Http\Controllers;
use App\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class KendaraanController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        //
    }
  
    public function index()
    {
      $kendaraans = Kendaraan::all();
      return response()->json([$kendaraans]);
    }

    public function approvedkendaraan()
    {
        $kendaraans = Kendaraan::where('approval', 'Approved')->get();
        return response()->json([$kendaraans]);
    }

    public function getstock()
    {
        $kendaraans = Kendaraan::where('status', 'Stock')->get();
        return response()->json([$kendaraans]);
    }

    public function show($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        return response()->json([$kendaraans]);
    }

    public function updatestatusstock($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $kendaraans->status = 'Stock';
        $kendaraans->save();
    }
    public function updatestatusproses($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $kendaraans->status = 'Proses Kontrak Sewa';
        $kendaraans->save();
    }
    public function updatestatusdisewa($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $kendaraans->status = 'Disewa';
        $kendaraans->save();
    }
    public function updatestatusprosesst($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $kendaraans->status = 'Proses Serah Terima';
        $kendaraans->save();
    }
    public function updatestatusstreject($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $kendaraans->status = 'Serah Terima Rejected';
        $kendaraans->save();
    }
    public function updatestatusprosespengembalian($no_polisi)
    {
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $kendaraans->status = 'Proses Pengembalian';
        $kendaraans->save();
    }

}