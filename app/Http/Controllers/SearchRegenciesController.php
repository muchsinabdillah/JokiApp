<?php

namespace App\Http\Controllers;

use App\Models\courier;
use App\Models\Packet;
use App\Models\Village;
use App\Models\District;
use App\Models\Merchant;
use App\Models\Province;
use App\Models\Regencie;
use Illuminate\Http\Request;

class SearchRegenciesController extends Controller
{
    //
    public function index()
    {
        return view('search');
    }
    public function autocompleteprovinces(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Province::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Regencie::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
    public function autocompleteRegencies(Request $request)
    {
        $query = $request->get('query');
        $id_provinces = $request->get('id_provinces');
        $filterResult = Regencie::where('name', 'LIKE', '%' . $query . '%')
                                ->where('province_id', $id_provinces)->get();
        return response()->json($filterResult);
    }
    public function autocompletedistrits(Request $request)
    {
        $query = $request->get('query');
        $id_regencies = $request->get('id_regencies');
        $filterResult = District::where('name', 'LIKE', '%' . $query . '%')
                                ->where('regency_id', $id_regencies)->get();
        return response()->json($filterResult);
    }
    public function autocompletevillages(Request $request)
    {
        $query = $request->get('query');
        $id_distrits = $request->get('id_distrits');
        $filterResult = Village::where('name', 'LIKE', '%' . $query . '%')
                                ->where('district_id', $id_distrits)->get();
        return response()->json($filterResult);
    }
    public function autocompletepacket(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Packet::select(['packet_name AS name', 'id'])->where('packet_name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
    public function autocompletemerchant(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Merchant::select(['merchant_name AS name', 'id_register'])->where('merchant_name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
    public function autocompletecourier(Request $request)
    {
        $query = $request->get('query');
        $filterResult = courier::select(['Name AS name', 'id_register'])->where('Name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
}
