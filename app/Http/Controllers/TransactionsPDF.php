<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\TransactionsM;
// use PDF;

// class TransactionsPDF extends Controller
// {    
//     public function pdf(){
//         $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
//         ->join('products', 'products.id', '=', 'transactions.id_produk')->get();
//         $pdf = PDF::loadview('transactions_pdf',['transactionsM' => $transactionsM]);
//         return $pdf->stream('transactions.pdf');
//     }
// }
