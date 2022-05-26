<?php

namespace App\Http\Repository; 
use App\Models\Packet;

class PacketRepositoryImpl  implements PacketRepositoryInterface
{
    public function insertData($request)
    {
        $create =  Packet::create([
            'packet_name' => $request->packet_name,
            'estimasi_time' => $request->estimasi_time,
            'estimasi_time_days' => $request->estimasi_time_days, 
            'status' => $request->status,
        ]);
        return $create;
    }
    public function showDatabyId($id)
    {

        $dt =  Packet::find($id);
        return $dt;
    }
    public function updateData($request)
    {
        $updates = Packet::where('id', $request->id)->update([
            'packet_name' => $request->packet_name,
            'estimasi_time' => $request->estimasi_time,
            'estimasi_time_days' => $request->estimasi_time_days, 
            'status' => $request->status,
        ]);
        return $updates;
    }
}
