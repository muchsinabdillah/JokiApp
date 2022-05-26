<?php

namespace App\Http\Controllers;

use App\Http\Repository\CourierRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\TransactionDeliveryImpl;
use App\Http\Service\TransactionDeliveryService;

class TransactionDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.delivery.index', [
            // 'posts' => Pricelist::latest()->paginate(10)->withQueryString()
            
            'posts' =>  DB::table('transactiondeliveries')
            ->join('packets', 'transactiondeliveries.id_packet', '=', 'packets.id')
            ->join('shippingtypes', 'transactiondeliveries.id_shippingtype', '=', 'shippingtypes.shipping_type_id')
            ->where('active','1')
            ->where('transactiondeliveries.id_merchant', auth()->user()->merchant_id) 
            ->select(
                'transactiondeliveries.id',
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
            'transactiondeliveries.transaction_status')->paginate(10) 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
        $merchantRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $merchantService = new TransactionDeliveryService($merchantRepository, $courierRepository);
        $merchant =  $merchantService->createTransactionDelivery($request);
        return $merchant;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packetRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $packetService = new TransactionDeliveryService($packetRepository, $courierRepository);
        $data =  $packetService->getDatabyId($id);
       
        return view('dashboard.delivery.show', [
            'merchant' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $merchantRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $merchantService = new TransactionDeliveryService($merchantRepository, $courierRepository);
        $merchant =  $merchantService->updateDataCancel($request);
        return $merchant;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showstatuspacketJson(Request $request){
        $merchantRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $merchantService = new TransactionDeliveryService($merchantRepository, $courierRepository);
        $merchant =  $merchantService->getStatusPackeybyId($request);
        return   $this->sendResponse([$merchant], "Load Successfully.");   

    }
    public function trackingproses(Request $request)
    {
        $merchantRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $merchantService = new TransactionDeliveryService($merchantRepository, $courierRepository);
        $merchanst =  $merchantService->getStatusPackeybyId($request);
        return view('tracking', [
            'merchants' => $merchanst
        ]);
    }
}
