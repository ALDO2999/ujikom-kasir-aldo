<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\OrderDetail\OrderDetail;
use App\Models\Pembelian\Pembelian;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function showVerificationForm()
    {
        $transactionData = session('transaction_data');

        if (!$transactionData) {
            return redirect()->route('cashier')->with('error', 'Tidak ada data transaksi.');
        }

        $productIds = collect($transactionData['products'])->pluck('id');
        $products = Product::whereIn('id', $productIds)->get();

        $productDetails = $products->map(function ($product) use ($transactionData) {
            $jumlah = collect($transactionData['products'])->firstWhere('id', $product->id)['jumlah'];
            return [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'jumlah' => $jumlah,
                'subtotal' => $product->price * $jumlah,
            ];
        });

        $existingCustomer = null;
        $isReturningCustomer = false;
        $memberPoints = floor($transactionData['total_price'] * 0.01);
        $memberName = '';

        if (isset($transactionData['phone'])) {
            $existingCustomer = Customer::where('phone', $transactionData['phone'])->first();

            if ($existingCustomer) {
                $isReturningCustomer = $existingCustomer->orders()->exists();
                $memberPoints = $existingCustomer->points + $memberPoints;
                $memberName = $existingCustomer->name;
            }
        }

        $transactionData['member_points'] = $memberPoints;
        $transactionData['is_returning_customer'] = $isReturningCustomer;
        session(['transaction_data' => $transactionData]);

        return view('petugas.pembelian.member', [
            'transactionData' => $transactionData,
            'productDetails' => $productDetails,
            'isReturningCustomer' => $isReturningCustomer,
            'memberName' => $memberName,
        ]);
    }

    public function verifyMember(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'name' => 'required_if:is_new,true',
        ]);

        $transactionData = session('transaction_data');

        $customer = Customer::where('phone', $request->phone)->first();

        if (!$customer) {
            $customer = Customer::create([
                'name' => $request->name ?? 'Member Baru',
                'phone' => $request->phone,
                'points' => 0,
                'customer_status' => 'Member',
            ]);
        }

        $isReturningCustomer = $transactionData['is_returning_customer'] ?? false;
        $usePoints = $request->has('use_points') && $isReturningCustomer;

        $earnedPoints = floor($transactionData['total_price'] * 0.01);
        $availablePoints = $customer->points + $earnedPoints;
        $discount = 0;

        if ($usePoints && $availablePoints > 0) {
            $discount = min($availablePoints, $transactionData['total_price']);
            $transactionData['total_price'] -= $discount;

            // Set ulang poin jadi 0 karena semua udah dipakai
            $customer->points = 0;
            $customer->save();
        } else {
            // Kalau gak pakai poin, tetap tambahkan earnedPoints
            $customer->increment('points', $earnedPoints);
        }

        $transactionData['member_points'] = $customer->points;
        $transactionData['member_id'] = $customer->id;
        $transactionData['phone'] = $customer->phone;
        session(['transaction_data' => $transactionData]);

        $order = Pembelian::create([
            'customer_id' => $customer->id,
            'total_price' => $transactionData['total_price'] + $discount,
            'discount' => $discount,
            'final_price' => $transactionData['total_price'],
            'amount_paid' => $transactionData['amount_paid'],
            'change' => $transactionData['amount_paid'] - $transactionData['total_price'],
            'user_id' => auth()->id(),
        ]);

        foreach ($transactionData['products'] as $productData) {
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

        return redirect()->route('receipt.show', ['order' => $order->id])
            ->with('success', 'Transaksi member berhasil. Poin ditambahkan: ' . $earnedPoints);
    }
}