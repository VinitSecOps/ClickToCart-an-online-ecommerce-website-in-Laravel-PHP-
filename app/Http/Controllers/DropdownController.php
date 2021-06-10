<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Redirect;
// use App\Models\{Country, State, City};

class DropdownController extends Controller
{
    // public function index()
    // {
    //     $data['countries'] = Country::get(["name", "id"]);
    //     return view('pages.payment', $data);
    // }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}