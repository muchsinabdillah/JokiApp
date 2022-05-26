<?php

namespace App\Http\Repository;

interface PacketRepositoryInterface
{
    public function insertData($request);
    public function updateData($request);
    public function showDatabyId($id);
}
