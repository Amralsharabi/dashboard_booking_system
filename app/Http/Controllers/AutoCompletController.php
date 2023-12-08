<?php

namespace App\Http\Controllers;

use App\Models\CommonData;
use Illuminate\Http\Request;

class AutoCompletController extends Controller
{
    public function getNames(Request $request)
    {
        $term = $request->input('term');
        $data = CommonData::getNames($term);
        return response()->json($data);
    }

    public function getUserData(Request $request)
    {
        $name = $request->input('name');
        $data = CommonData::getUserData($name);
        return response()->json([
            'req_fore_na' => $data->req_fore_na,
            'req_second_na' => $data->req_second_na,
            'req_third_na' => $data->req_third_na,
            'req_tit' => $data->req_tit
        ]);
    }
}
