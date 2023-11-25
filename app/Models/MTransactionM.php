<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTransactionM extends Model
{
    use HasFactory;

    protected $table = "tbl_transactions";
    
    public function details()
    {
        return $this->hasMany(OrderdetailM::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}