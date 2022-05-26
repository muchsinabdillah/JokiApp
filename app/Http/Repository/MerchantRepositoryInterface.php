<?php

namespace App\Http\Repository;

interface MerchantRepositoryInterface
{
    public function insertData($request, $autonumber);
    public function updateData($request);
    public function showDatabyId($id); 
}
