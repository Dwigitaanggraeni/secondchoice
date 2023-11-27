<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MTransactionM;
use App\Models\ProductsM;
use App\Models\LogM;
use App\Models\OrderdetailM;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class MTransactionsC extends Controller
{
    protected $pdf;

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function transactionCount()
    {
        $count = MTransactionM::count();
        return $count;
    }

    public function getIncome()
    {
        $count = MTransactionM::sum('total_belanja');
        return $count;
    }

    public function index()
    {
        $subtitle = "Daftar Transaksi Produk";
        $vcari = request('search');

        $transactionsM = MTransactionM::with(['details.product'])
            ->where('nama_pelanggan', 'LIKE', '%' . $vcari . '%')
            ->get();

        return view('transactions_index', compact('subtitle', 'transactionsM', 'vcari'));
    }

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

                // Create a new transaction record
                $transaction = MTransactionM::create([
                    'nomor_unik' => $request->input('nomor_unik'),
                    'nama_pelanggan' => $request->input('nama_pelanggan'),
                    'uang_bayar' => $request->input('uang_bayar'),
                    'uang_kembali' => 0,
                    'total_belanja' => 0,
                    'user_id' => Auth::user()->id,
                    'cashier_name' => Auth::user()->name,
                ]);

                Log::info('Transaction created successfully:', ['transaction' => $transaction]);

                // Loop through selected products and create order details
                foreach ($request->input('id_produk') as $productID) {
                    // Find the product by ID
                    $product = ProductsM::findOrFail($productID);
                    Log::info('produk:', ['product' => $product]);

                    // Create order details for each selected product
                    $orderd = $transaction->details()->create([
                        'product_id' => $productID,
                        'buying_price' => $product->harga_produk,
                        'qty' => 1, // Assuming qty is always 1, adjust as needed
                    ]);

                    Log::info('orderd:', ['orderd' => $orderd]);
                }

                // Load the details relationship before accessing it
                $transaction->load('details');

                // Calculate uang_kembali based on the sum of buying_price in orderDetails
                $transaction->uang_kembali = $transaction->details->sum('buying_price') - $transaction->uang_bayar;

                // add total_belanja from sum buying_price
                $transaction->total_belanja = $transaction->details->sum('buying_price');

                // log uang_kembali, total_belanja
                Log::info('uang_kembali:', ['uang_kembali' => $transaction->uang_kembali]);
                Log::info('total_belanja:', ['total_belanja' => $transaction->total_belanja]);

                // Save the transaction
                $transaction->save();
            });

            return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Ditambahkan');
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->withErrors(['error' => 'Something went wrong.'])->withInput();
        }
    }

    public function downloadSingle($id)
    {
        // Log the user activity
        LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses unduh PDF'
        ]);

        // find by id
        $transactionsM = MTransactionM::with(['details.product'])->find($id);

        $this->pdf->loadView('transactions_single_pdf', ['transactionsM' => $transactionsM]);

        // Set paper size to A4 for landscape orientation
        $this->pdf->setPaper('a4', 'landscape');

        // Stream the PDF to the browser
        return $this->pdf->stream('transactions.pdf2');
    }

    public function downloadpdf()
    {
        // Log the user activity
        $logM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses unduh PDF'
        ]);

        // Retrieve transactions data with details and products
        $transactionsM = MTransactionM::with(['details.product'])->get();

        // Create PDF instance
        // $pdf = PDF::loadView('transactions_pdf2', ['transactionsM' => $transactionsM]);
        $this->pdf->loadView('transactions_pdf2', ['transactionsM' => $transactionsM]);

        // Set paper size to A4 for landscape orientation
        $this->pdf->setPaper('a4', 'landscape');

        // Stream the PDF to the browser
        return $this->pdf->stream('transactions.pdf2');
    }
}
