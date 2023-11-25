<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderdetailM extends Model
{
    use HasFactory;
    protected $table = "tbl_order_details";
    protected $guarded = []; //buat semua filed bisa diisi

    public function Mtransaction()
    {
        return $this->belongsTo(MTransactionM::class, 'transaction_id');
    }
    

    public function product()
    {
        return $this->belongsTo(ProductsM::class); // dan satu buah transaksi dapat memiliki satu buah product
    }

}
