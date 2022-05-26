<?php

namespace App\Http\Repository;

use App\Models\courier;
use App\Models\Merchant;


class CourierRepositoryImpl  implements CourierRepositoryInterface
{
    public function insertData($request, $autonumber)
    {
        $create =  courier::create([
            'Name' => $request->Name,
            'phone_number' => $request->phone_number, 
            'address' => $request->address,
            'status' => $request->status,
            'email' => $request->email,
            'id_register' => $autonumber,
            'id_regencies' => $request->id_regencies,
            'name_regencies' => $request->name_regencies,
        ]);
        return $create;
    }
    public function showDatabyId($id)
    {

        $dt =  courier::find($id);
        return $dt;
    }
    public function updateData($request)
    {
        $updates = courier::where('id', $request->id)->update([
            'Name' => $request->Name,
            'phone_number' => $request->phone_number, 
            'address' => $request->address,
            'status' => $request->status,
            'email' => $request->email,
            'id_regencies' => $request->id_regencies,
            'name_regencies' => $request->name_regencies,
        ]);
        return $updates;
    }
}
