<?php

namespace App\Http\Controllers;

use App\Http\Repository\MerchantRepositoryImpl;
use App\Http\Service\MerchantService;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.mitra.index', [
            'posts' => Merchant::latest()->paginate(10)->withQueryString()
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
        return view('dashboard.mitra.create');
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
        $merchantRepository = new MerchantRepositoryImpl();
        $merchantService = new MerchantService($merchantRepository);
        $merchant =  $merchantService->createMerchant($request);
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
        $merchantRepository = new MerchantRepositoryImpl();
        $merchantService = new MerchantService($merchantRepository);
        $dataMerchantx =  $merchantService->getDatabyId($id);  
        return view('dashboard.mitra.show', [
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
        $merchantRepository = new MerchantRepositoryImpl();
        $merchantService = new MerchantService($merchantRepository);
        $merchant =  $merchantService->editMerchant($request);
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
