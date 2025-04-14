<?php

namespace App\Export;

use App\Models\Order;
use App\Models\Pembelian\Pembelian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenjualanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pembelian::with(['customer', 'orderDetails.product'])->get();
    }

    public function map($order): array
    {
        $produk = $order->orderDetails->map(function ($detail) {
            return $detail->product->product_name . ' (' . $detail->quantity . ' : Rp. ' . number_format($detail->subtotal, 0, ',', '.') . ')';
        })->implode(', ');
    
        return [
            $order->customer->name ?? 'Non-member',
            $order->customer->phone ?? '-',
            $order->customer->points ?? '-',
            $produk,
            'Rp. ' . number_format($order->total_price, 0, ',', '.'),
            'Rp. ' . number_format($order->amount_paid, 0, ',', '.'),
            'Rp. ' . number_format($order->discount ?? 0, 0, ',', '.'),
            'Rp. ' . number_format($order->change, 0, ',', '.'),
            $order->created_at->format('d-m-Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'No HP Pelanggan',
            'Poin Pelanggan',
            'Produk',
            'Total Harga',
            'Total Bayar',
            'Total Diskon Poin',
            'Total Kembalian',
            'Tanggal Pembelian'
        ];
    }
}
