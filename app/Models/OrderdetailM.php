<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderdetailM extends Model
{
    use HasFactory;
    protected $table = "tbl_order_details";

    public function Mtransaction()
    {
        return $this->belongsTo(MTransactionM::class); // satu detail transaksi merupakan child dari sebuah transkasi, ato satu transaksi dapat memiliki lebih dari 1 detail transaksi (sebagai penghubung relasi antara child dan parent nya)
    }

    public function product()
    {
        return $this->belongsTo(ProductsM::class); // dan satu buah transaksi dapat memiliki satu buah product
    }

}
