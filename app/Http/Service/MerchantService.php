<?php

namespace App\Http\Service;

use Exception; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 
use App\Http\Repository\MerchantRepositoryImpl;
use App\Models\Merchant;
use Illuminate\Support\Str;

class MerchantService extends Controller
{

    private $merchantRepository;

    public function __construct(MerchantRepositoryImpl $merchantRepository)
    {
        $this->merchantRepository = $merchantRepository;
    }

    public function createMerchant(Request $request)
    {
        // validate 
        $request->validate([
            "merchant_name" => "required",
            "phone_number" => "required",
            "merchant_type" => "required",
            "merchant_person" => "required",
            "address" => "required",
            "status" => "required",
            "id_regencies"=> "required",
            "name_regencies" => "required", 
        ]);
        
        try {
            // Db Transaction
            DB::beginTransaction();
            $autonumber = $this->genAuto(); 
            $this->merchantRepository->insertData($request, $autonumber);
            DB::commit(); 
            return redirect('dashboard/merchant/create')->with('success', 'Data Merchant Berhasil ditambahkan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect('dashboard/merchant/create')->with('failed', 'Data Merchant Gagal ditambahkan !');
        }
    }
    public function getDatabyId($id){
        return $this->merchantRepository->showDatabyId($id);
    }
    public function editMerchant(Request $request)
    {
        // validate 
      
        $request->validate([
            "merchant_name" => "required",
            "phone_number" => "required",
            "merchant_type" => "required",
            "merchant_person" => "required",
            "address" => "required",
            "status" => "required",
            "id_regencies" => "required",
            "name_regencies" => "required", 
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
           $this->merchantRepository->updateData($request); 
            DB::commit();
             
          return redirect('dashboard/merchant/view/'.$request->id)->with('success', 'Data Merchant Berhasil diedit !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect('dashboard/merchant/view/'.$request->id)->with('failed', 'Data Merchant Gagal diedit !');
        }
    }
    public function genAuto(){
        $AWAL = 'JKL';
        $noUrutAkhir = Merchant::max('id_register');
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $no = 1;
        if ($noUrutAkhir) {
            $numberx =  $AWAL . date('n')  . date('Y') . '-' . sprintf("%06s", Str::substr($noUrutAkhir, 9, 6) + 1);
        } else {
            $numberx =   $AWAL  . date('n')  . date('Y') . '-' . sprintf("%06s", $no);
        } 
        return $numberx;
    }
}
