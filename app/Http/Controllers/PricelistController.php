<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Service\PricelistService;
use App\Http\Repository\PriceRepositoryImpl;
use App\Http\Repository\PricelistRepositoryImpl;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.pricelist.index', [
            // 'posts' => Pricelist::latest()->paginate(10)->withQueryString()
            'posts' =>  DB::table('pricelists')
            ->join('packets', 'pricelists.id_packet','=', 'packets.id')
            ->join('shippingtypes', 'pricelists.id_jenis_pengiriman', '=', 'shippingtypes.shipping_type_id')
            ->select('pricelists.*','packets.packet_name', 'shippingtypes.shipping_type_name')->paginate(10)
            
             
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
        return view('dashboard.pricelist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $merchantRepository = new PricelistRepositoryImpl();
        $merchantService = new PricelistService($merchantRepository);
        $merchant =  $merchantService->createPricelist($request);
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
        $packetRepository = new PricelistRepositoryImpl();
        $packetService = new PricelistService($packetRepository);
        $data =  $packetService->getDatabyId($id);
        return view('dashboard.pricelist.show', [
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
        $merchantRepository = new PricelistRepositoryImpl();
        $merchantService = new PricelistService($merchantRepository);
        $merchant =  $merchantService->editPricelist($request);
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
