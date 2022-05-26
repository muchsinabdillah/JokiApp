<?php

namespace App\Http\Controllers;

use App\Http\Repository\PacketRepositoryImpl;
use App\Http\Service\PacketService;
use App\Models\Packet;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //s
        return view('dashboard.packet.index', [
            'posts' => Packet::latest()->paginate(10)->withQueryString()
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
        return view('dashboard.packet.create');
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
        $merchantRepository = new PacketRepositoryImpl();
        $merchantService = new PacketService($merchantRepository);
        $merchant =  $merchantService->createPacket($request);
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
        $packetRepository = new PacketRepositoryImpl();
        $packetService = new PacketService($packetRepository);
        $data=  $packetService->getDatabyId($id);
        return view('dashboard.packet.show', [
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
    public function update(Request $request )
    {
        //
        $merchantRepository = new PacketRepositoryImpl();
        $merchantService = new PacketService($merchantRepository);
        $merchant =  $merchantService->editPacket($request);
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
