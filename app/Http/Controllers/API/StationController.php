<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stations;

class StationController extends Controller
{
    public function data(Request $request)
    {
        // dd($request->all()); 
        $data = $request->search ? Stations::filter($request)->get() : Stations::get();
        if ($data) {
            $data_result = null;
            foreach ($data as $dt) {
                $data_result[] = ([
                    'id' => $dt->id,
                    'name' => $dt->name
                ]);
            }
            $response = [
                'code' => 200,
                'message' => 'Success to get data station',
                'data' => $data_result
            ];
            return response()->json($response, 200);
        } else return response()->json(['error' => 'Failed to get data station'], 401);
    }
}
