<?php

namespace App\Http\Service;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 
use App\Http\Repository\PacketRepositoryImpl;

class PacketService extends Controller
{

    private $packetRepository;

    public function __construct(PacketRepositoryImpl $packetRepository)
    {
        $this->packetRepository = $packetRepository;
    }

    public function createPacket(Request $request)
    {
        // validate 
        $request->validate([
            "packet_name" => "required",
            "estimasi_time" => "required",
            "estimasi_time_days" => "required", 
            "status" => "required",
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
            $this->packetRepository->insertData($request);
            DB::commit();
            return redirect('dashboard/packet/create')->with('success', 'Data Packet Berhasil ditambahkan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect('dashboard/packet/create')->with('failed', 'Data Packet Gagal ditambahkan !');
        }
    }
    public function getDatabyId($id)
    {
        return $this->packetRepository->showDatabyId($id);
    }
    public function editPacket(Request $request)
    {
        // validate 
        $request->validate([
            "packet_name" => "required",
            "estimasi_time" => "required",
            "estimasi_time_days" => "required",   
            "status" => "required",
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
            $this->packetRepository->updateData($request);
            DB::commit();

            return redirect('dashboard/packet/view/' . $request->id)->with('success', 'Data Merchant Berhasil diedit !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect('dashboard/packet/view/' . $request->id)->with('failed', 'Data Merchant Gagal diedit !');
        }
    }
}
