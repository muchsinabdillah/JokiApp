<?php

namespace App\Http\Repository;

use App\Models\Merchant;
use App\Models\Transactiondeliverie;
use App\Models\Transactiondeliveryhistorie;

class TransactionDeliveryImpl  implements TransactionDeliveryInterface
{
    public function insertData($request, $autonumber)
    {
        
        $create =  Transactiondeliverie::create([
            'id_transaction_delivery' => $autonumber,
            'name_provinces_sender' => $request->name_provinces_sender, 
            'id_provinces_sender' => $request->id_provinces_sender, 
            'name_regencies_sender' => $request->name_regencies_sender, 
            'id_regencies_sender' => $request->id_regencies_sender, 
            'name_distrits_sender' => $request->name_distrits_sender, 
            'id_distrits_sender' => $request->id_distrits_sender, 
            'name_villages_sender' => $request->name_villages_sender, 
            'id_villages_sender' => $request->id_villages_sender, 
            'address_sender' => $request->address_sender, 
            'sender' => $request->sender, 
            'senderphonenumber' => $request->senderphonenumber, 
            'name_provinces_receiver' => $request->name_provinces_receiver, 
            'id_provinces_receiver' => $request->id_provinces_receiver, 
            'name_regencies_receiver' => $request->name_regencies_receiver, 
            'id_regencies_receiver' => $request->id_regencies_receiver, 
            'name_distrits_receiver' => $request->name_distrits_receiver, 
            'id_distrits_receiver' => $request->id_distrits_receiver, 
            'name_villages_receiver' => $request->name_villages_receiver, 
            'id_villages_receiver' => $request->id_villages_receiver, 
            'address_receiver' => $request->address_receiver, 
            'sender_receiver' => $request->sender_receiver, 
            'senderphonenumber_receiver' => $request->senderphonenumber_receiver,
            'weight' => $request->weight, 
            'size' => $request->size, 
            'price' => $request->price, 
            'price_asuransi' => $request->price_asuransi, 
            'price_total' => $request->price_total, 
            'id_shippingtype' => $request->id_shippingtype, 
            'id_packet' => $request->id_packet,
            'transaction_status' => "SHIPMENT DATA ENTRY",
            'id_merchant' => auth()->user()->merchant_id,
            'Description' => $request->Description,
            'Instruction' => $request->Instruction,
            'id_user' => auth()->user()->username
        ]);
        return $create;
    }
    public function insertDataHistory($request, $autonumber)
    {

        $create =  Transactiondeliveryhistorie::create([
            'id_transacrion' => $autonumber,
            'status' => "SHIPMENT DATA ENTRY",
            'note' => "Entri Packet oleh Mitra" . ' - ' . auth()->user()->name_regencies . ' - ' . auth()->user()->merchant_id
        ]);
        return $create;
    }
    public function insertDataHistoryCancel($request)
    {

        $create =  Transactiondeliveryhistorie::create([
            'id_transacrion' => $request->id_transaction_delivery,
            'status' => "TRANSACTION CANCELLED",
            'note' => "Transaksi Paket di Batalkan." . ' - ' . auth()->user()->name_regencies . ' - ' . auth()->user()->merchant_id
        ]);
        return $create;
    }
    public function insertDataHistory2($request, $autonumber)
    {

        $create =  Transactiondeliveryhistorie::create([
            'id_transacrion' => $autonumber,
            'status' => $request->id_packet,
            'note' => "Packet " . $request->id_packet . ' - ' . auth()->user()->name_regencies . ' - ' . auth()->user()->merchant_id
        ]);
        return $create;
    }
    public function insertDataHistoryCourier($request, $autonumber, $courierName)
    {
        $del = $request->id_packet;
        $statusdel = ' Paket dibawa Oleh Kurir : ' . $courierName->Name;
        $create =  Transactiondeliveryhistorie::create([
            'id_transacrion' => $autonumber,
            'status' => $del,
            'note' => $statusdel
        ]);
        return $create;
    }
    public function showDatabyId($id)
    {

        $dt =  Transactiondeliverie::find($id);
        return $dt;
    }
    public function showDeliveryTransactionbyIdTrs($request)
    {
        
        $dt =  Transactiondeliverie::select(['id', 'transaction_status'])
            ->where('id_transaction_delivery', $request->No_resi)
            ->first(); 
        return  $dt;
    }
    public function updateData($request)
    {
        $updates = Transactiondeliverie::where('id_transaction_delivery', $request->No_resi)->update([
            'transaction_status' => $request->id_packet 
        ]);
        return $updates;
    }
    public function updateDataDeliveryCourier($request, $courierName)
    {
        $updates = Transactiondeliverie::where('id_transaction_delivery', $request->No_resi)->update([
            'transaction_status' => $request->id_packet,
            'Courier' => $courierName->Name,
            'Courier_Id' => $courierName->ID
        ]);
        return $updates;
    }
    public function updateDataCancel($request)
    {    
        $updates = Transactiondeliverie::where('id_transaction_delivery', $request->id_transaction_delivery)->update([
            'active' => 0,
        ]);
        return $updates;
    }
    public function getDataPacketbyId($request){
        $dt =  transactiondeliveryhistorie::select(['id', 'status', 'note','updated_at'])->orderby('id')
            ->where('id_transacrion', $request->id_transaction_delivery)->orderByDesc('id')->get();
        $rows = array();
        foreach ($dt as $key) {
            $pasing['id'] = $key['id'];
            $pasing['status'] = $key['status'];
            $pasing['note'] = $key['note'];
            $pasing['jam'] = date("H:i:s",strtotime($key['updated_at']));
            $pasing['updated_at'] = $key['updated_at'];
            $rows[] = $pasing;
        }
        return  $rows;
    }
    public function updateDataArriveHold($request)
    {
        $file = $request->file('file');

        /// Jika mau kirim ke aws
        // $s3Client = new S3Client([
        //     'version' => 'latest',
        //     'region'  => 'ap-southeast-1',
        //     'http'    => ['verify' => false],
        //     'credentials' => [
        //         'key'    => env('AWS_ACCESS_KEY_ID'),
        //         'secret' => env('AWS_SECRET_ACCESS_KEY')
        //     ]
        // ]);

        $nama_file_baru = time() . $file->getClientOriginalName();
        $tujuan_upload = 'img/delivered/';
        $file->move($tujuan_upload, $nama_file_baru);
        
        // $file_name = 'img/delivered/' . $nama_file_baru;
        // $source =   $file_name;
        // $awsImages = '';

        // $bucket = env('AWS_BUCKET');
        // $key = basename($file_name);
        // $result = $s3Client->putObject([
        //     'Bucket' => $bucket,
        //     'Key'    => 'identitas/' . $key,
        //     'Body'   => fopen($source, 'r'),
        //     'ACL'    => 'public-read', // make file 'public', 
        // ]);
        // $awsImages = $result->get('ObjectURL');
        // unlink($file_name);


        $updates = Transactiondeliverie::where('id_transaction_delivery', $request->id_transaction_delivery)->update([
            'transaction_status' => $request->id_packet_arrive,
            'Courier' => auth()->user()->name,
            'Courier_Id' => auth()->user()->id
        ]);
        return $updates;
    }
    public function insertDataHistoryCourierArrived($request)
    {
        
        $statusdel = ' Paket diterima oleh  : ' . $request->KeteranganSampai;
        $create =  Transactiondeliveryhistorie::create([
            'id_transacrion' =>  $request->id_transaction_delivery,
            'status' =>  $request->id_packet_arrive,
            'note' =>  $statusdel
        ]);
        return $create;
    }
}
