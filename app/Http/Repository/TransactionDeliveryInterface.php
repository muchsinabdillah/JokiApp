<?php

namespace App\Http\Repository;

interface TransactionDeliveryInterface
{
    public function insertData($request,$idNumber);
    public function insertDataHistory($request, $idNumber);
    public function insertDataHistory2($request, $idNumber);
    public function insertDataHistoryCourier($request, $idNumber, $courierName);
    public function insertDataHistoryCourierArrived($request);
    public function updateData($request);
    public function updateDataCancel($request);
    public function updateDataArriveHold($request);
    public function updateDataDeliveryCourier($request, $courierName);
    public function getDataPacketbyId($request);
    public function showDatabyId($id);
}
