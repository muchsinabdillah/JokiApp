<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Repository\CourierRepositoryImpl;
use App\Http\Repository\TransactionDeliveryImpl;
use App\Http\Service\TransactionDeliveryService;

class TransactionCourierCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data =  DB::table('transactiondeliveries')
            ->join('couriers', 'transactiondeliveries.Courier_id', '=', 'couriers.ID')
            ->join('users', 'users.merchant_id', '=', 'couriers.id_register')
            ->join('packets', 'packets.id', '=', 'transactiondeliveries.id_packet') 
            ->join('shippingtypes', 'transactiondeliveries.id_shippingtype', '=', 'shippingtypes.shipping_type_id')
            ->where('active', '1')
                ->where('users.ID', auth()->user()->id)
                ->where('transaction_status', "DELIVERY")
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
                    'transactiondeliveries.transaction_status',
                    'transactiondeliveries.address_sender',
                    'transactiondeliveries.address_receiver',
                    'transactiondeliveries.sender',
                    'transactiondeliveries.sender_receiver',
                    'transactiondeliveries.senderphonenumber',
                    'transactiondeliveries.senderphonenumber_receiver'
                )->get();
            return datatables($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.deliverykuriri.complete');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $packetRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $packetService = new TransactionDeliveryService($packetRepository, $courierRepository);
        $data =  $packetService->getDatabyId($id);

        return view('dashboard.deliverykuriri.completeshow', [
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
        $merchant =  $merchantService->updateDataArrived($request);
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
}
