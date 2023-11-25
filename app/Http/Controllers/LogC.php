<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;

class LogC extends Controller
{
    public function index()
    { 
        $user = Auth::user();
        $LogM = LogM::create([
            'id_user' => Auth::user()-> id,
            'activity' => "User Di Halaman Log"
        ]);
        $subtitle = "Daftar Activity";
        $LogM = LogM::select('users.*', 'log.*')->join('users', 'users.id', '=', 'log.id_user')->orderBy('log.id', 'desc');

        if ($user->role == 'admin') {
            $LogM = $LogM->whereIn('users.role', ['kasir', 'owner', 'admin'])->SimplePaginate(5);
        } elseif ($user->role == 'kasir') {
            $LogM = $LogM->where('users.role', 'kasir')->SimplePaginate(5);
        } elseif ($user->role == 'owner') {
            $LogM = $LogM->whereIn('users.role', ['kasir', 'owner'])->SimplePaginate(5);
        } else {
            // Handle other roles if needed
        }
        return view('log_index', compact('subtitle', 'LogM'));

    }  

}