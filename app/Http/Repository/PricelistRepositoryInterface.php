<?php

namespace App\Http\Repository;

interface PricelistRepositoryInterface
{
    public function insertData($request);
    public function updateData($request);
    public function showDatabyId($id);
}
