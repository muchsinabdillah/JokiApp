<?php

namespace App\Http\Repository;

use App\Models\Merchant; 


class MerchantRepositoryImpl  implements MerchantRepositoryInterface
{
    public function insertData($request, $autonumber)
    {
        $create =  Merchant::create([
            'merchant_name' => $request->merchant_name,
            'phone_number' => $request->phone_number,
            'merchant_type' => $request->merchant_type,
            'merchant_person' => $request->merchant_person,
            'address' => $request->address,
            'status' => $request->status,
            'email' => $request->email,
            'id_register' => $autonumber,
            'id_regencies' => $request->id_regencies,
            'name_regencies' => $request->name_regencies,
        ]);
        return $create;
    }
    public function showDatabyId($id){
        
        $dt =  Merchant::find($id);
        return $dt;
    }
    public function updateData($request)
    { 
        $updates = Merchant::where('id', $request->id)->update(['merchant_name' => $request->merchant_name,
            'phone_number' => $request->phone_number,
            'merchant_type' => $request->merchant_type,
            'merchant_person' => $request->merchant_person,
            'address' => $request->address,
            'status' => $request->status,
            'email' => $request->email, 
            'id_regencies' => $request->id_regencies,
            'name_regencies' => $request->name_regencies,
        ]);
        return $updates;
    }
}
