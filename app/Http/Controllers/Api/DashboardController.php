<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function topevent()
    {
        $psevent = DB::select('SELECT b.nama_event, COUNT(a.event_id) as jml from peserta_event as a 
JOIN ref_event as b ON b.id = a.event_id
GROUP BY b.nama_event
ORDER BY jml DESC
LIMIT 5');
        $msg = array('respon' => $psevent);
        return response()->json($msg);
    }

    public function transaksibulanan()
    {
        $psevent = DB::select('SELECT MONTH(tanggal_transaksi) as bulan, SUM(nominal) as jml FROM qris_transaction GROUP BY bulan ORDER BY bulan ASC');
        $msg = array('respon' => $psevent);
        return response()->json($msg);
    }

    public function jmlnamausaha()
    {
        $psevent = DB::select('SELECT nama_usaha, COUNT(nama_pemilik_qris) as jml FROM peserta_qris GROUP BY nama_usaha');
        $msg = array('respon' => $psevent);
        return response()->json($msg);
    }



}
