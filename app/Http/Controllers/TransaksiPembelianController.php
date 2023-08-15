<?php


namespace App\Http\Controllers;
use App\TransaksiPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class TransaksiPembelianController extends Controller
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
   
      $transaksipembelians = TransaksiPembelian::all();
      return response()->json($transaksipembelians);
    }

    public function create(Request $request)
    {
      // Lakukan validasi input
      $validatedData = $this->validate($request, [
          'tanggal_transaksi_p' => 'required',
          'pembayaran_transaksi_p' => 'required',
          'bukti_transaksi_p' => 'required',
          'id_pengajuanpembelian' => 'required',
          'id_sppk' => 'required',
      ]);

      // Simpan produk baru
      $transaksipembelian = new TransaksiPembelian;
      $transaksipembelian->tanggal_transaksi_p = $request->tanggal_transaksi_p;
      $transaksipembelian->pembayaran_transaksi_p = $request->pembayaran_transaksi_p;
      $transaksipembelian->bukti_transaksi_p = $request->bukti_transaksi_p;
      $transaksipembelian->id_pengajuanpembelian = $request->id_pengajuanpembelian;
      $transaksipembelian->id_sppk = $request->id_sppk;
      $transaksipembelian->approval = 'Proses Approval';
      $transaksipembelian->status_st = 'Proses Approval';
      $transaksipembelian->save();

      // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
      return response()->json([
         'message' => 'transaksipembelian created successfully',
         'redirect_url' => 'http://localhost:8005/transaksipembelian' // Ganti dengan URL halaman frontend
      ], 201);
    }

    public function show($id_transaksipembelian)
    {
       $transaksipembelian = TransaksiPembelian::find($id_transaksipembelian);
       return response()->json($transaksipembelian);
    }

    public function update(Request $request, $id_transaksipembelian)
    {
        $transaksipembelian= TransaksiPembelian::find($id_transaksipembelian);
      
        $transaksipembelian->tanggal_transaksi_p = $request->input('tanggal_transaksi_p');
        $transaksipembelian->pembayaran_transaksi_p = $request->input('pembayaran_transaksi_p');
        $transaksipembelian->bukti_transaksi_p = $request->input('bukti_transaksi_p');
        $transaksipembelian->status_st = 'Proses Approval';
        $transaksipembelian->approval = 'Proses Approval';
        $transaksipembelian->save();
       // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'transaksipembelian updated successfully',
            'redirect_url' => 'http://localhost:8005/transaksipembelian' // Ganti dengan URL halaman frontend
        ], 201);
    }

    public function approved($id_transaksipembelian)
    {
        $transaksipembelian = TransaksiPembelian::find($id_transaksipembelian);

        $transaksipembelian->status_st = 'Approved';
        $transaksipembelian->approval = 'Approved';
        $transaksipembelian->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'transaksipembelian approved successfully',
            'redirect_url' => 'http://localhost:8005/transaksipembelian', // Ganti dengan URL halaman frontend
            $transaksipembelian
        ], 201);
    }

    public function rejected(Request $request, $id_transaksipembelian)
    {
        $transaksipembelian = TransaksiPembelian::find($id_transaksipembelian);

        $transaksipembelian->keterangan = $request->input('keterangan');
        $transaksipembelian->status_st = 'Reject';
        $transaksipembelian->approval = 'Reject';
        $transaksipembelian->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'transaksipembelian rejected successfully',
            'redirect_url' => 'http://localhost:8005/transaksipembelian', // Ganti dengan URL halaman frontend
            $transaksipembelian
        ], 201);
    }

    public function destroy($id_transaksipembelian)
    {
       $transaksipembelian = TransaksiPembelian::find($transaksipembelian);
       $transaksipembelian->delete();
       return response()->json('transaksipembelian removed successfully');
    }
 
}