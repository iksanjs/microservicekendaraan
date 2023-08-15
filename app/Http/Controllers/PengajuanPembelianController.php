<?php


namespace App\Http\Controllers;
use App\PengajuanPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class PengajuanPembelianController extends Controller
{
    public function getData($id)
    {
        $dataFromLumenSewa = PengajuanPembelian::getDataFromLumenSewa($id);

        if ($dataFromLumenSewa) {
            // Lakukan pengolahan data atau operasi sesuai kebutuhan
            // Contoh: simpan data ke tabel pengajuan_pembelians di database Kendaraan
            // ...

            return response()->json(['message' => 'Data berhasil diambil dan diolah.']);
        } else {
            return response()->json(['message' => 'Gagal mengambil data dari API Lumen Sewa.']);
        }
    }

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
   
      $pengajuanpembelians = PengajuanPembelian::all();
      return response()->json($pengajuanpembelians);
    }

    public function create(Request $request)
    {
      // Lakukan validasi input
      $validatedData = $this->validate($request, [
          'nama_p_dealer' => 'required',
          'tanggal_p_dealer' => 'required',
          'harga_p_dealer' => 'required',
          'nama_pt_karoseri' => 'required',
          'tanggal_p_karoseri' => 'required',
          'harga_p_karoseri' => 'required',
          'dealer' => 'required',
          'merk' => 'required',
          'tipe' => 'required',
          'tahun' => 'required',
          'warna' => 'required',
          'deskripsi' => 'required',
          'harga' => 'required',
          'bbn' => 'required',
          'otr' => 'required',
          'karoseri' => 'required',
          'total' => 'required',
          'id_sppk' => 'required',
      ]);

      // Simpan produk baru
      $pengajuanpembelian = new PengajuanPembelian;
      $pengajuanpembelian->nama_p_dealer = $request->nama_p_dealer;
      $pengajuanpembelian->tanggal_p_dealer = $request->tanggal_p_dealer;
      $pengajuanpembelian->harga_p_dealer = $request->harga_p_dealer;
      $pengajuanpembelian->nama_pt_karoseri = $request->nama_pt_karoseri;
      $pengajuanpembelian->tanggal_p_karoseri = $request->tanggal_p_karoseri;
      $pengajuanpembelian->harga_p_karoseri = $request->harga_p_karoseri;
      $pengajuanpembelian->dealer = $request->dealer;
      $pengajuanpembelian->merk = $request->merk;
      $pengajuanpembelian->tipe = $request->tipe;
      $pengajuanpembelian->tahun = $request->tahun;
      $pengajuanpembelian->warna = $request->warna;
      $pengajuanpembelian->deskripsi = $request->deskripsi;
      $pengajuanpembelian->harga = $request->harga;
      $pengajuanpembelian->bbn = $request->bbn;
      $pengajuanpembelian->otr = $request->otr;
      $pengajuanpembelian->karoseri = $request->karoseri;
      $pengajuanpembelian->total = $request->total;
      $pengajuanpembelian->id_sppk = $request->id_sppk;
      $pengajuanpembelian->status_transaksi = 'Proses Approval';
      $pengajuanpembelian->approval = 'Proses Approval';
      $pengajuanpembelian->save();

      // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
      return response()->json([
         'message' => 'pengajuanpembelian created successfully',
         'redirect_url' => 'http://localhost:8005/pengajuanpembelian' // Ganti dengan URL halaman frontend
      ], 201);
   }

    public function show($id_pengajuanpembelian)
    {
       $pengajuanpembelian = PengajuanPembelian::find($id_pengajuanpembelian);
       return response()->json($pengajuanpembelian);
    }

    public function update(Request $request, $id_pengajuanpembelian)
    {
        $pengajuanpembelian= PengajuanPembelian::find($id_pengajuanpembelian);
      
        $pengajuanpembelian->nama_p_dealer = $request->input('nama_p_dealer');
        $pengajuanpembelian->tanggal_p_dealer = $request->input('tanggal_p_dealer');
        $pengajuanpembelian->harga_p_dealer = $request->input('harga_p_dealer');
        $pengajuanpembelian->nama_pt_karoseri = $request->input('nama_pt_karoseri');
        $pengajuanpembelian->tanggal_p_karoseri = $request->input('tanggal_p_karoseri');
        $pengajuanpembelian->harga_p_karoseri = $request->input('harga_p_karoseri');
        $pengajuanpembelian->dealer = $request->input('dealer');
        $pengajuanpembelian->merk = $request->input('merk');
        $pengajuanpembelian->tipe = $request->input('tipe');
        $pengajuanpembelian->tahun = $request->input('tahun');
        $pengajuanpembelian->warna = $request->input('warna');
        $pengajuanpembelian->deskripsi = $request->input('deskripsi');
        $pengajuanpembelian->harga = $request->input('harga');
        $pengajuanpembelian->bbn = $request->input('bbn');
        $pengajuanpembelian->otr = $request->input('otr');
        $pengajuanpembelian->karoseri = $request->input('karoseri');
        $pengajuanpembelian->total = $request->input('total');
        $pengajuanpembelian->status_transaksi = 'Proses Approval';
        $pengajuanpembelian->approval = 'Proses Approval';
        $pengajuanpembelian->save();
       // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'pengajuanpembelian updated successfully',
            'redirect_url' => 'http://localhost:8005/pengajuanpembelian' // Ganti dengan URL halaman frontend
        ], 201);
    }

    public function approved($id_pengajuanpembelian)
    {
        $pengajuanpembelian = PengajuanPembelian::find($id_pengajuanpembelian);

        $pengajuanpembelian->status_transaksi = 'Approved';
        $pengajuanpembelian->approval = 'Approved';
        $pengajuanpembelian->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'pengajuanpembelian approved successfully',
            'redirect_url' => 'http://localhost:8005/pengajuanpembelian', // Ganti dengan URL halaman frontend
            $pengajuanpembelian
        ], 201);
    }

    public function rejected(Request $request, $id_pengajuanpembelian)
    {
        $pengajuanpembelian = PengajuanPembelian::find($id_pengajuanpembelian);

        $pengajuanpembelian->keterangan = $request->input('keterangan');
        $pengajuanpembelian->status_transaksi = 'Reject';
        $pengajuanpembelian->approval = 'Reject';
        $pengajuanpembelian->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'pengajuanpembelian rejected successfully',
            'redirect_url' => 'http://localhost:8005/pengajuanpembelian', // Ganti dengan URL halaman frontend
            $pengajuanpembelian
        ], 201);
    }

    public function destroy($id)
    {
       $pengajuanpembelian = PengajuanPembelian::find($id_pengajuanpembelian);
       $pengajuanpembelian->delete();
       return response()->json('pengajuanpembelian removed successfully');
    }
 
}