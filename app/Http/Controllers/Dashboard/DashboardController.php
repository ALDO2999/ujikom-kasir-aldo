<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail\OrderDetail;
use App\Models\Pembelian\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboardPetugas()
        {
            $today = Carbon::today();

            $totalPenjualanHariIni = Pembelian::whereDate('created_at', $today)->count();
            
            $waktuUpdate = Pembelian::latest('created_at')->first()?->created_at;
            $formattedWaktuUpdate = $waktuUpdate ? $waktuUpdate->format('d M Y H:i') : '-';

            return view('petugas.dashboard', [
                'totalPenjualanHariIni' => $totalPenjualanHariIni,
                'waktuUpdate' => $formattedWaktuUpdate,
            ]);
        }


        public function dashboardAdmin()    
        {
            // Penjualan per hari
            $salesPerDay = Pembelian::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        
            // Produk terjual (join ke tabel products)
            $productsSold = OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
                ->select('products.product_name', DB::raw('SUM(order_details.quantity) as total_qty'))
                ->groupBy('products.product_name')
                ->get();
        
            return view('admin.dashboard', [
                'salesPerDay' => $salesPerDay,
                'productsSold' => $productsSold
            ]);
        }
}
