<?php

namespace App\Http\Controllers;

use App\Http\Repository\CourierRepositoryImpl;
use App\Http\Service\CourierService;
use App\Models\courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.couriers.index', [
            'posts' => courier::latest()->paginate(10)->withQueryString()
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
        return view('dashboard.couriers.create');
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
        $courierRepository = new CourierRepositoryImpl();
        $courierService = new CourierService($courierRepository);
        $courier =  $courierService->createcourier($request);
        return $courier;
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
        $courierRepository = new CourierRepositoryImpl();
        $courierService = new CourierService($courierRepository);
        $dataMerchantx =  $courierService->getDatabyId($id);
        return view('dashboard.couriers.show', [
            'merchant' => $dataMerchantx
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
        $courierRepository = new CourierRepositoryImpl();
        $courierService = new CourierService($courierRepository);
        $courier =  $courierService->editCourier($request);
        return $courier;
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
