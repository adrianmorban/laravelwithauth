<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Names;

class NamesApiController extends Controller
{
    public function getNames(Request $request)
    {
        if($request){
            $search = $request->input('query');
            $datos["names"] = names::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('lastname', 'LIKE', "%{$search}%")
            ->paginate(5);
        }
        else{
            $datos["names"] = names::paginate(5);
        }
        return response()->json($datos);
    }
}
