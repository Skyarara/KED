<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JobCategories;

class JobCategoryController extends Controller
{
    public function data(Request $request) 
    {
        $data = JobCategories::get();
        if ($data) {
            $data_result = null;
            foreach ($data as $dt) {
                $data_result[] = ([
                    'id' => $dt->id,
                    'name' => $dt->name,
                    'short_name' => $dt->short_name
                ]);
            }
            $response = [
                'code' => 200,
                'message' => 'Success to get data job categories',
                'data' => $data_result
            ];
            return response()->json($response, 200);
        } else return response()->json(['error' => 'Failed to get data job categories'], 401);
    }
}
