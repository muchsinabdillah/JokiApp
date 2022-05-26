<?php

namespace App\Http\Service;

use Exception;
use App\Models\Merchant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Repository\CourierRepositoryImpl;
use App\Http\Repository\MerchantRepositoryImpl;
use App\Http\Repository\TransactionDeliveryImpl;

class TransactionDeliveryService extends Controller
{

    private $transactionDeliveryRepository;
    private $courierRepository;

    public function __construct(
        TransactionDeliveryImpl $transactionDeliveryRepository,
        CourierRepositoryImpl $courierRepository)
    {
        $this->transactionDeliveryRepository = $transactionDeliveryRepository;
        $this->courierRepository = $courierRepository;
    }

    public function createTransactionDelivery(Request $request)
    {
        // validate 
        $request->validate([
            "name_provinces_sender" => "required",
            "id_provinces_sender" => "required",
            "name_regencies_sender" => "required",
            "id_regencies_sender" => "required",
            "name_distrits_sender" => "required",
            "id_distrits_sender" => "required",
            "name_villages_sender" => "required",
            "id_villages_sender" => "required",
            "address_sender" => "required",
            "sender" => "required",
            "senderphonenumber" => "required",

            "name_provinces_receiver" => "required",
            "id_provinces_receiver" => "required",
            "name_regencies_receiver" => "required",
            "id_regencies_receiver"=> "required",
            "name_distrits_receiver" => "required",
            "id_distrits_receiver" => "required",
            "name_villages_receiver" => "required",
            "id_villages_receiver" => "required",
            "address_receiver" => "required",
            "sender_receiver" => "required",
            "senderphonenumber_receiver" => "required",
            "weight" => "required",
            "size"=> "required",
            "price" => "required",
            "price_asuransi" => "required",
            "price_total" => "required",
            "id_shippingtype" => "required",
            "id_packet" => "required", 
        ]);

        try {
            // Db Transaction
            DB::beginTransaction();
            $autonumber = $this->genAuto($request);
            $this->transactionDeliveryRepository->insertData($request, $autonumber);
            $this->transactionDeliveryRepository->insertDataHistory($request, $autonumber);
            DB::commit();
            return $this->sendResponse([], 'Data Transaction Berhasil ditambahkan !'); 
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaction Gagal ditambahkan !', $e->getMessage()); 
        }
    }
    public function getDatabyId($id)
    {
        return $this->transactionDeliveryRepository->showDatabyId($id);
    }
    public function editTransactionDelivery(Request $request)
    { 
        try {
            // Db Transaction
            DB::beginTransaction();
            $getstatus = $this->transactionDeliveryRepository->showDeliveryTransactionbyIdTrs($request); 
                if($getstatus->transaction_status == "TRANSIT PERWAKILAN" && $request->id_packet == 'TRANSIT PERWAKILAN' ){
                    return $this->sendError('Update Data Gagal !','Status Packet ' . $request->No_resi . " Sudah " . $getstatus->transaction_status ); 
                } else if ($getstatus->transaction_status == "TRANSIT PUSAT" && $request->id_packet == 'TRANSIT PUSAT') {
                    return $this->sendError('Update Data Gagal !', 'Status Packet ' . $request->No_resi . " Sudah " . $getstatus->transaction_status);
                } 
                else{
                    $this->transactionDeliveryRepository->updateData($request);
                    $this->transactionDeliveryRepository->insertDataHistory2($request, $request->No_resi);
                    DB::commit();
                    return $this->sendResponse([], 'Data Transit Berhasil ditambahkan !'); 
                } 
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transit Gagal ditambahkan !', $e->getMessage()); 
        }
    }
    public function editTransactionDeliveryCourier(Request $request)
    {
        try {
            // Db Transaction
            DB::beginTransaction();
            $getstatus = $this->transactionDeliveryRepository->showDeliveryTransactionbyIdTrs($request);
            if ($getstatus->transaction_status == "DELIVERY" && $request->id_packet == 'DELIVERY') {
                return $this->sendError('Update Data Gagal !', 'Status Packet ' . $request->No_resi . " Sudah " . $getstatus->transaction_status);
            } else {
                
                $courierName = $this->courierRepository->showDatabyId($request->id_courier);
                $this->transactionDeliveryRepository->updateDataDeliveryCourier($request, $courierName); 
                $this->transactionDeliveryRepository->insertDataHistoryCourier($request, $request->No_resi, $courierName);
                DB::commit();
            }

            return $this->sendResponse([], 'Data Transit Berhasil ditambahkan !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transit Gagal ditambahkan !', $e->getMessage());
        }
    }
    public function updateDataCancel(Request $request)
    {
        try {
            // Db Transaction
            DB::beginTransaction();
            $this->transactionDeliveryRepository->updateDataCancel($request);
            $this->transactionDeliveryRepository->insertDataHistoryCancel($request);
            DB::commit();

            return $this->sendResponse([], 'Data Berhasil dihapus !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Gagal dihapus !', $e->getMessage());
        }
    }
    public function updateDataArrived(Request $request)
    {
        $request->validate([
            "id_transaction_delivery" => "required",
            "id_packet_arrive" => "required",
            "KeteranganSampai" => "required",
            'file' => 'image|file',
        ]);
        try {
           
            // Db Transaction
            DB::beginTransaction();
            $this->transactionDeliveryRepository->updateDataArriveHold($request);
            $this->transactionDeliveryRepository->insertDataHistoryCourierArrived($request);
            DB::commit();
            return redirect('driver')->with('success', 'Status Packet Update Successfully !');
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage()); 
            return redirect('dashboard/delivery/kurir/'.$request->id)->with('failed', 'Status Packet Update Failed !');
        }
    }
    public function genAuto()
    {
        $AWAL = 'JKA';
        $noUrutAkhir = Merchant::max('id_register');
        $bulanRomawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $no = 1;
        // if ($noUrutAkhir) {
        //     $numberx =  $AWAL . date('n')  . date('Y') . '-' . sprintf("%06s", Str::substr($noUrutAkhir, 9, 6) + 1);
        // } else {
        //     $numberx =   $AWAL  . date('n')  . date('Y') . '-' . sprintf("%06s", $no);
        // }
        $numberx =   $AWAL . date('YmdHis');
        return $numberx;
    }
    public function getStatusPackeybyId(Request $request){
        return $this->transactionDeliveryRepository->getDataPacketbyId($request);
    }
}
