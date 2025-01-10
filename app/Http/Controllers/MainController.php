<?php

namespace App\Http\Controllers;

use App\Models\PesertaEvent;
use App\Models\PesertaQris;
use App\Models\QrisTransaction;
use App\Models\RefEvent;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Request;
class MainController extends Controller
{
    public function index()
    {
        $cpe = PesertaEvent::all()->count();
        $pqr = PesertaQris::all()->count();
        $qtr = QrisTransaction::sum("nominal");
        $rfe = RefEvent::all()->count();
        return view('page.index', compact('cpe', 'pqr', 'qtr', 'rfe'));
    }
    public function transaksi()
    {
        $data = DB::select('SELECT a.id,a.nama_pemilik_qris, a.nama_usaha, COUNT(b.peserta_id) as total_trx,SUM(b.nominal) as nominal FROM peserta_qris as a JOIN qris_transaction as b on b.peserta_id = a.id GROUP BY a.id');
        return view('page.transaksi', compact('data'));
    }
    public function transaksi_detail($id)
    {
        $idreq = $id;
        $pemilik = PesertaQris::find($idreq);
        $data = DB::select('SELECT tanggal_transaksi, nama_produk, nominal FROM qris_transaction WHERE peserta_id = ?', [$idreq]);
        return view('page.transaksi_detail', compact('data', 'pemilik'));
        // return $data;
    }
}
