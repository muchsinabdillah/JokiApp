<?php

namespace App\Http\Controllers;

use App\Models\courier;
use App\Models\Merchant;
use App\Models\Packet;
use App\Models\Pricelist;
use App\Models\shippingtype;
use App\Models\StatusTransaction;
use App\Models\Transactiondeliveryhistorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    //
    public function getDataPacketJSon(){
        $packet = Packet::get();
        return $this->sendResponse([$packet], "Produk Success Loaded.");
    }
    public function getDataShipingTypeJSon()
    {
        $packet = shippingtype::get();
        return $this->sendResponse([$packet], "Shiping Type Success Loaded.");
    }
    public function getDataPengirimanByIDJson(Request $request)
    {
        $dt =  Pricelist::find($request->id); 
        return $this->sendResponse([$dt], $request->id);
    }
    public function getDataShippingJSon(Request $request){
        $data = DB::table('pricelists')
            ->join('shippingtypes', 'pricelists.id_jenis_pengiriman', '=', 'shippingtypes.shipping_type_id')
            ->where('pricelists.id_provinces_start', $request->id_provinces_sender)
            ->where('pricelists.id_regencies_start', $request->id_regencies_sender)
            ->where('pricelists.id_provinces_end', $request->id_provinces_receiver)
            ->where('pricelists.id_regencies_end', $request->id_regencies_receiver)
            ->where('pricelists.id_packet', $request->id_packet)
            ->select('pricelists.id', 'pricelists.id_jenis_pengiriman', 'shippingtypes.shipping_type_name') 
            ->groupBy('pricelists.id', 'pricelists.id_jenis_pengiriman', 'shippingtypes.shipping_type_name')
            ->get();
        return $this->sendResponse([$data], "Load Successfully.");
    }
    public function getDataPriceJSon(Request $request)
    {
        $data = DB::table('pricelists')
        ->join('shippingtypes', 'pricelists.id_jenis_pengiriman', '=', 'shippingtypes.shipping_type_id')
        ->where('pricelists.id_provinces_start', $request->id_provinces_sender)
            ->where('pricelists.id_regencies_start', $request->id_regencies_sender)
            ->where('pricelists.id_provinces_end', $request->id_provinces_receiver)
            ->where('pricelists.id_regencies_end', $request->id_regencies_receiver)
            ->where('pricelists.id_packet', $request->id_packet)
            ->where('pricelists.id_jenis_pengiriman', $request->id_shippingtype)
            ->select('pricelists.id', 'pricelists.price', 'pricelists.price_asuransi') 
            ->get();
        return $this->sendResponse([$data], "Load Successfully.");
    }
    public function getDeliveryPacketByIDJson(Request $request)
    {
        $data =  DB::table('transactiondeliveries')
        ->join('packets', 'transactiondeliveries.id_packet', '=', 'packets.id')
        ->join('shippingtypes', 'transactiondeliveries.id_shippingtype', '=', 'shippingtypes.shipping_type_id')
        ->where('transactiondeliveries.id', $request->id)
        ->select(
            'transactiondeliveries.id',
            'transactiondeliveries.id_packet',
            'transactiondeliveries.id_transaction_delivery',
            'transactiondeliveries.name_provinces_sender',
            'transactiondeliveries.name_regencies_sender',
            'transactiondeliveries.name_provinces_receiver',
            'transactiondeliveries.name_regencies_receiver',
            'packets.packet_name',
            'shippingtypes.shipping_type_name',
            'transactiondeliveries.weight',
            'transactiondeliveries.size',
            'transactiondeliveries.price',
            'transactiondeliveries.price_asuransi',
            'transactiondeliveries.price_total',
            'transactiondeliveries.transaction_status',
            'transactiondeliveries.updated_at'
        )->get(); 
        return $this->sendResponse([$data], "Load Successfully.");
    }
    public function getDataMasterHistoryDeliveryJSon()
    {
        $packet = StatusTransaction::get();
        return $this->sendResponse([$packet], "Produk Success Loaded.");
    }
    public function getDataMasterCouriersJSon()
    {
        $packet = courier::get();
        return $this->sendResponse([$packet], "Produk Success Loaded.");
    }
    public function getDataMasterCouriersbyRegenciesJSon()
    {

        $dt =  courier::select(['ID', 'Name'])
        ->where('status', 'Active')
        ->where('name_regencies', auth()->user()->name_regencies)
        ->get();
        return $this->sendResponse([$dt], "Produk Success Loaded.");
    }
    public function getRegistrationMitraKurirByIDJson(Request $request)
    {
        $data =  DB::table('registers') 
        ->where('registers.id', $request->id)
        ->get();
        return $this->sendResponse([$data], "Load Successfully.");
    }
}
