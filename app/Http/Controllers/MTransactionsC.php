<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MTransactionM;
use App\Models\ProductsM;
use App\Models\LogM;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MTransactionsC extends Controller
{
    public function store(Request $request)
{
    // dd($request);
    try {
        DB::transaction(function () use ($request) {
            // Create a log record
            $logM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Melakukan Proses Tambah Produk'
            ]);

            // Validate the request
            $request->validate([
                'nomor_unik' => 'required',
                'nama_pelanggan' => 'required',
                'id_produk' => 'required|array',
                'uang_bayar' => 'required|numeric',
            ]);
            Log::info('Request validated successfully:', ['validated_data' => $request->all()]);
            // dd(Auth::user()->id, Auth::user()->name);
            // Create a new transaction record
            $transaction = MTransactionM::create([
                'nomor_unik' => $request->input('nomor_unik'),
                'nama_pelanggan' => $request->input('nama_pelanggan'),
                'uang_bayar' => $request->input('uang_bayar'),
                'user_id' => Auth::user()->id,
                'cashier_name' => Auth::user()->name,
            ]);
            Log::info('Transaction created successfully:', ['transaction' => $transaction]);
            // dd($transaction);
            // Loop through selected products and create order details
            foreach ($request->input('id_produk') as $productID) {
                // Find the product by ID
                $product = ProductsM::findOrFail($productID);
                Log::info('produk:', ['product' => $product]);

            // dd($product);
                // Create order details for each selected product
                $orderd = $transaction->details()->create([
                    'product_id' => $productID,
                    'buying_price' => $product->harga_produk,
                    'transaction_id' => $transaction->id,
                    'qty' => 1, // Assuming qty is always 1, adjust as needed
                ]);
                Log::info('orderd:', ['orderd' => $orderd]);

            }

            // Calculate uang_kembali based on the sum of buying_price in orderDetails
            $transaction->uang_kembali = $transaction->uang_bayar - $transaction->details->sum('buying_price');
            $transaction->save();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Ditambahkan');
    } catch (\Exception $e) {
        report($e);
        return redirect()->back()->withErrors(['error' => 'Something went wrong.'])->withInput();
    }
}

    }
    