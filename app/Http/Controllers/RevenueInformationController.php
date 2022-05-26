<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueInformationController extends Controller
{
    //
    public function index(){
        return view(
        'dashboard.information.revenue.revenuedetail', [

            'posts' =>  DB::table('v_pendapatan_mitra_detil')
            ->where('v_pendapatan_mitra_detil.active', '1')
            ->paginate(10)
        ]);
    }
    public function revenuedetail(Request $request){
        return view('dashboard.registration.verification', [

            'posts' =>  DB::table('v_pendapatan_mitra_detil')
                ->where('v_pendapatan_mitra_detil.active', '1')  
                ->paginate(10)
        ]);
    }
}
