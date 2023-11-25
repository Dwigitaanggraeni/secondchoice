<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionsM;
use App\Models\ProductsM;
use App\Models\LogM;
use PDF;

class TransactionsC extends Controller
{
    public function index() {
        $subtitle = "Daftar Transaksi Produk";
        $vcari = request('search');
        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')
        ->where('transactions.nama_pelanggan', 'LIKE', '%' . $vcari . '%')
        ->get();
        return view('transactions_index', compact('subtitle', 'transactionsM', 'vcari'));

    }

    public function create() {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Transaksi'
        ]);
        $subtitle = "Tambah Transaksi Produk";

        $productsM = ProductsM::all();

        return view('transactions_create', compact('subtitle', 'productsM'));
    }
    
    public function store(Request $request){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Dihalaman Edit Transaksi'
        ]);
        $products = ProductsM::where("id", $request->input('id_produk'))->first();
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'uang_bayar' => 'required',
        ]);
        $transactions = new TransactionsM;
        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->id_produk = $request->input('id_produk');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->uang_kembali = $request->input('uang_bayar') - $products->harga_produk;
        $transactions->save();

        // TransactionsM::create($request->post());
        return redirect()->route('transactions.index')->
        with('success', 'Transaksi Berhasil Ditambahkan');
    }

    public function edit($id) {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Dihalaman Edit Transaksi'
        ]);
        $subtitle = "Edit Transaksi Produk";
        $transactions = TransactionsM::find($id);
        $productsM = ProductsM::all();

        return view('transactions_edit', compact('subtitle', 'productsM', 'transactions'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Transaksi'
        ]);
        $products = ProductsM::where("id", $request->input('id_produk'))->first();
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'uang_bayar' => 'required',
        ]);
        $transactions = TransactionsM::find($id);
        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->id_produk = $request->input('id_produk');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->uang_kembali = 
        $request->input('uang_bayar') - $products->harga_produk;
        $transactions->save();

        // TransactionsM::create($request->post());
        return redirect()->route('transactions.index')->
        with('success', 'Transaksi Berhasil Diperbaharui');
    }

    public function delete ($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Transaksi'
        ]);
        TransactionsM::where('id',$id)->delete();
        return redirect()->route('transactions.index')->
        with('success', 'Transaksi Berhasil dihapus');
        } 

        public function pdf($id){
            $LogM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Mencetak Struk'
            ]);
    
            $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
            ->join('products', 'products.id', '=', 'transactions.id_produk')->where('transactions.id', $id)->get();
            $pdf = PDF::loadview('transactions_pdf',['transactionsM' => $transactionsM]);
            return $pdf->stream('transactions.pdf');
        }

        public function pdf2(){
            $LogM = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Melakukan Proses unduh PDF'
            ]);
            $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
            ->join('products', 'products.id', '=', 'transactions.id_produk')->get();
            $pdf = PDF::loadview('transactions_pdf2',['transactionsM' => $transactionsM]);
            return $pdf->stream('transactions.pdf2');
        }

    }
    