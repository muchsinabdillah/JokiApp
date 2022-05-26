<?php

namespace App\Http\Service;

use Exception;
use App\Models\courier;
use App\Models\Merchant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 
use App\Http\Repository\CourierRepositoryImpl;

class CourierService extends Controller
{

    private $courierRepository;

    public function __construct(CourierRepositoryImpl $courierRepository)
    {
        $this->courierRepository = $courierRepository;
    }

    public function createCourier(Request $request)
    {
        // validate 
        $request->validate([
            "Name" => "required",
            "phone_number" => "required", 
            "address" => "required",
            "status" => "required",
            "id_regencies" => "required",
            "name_regencies" => "required",
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
            $autonumber = $this->genAuto();
            $this->courierRepository->insertData($request, $autonumber);
            DB::commit();
            return redirect('dashboard/courier/create')->with('success', 'Data Courier Berhasil ditambahkan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect('dashboard/courier/create')->with('failed', 'Data Courier Gagal ditambahkan !');
        }
    }
    public function getDatabyId($id)
    {
        return $this->courierRepository->showDatabyId($id);
    }
    public function editCourier(Request $request)
    {
        // validate 

        $request->validate([
            "Name" => "required",
            "phone_number" => "required", 
            "address" => "required",
            "status" => "required",
            "id_regencies" => "required",
            "name_regencies" => "required", 
            "email" => "required|unique:registers|email:dns",
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
            $this->courierRepository->updateData($request);
            DB::commit();

            return redirect('dashboard/courier/view/' . $request->id)->with('success', 'Data Courier Berhasil diedit !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect('dashboard/courier/view/' . $request->id)->with('failed', 'Data Courier Gagal diedit !');
        }
    }
    public function genAuto()
    {
        $AWAL = 'COU';
        $noUrutAkhir = courier::max('id_register');
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $no = 1;
        if ($noUrutAkhir) {
            $numberx =  $AWAL  .   sprintf("%015s", Str::substr($noUrutAkhir, 3, 15) + 1);
        } else {
            $numberx =   $AWAL  . sprintf("%015s", $no);
        }
        return $numberx;
    }
}
