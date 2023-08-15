<?php


namespace App\Http\Controllers;
use App\STDealertoWahana;
use App\TransaksiPembelian;
use App\PengajuanPembelian;
use App\Kendaraan;
use App\STNK;
use App\KIR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class STDealertoWahanaController extends Controller
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
      $stdealertowahanas = STDealertoWahana::all();
      $kendaraans = Kendaraan::all();
      $stnks = STNK::all();
      $kirs = STNK::all();
      return response()->json([$stdealertowahanas, $kendaraans, $stnks, $kirs]);
    }

    public function create(Request $request)
    {
        // Lakukan validasi input
        $validatedData = $this->validate($request, [
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
            'no_polisi' => 'required',
            'no_mesin' => 'required',
            'no_rangka' => 'required',
            'kategori' => 'required',
            'lokasi' => 'required',
            'tanggal_jt_stnk' => 'required',
            'tanggal_bayar_stnk' => 'required',
            'biaya_stnk' => 'required',
            'tgl_st' => 'required',
            'nama_penyerah' => 'required',
            'nama_penerima' => 'required',
            'id_pengajuanpembelian' => 'required',
        ]);

        $id_pengajuanpembelian = $request->input('id_pengajuanpembelian');
        $no_polisi = $request->input('no_polisi');
        $no_mesin = $request->input('no_mesin');
        $no_rangka = $request->input('no_rangka');
        $kategori = $request->input('kategori');
        $lokasi = $request->input('lokasi');
        
        $transaksi_pembelians = TransaksiPembelian::where('id_pengajuanpembelian', $id_pengajuanpembelian)->get();
        $transaksi_pembelian = $transaksi_pembelians->first(); // Mengambil objek pertama dari kumpulan
        
        if ($transaksi_pembelian) {
            $transaksi_pembelian->status_st = 'Sudah Serah Terima';
            $transaksi_pembelian->save();
        }
        $pengajuan_pembelian = PengajuanPembelian::findOrFail($id_pengajuanpembelian);

        // Menggunakan metode create() untuk membuat objek DataKendaraan baru dan mengisi nilainya
        Kendaraan::create([
            'merk' => $pengajuan_pembelian->merk,
            'tipe' => $pengajuan_pembelian->tipe,
            'tahun' => $pengajuan_pembelian->tahun,
            'warna' => $pengajuan_pembelian->warna,
            'deskripsi' => $pengajuan_pembelian->deskripsi,
            'harga_off' => $pengajuan_pembelian->harga,
            'bbn' => $pengajuan_pembelian->bbn,
            'otr' => $pengajuan_pembelian->otr,
            'karoseri' => $pengajuan_pembelian->karoseri,
            'total' => $pengajuan_pembelian->total,
            'tanggal_beli' => $pengajuan_pembelian->created_at,
            'kategori' => $kategori,
            'no_rangka' => $no_rangka,
            'no_mesin' => $no_mesin,
            'no_polisi' => $no_polisi,
            'lokasi' => $lokasi,
            'status' => 'Proses Approval',
            'approval' => 'Proses Approval'
        ]);
        
        // Jika kategori adalah "Komersil"
        if ($kategori == "Komersil") {
            // Simpan model STNK
            $stnk = new STNK;
            $stnk->no_polisi = $no_polisi;
            $stnk->tanggal_jt_stnk = $request->tanggal_jt_stnk;
            $stnk->tanggal_bayar_stnk = $request->tanggal_bayar_stnk;
            $stnk->biaya_stnk = $request->biaya_stnk;
            $stnk->approval = 'Proses Approval';
            $stnk->save();

            // Simpan model KIR
            $kir = new KIR;
            $kir->no_polisi = $no_polisi;
            $kir->tanggal_jt_kir = $request->tanggal_jt_kir;
            $kir->tanggal_bayar_kir = $request->tanggal_bayar_kir;
            $kir->biaya_kir = $request->biaya_kir;
            $kir->approval = 'Proses Approval';
            $kir->save();
        }
        // Jika kategori adalah "Passanger"
        elseif ($kategori == "Passanger") {
            // Simpan model STNK
            $stnk = new STNK;
            $stnk->no_polisi = $no_polisi;
            $stnk->tanggal_jt_stnk = $request->tanggal_jt_stnk;
            $stnk->tanggal_bayar_stnk = $request->tanggal_bayar_stnk;
            $stnk->biaya_stnk = $request->biaya_stnk;
            $stnk->approval = 'Proses Approval';
            $stnk->save();
        }

        // Simpan produk baru
        $stdealertowahana = new STDealertoWahana;
        $stdealertowahana->tgl_st = $request->tgl_st;
        $stdealertowahana->nama_penyerah = $request->nama_penyerah;
        $stdealertowahana->nama_penerima = $request->nama_penerima;
        $stdealertowahana->id_pengajuanpembelian = $request->id_pengajuanpembelian;
        $stdealertowahana->no_polisi = $request->no_polisi;
        $stdealertowahana->approval = 'Proses Approval';
        $stdealertowahana->save();

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'stdealertowahana created successfully',
            'redirect_url' => 'http://localhost:8005/stdealertowahana' // Ganti dengan URL halaman frontend
        ], 201);
    }

    public function show($no_polisi)
    {
        $stdealertowahanas = STDealertoWahana::where('no_polisi', $no_polisi)->first();
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $stnks = STNK::where('no_polisi', $no_polisi)->first();
        $kirs = KIR::where('no_polisi', $no_polisi)->first();
        return response()->json([$stdealertowahanas, $kendaraans, $stnks, $kirs]);
    }

    public function update(Request $request, $no_polisi)
    {
        $stdealertowahanas = STDealertoWahana::where('no_polisi', $no_polisi)->first();
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $stnk = STNK::where('no_polisi', $no_polisi)->first();
        $kir = KIR::where('no_polisi', $no_polisi)->first();
        $kategori = $kendaraans->kategori;

        
        $stdealertowahanas->approval = 'Proses Approval';
        $stdealertowahanas->fill($request->all());
        $stdealertowahanas->save();
        $kendaraans->approval = 'Proses Approval';
        $kendaraans->status = 'Stock';
        $kendaraans->fill($request->all());
        $kendaraans->save();
        // Jika kategori adalah "Komersil"
        if ($kategori == "Komersil") {
            // Simpan model STNK
            $stnk->approval = 'Proses Approval';
            $stnk->fill($request->all());
            $stnk->save();

            // Simpan model KIR
            $kir->approval = 'Proses Approval';
            $kir->fill($request->all());
            $kir->save();
        }
        // Jika kategori adalah "Passanger"
        elseif ($kategori == "Passanger") {
            // Simpan model STNK;
            $stnk->approval = 'Proses Approval';
            $stnk->fill($request->all());
            $stnk->save();
        }
       // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'stdealertowahana updated successfully',
            'redirect_url' => 'http://localhost:8005/stdealertowahana' // Ganti dengan URL halaman frontend
        ], 201);
    }

    public function approved($no_polisi)
    {
        $stdealertowahanas = STDealertoWahana::where('no_polisi', $no_polisi)->first();
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $stnk = STNK::where('no_polisi', $no_polisi)->first();
        $kir = KIR::where('no_polisi', $no_polisi)->first();

        $kategori = $kendaraans->kategori;

        
        $stdealertowahanas->approval = 'Approved';
        $stdealertowahanas->save();
        $kendaraans->approval = 'Approved';
        $kendaraans->status = 'Stock';
        $kendaraans->save();
        // Jika kategori adalah "Komersil"
    if ($kategori == "Komersil") {
        // Simpan model STNK
        $stnk->approval = 'Approved';
        $stnk->save();

        // Simpan model KIR
        $kir->approval = 'Approved';
        $kir->save();
    }
    // Jika kategori adalah "Passanger"
    elseif ($kategori == "Passanger") {
        // Simpan model STNK;
        $stnk->approval = 'Approved';
        $stnk->save();
    }

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'stdealertowahana approved successfully',
            'redirect_url' => 'http://localhost:8005/stdealertowahana', // Ganti dengan URL halaman frontend
            $stdealertowahanas
        ], 201);
    }

    public function rejected(Request $request, $no_polisi)
    {
        $stdealertowahanas = STDealertoWahana::where('no_polisi', $no_polisi)->first();
        $kendaraans = Kendaraan::where('no_polisi', $no_polisi)->first();
        $stnk = STNK::where('no_polisi', $no_polisi)->first();
        $kir = KIR::where('no_polisi', $no_polisi)->first();
        $kategori = $kendaraans->kategori;

        
        $stdealertowahanas->approval = 'Reject';
        $stdealertowahanas->keterangan = $request->keterangan;
        $stdealertowahanas->save();
        $kendaraans->approval = 'Reject';
        $kendaraans->status = 'Stock';
        $kendaraans->save();
        // Jika kategori adalah "Komersil"
        if ($kategori == "Komersil") {
            // Simpan model STNK
            $stnk->approval = 'Reject';
            $stnk->save();

            // Simpan model KIR
            $kir->approval = 'Reject';
            $kir->save();
        }
        // Jika kategori adalah "Passanger"
        elseif ($kategori == "Passanger") {
            // Simpan model STNK;
            $stnk->approval = 'Reject';
            $stnk->save();
        }
        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'stdealertowahana rejected successfully',
            'redirect_url' => 'http://localhost:8005/stdealertowahana', // Ganti dengan URL halaman frontend
            $stdealertowahanas
        ], 201);
    }

}