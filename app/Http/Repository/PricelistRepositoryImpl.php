<?php

namespace App\Http\Repository;
 
use App\Models\Pricelist;

class PricelistRepositoryImpl  implements PricelistRepositoryInterface
{
    public function insertData($request)
    {
        $create =  Pricelist::create([
                "name_provinces_start" => $request->name_provinces_start,
                "id_provinces_start" =>  $request->id_provinces_start,
                "name_regencies_start" =>  $request->name_regencies_start,
                "id_regencies_start" =>  $request->id_regencies_start,
                "name_provinces_end" =>  $request->name_provinces_end,
                "id_provinces_end" =>  $request->id_provinces_end,
                "name_regencies_end" =>  $request->name_regencies_end,
                "id_regencies_end" =>  $request->id_regencies_end,
                "price" =>  $request->price,
                "price_asuransi" =>  $request->price_asuransi,
                "id_jenis_pengiriman" =>  $request->id_jenis_pengiriman,
                "id_packet" =>  $request->id_packet,
                "status" =>  $request->status
             
        ]);
        return $create;
    }
    public function showDatabyId($id)
    {

        $dt =  Pricelist::find($id);
        return $dt;
    }
    public function updateData($request)
    {
        $updates = Pricelist::where('id', $request->id)->update([
            "name_provinces_start" => $request->name_provinces_start,
            "id_provinces_start" =>  $request->id_provinces_start,
            "name_regencies_start" =>  $request->name_regencies_start,
            "id_regencies_start" =>  $request->id_regencies_start,
            "name_provinces_end" =>  $request->name_provinces_end,
            "id_provinces_end" =>  $request->id_provinces_end,
            "name_regencies_end" =>  $request->name_regencies_end,
            "id_regencies_end" =>  $request->id_regencies_end,
            "price" =>  $request->price,
            "price_asuransi" =>  $request->price_asuransi,
            "id_jenis_pengiriman" =>  $request->id_jenis_pengiriman,
            "id_packet" =>  $request->id_packet,
            "status" =>  $request->status
        ]);
        return $updates;
    }
}
