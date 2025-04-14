<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\OrderDetail\OrderDetail;
use App\Models\Pembelian\Pembelian;
use App\Models\Product\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function pembelianAdmin(){
        return view('admin.pembelian.index');
    }


    public function pembelianPetugas(){
        return view('petugas.pembelian.index');
    }    

    public function formInput()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('petugas.pembelian.formInput', compact('products', 'customers'));
    }


    public function index()
    {
        $orders = Pembelian::with('customer', 'user')->latest()->get();
        if (auth()->user()->role == 'admin') {
            return view('admin.pembelian.index', compact('orders'));
        } else {
            return view('petugas.pembelian.index', compact('orders'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $shopData = $request->input('shop'); // Ambil dari form sebelumnya
    
        // Kirim data ke view create
        return view('petugas.pembelian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'customer_status' => 'required|in:Member,Non-Member',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.jumlah' => 'required|numeric|min:1',
         ]);

        // Simpan data transaksi sementara dalam sesi
        $transactionData = $request->only(['amount_paid', 'total_price', 'customer_status', 'products', 'phone']);
        session(['transaction_data' => $transactionData]);

        if ($request->customer_status === 'Member') {
            // Arahkan ke halaman verifikasi atau pendaftaran member
            return redirect()->route('member.verification');
        }

        // Proses transaksi untuk Non-Member
        $customer = Customer::create([
            'name' => 'Non-Member',
            'phone' => null,
            'points' => 0,
            'customer_status' => 'Non-Member',
        ]);


        $order = Pembelian::create([
            'customer_id' => $customer->id,
            'total_price' => $request->total_price,
            'discount' => 0,
            'final_price' => $request->total_price,
            'amount_paid' => $request->amount_paid,
            'change' => $request->amount_paid - $request->total_price,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            if ($product) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $productData['jumlah'],
                    'unit_price' => $product->price,
                    'subtotal' => $product->price * $productData['jumlah'],
                ]);
                $product->decrement('stock', $productData['jumlah']);
            }
        }

        return redirect()->route('receipt.show', ['order' => $order->id])->with('success', 'Transaksi berhasil.');
    }


    public function receipt(Pembelian $order)
    {
        $order->load('orderDetails.product');
        return view('petugas.pembelian.receipt', compact('order'));
    }


    public function print($id)
    {
        $order = Pembelian::with(['customer', 'orderDetails.product', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('petugas.pembelian.receipt-pdf', compact('order'))->setPaper('A5');

        // Nama file yang ingin di-download
        $fileName = "receipt-{$order->id}.pdf";

        // Mengunduh langsung ke device
        return $pdf->download($fileName);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
