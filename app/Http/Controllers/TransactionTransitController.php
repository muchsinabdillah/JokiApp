<?php

namespace App\Http\Controllers;

use App\Http\Repository\CourierRepositoryImpl;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use App\Http\Repository\TransactionDeliveryImpl;
use App\Http\Service\TransactionDeliveryService;

class TransactionTransitController extends Controller
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
            ->join('packets', 'transactiondeliveries.id_packet', '=', 'packets.id')
            ->join('shippingtypes', 'transactiondeliveries.id_shippingtype', '=', 'shippingtypes.shipping_type_id')
            ->where('active','1')
            ->where('id_merchant', auth()->user()->merchant_id)
            ->where('transaction_status', "TRANSIT PERWAKILAN")
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
            'transactiondeliveries.transaction_status')->get();
            return datatables($data)  
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.transit.index');
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
        $merchantRepository = new TransactionDeliveryImpl();
        $courierRepository = new CourierRepositoryImpl();
        $merchantService = new TransactionDeliveryService($merchantRepository, $courierRepository);
        $merchant =  $merchantService->editTransactionDelivery($request);
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
