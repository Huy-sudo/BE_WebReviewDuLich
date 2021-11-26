<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class cityController extends Controller
{
    public function index(Request $request){
        $arrayInput = $request->all();
        $model = new City;
        $results = $model->Search($arrayInput);
        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $results
        ];
        return response()->json($return);

    }

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'population'=>'required|integer',
            'area'=>'required|integer',
        ]);

        $arrayInput = $request->all();

        $model = new City;
            
        $results = $model->createv2($arrayInput);

        $return = [
            'status' => '1',
            'code' => '200',
        ];

        $return['data'] = $results;

        return response()->json($return);
    }

    public function detail(Request $request, $id)
    {
        $model = new City;

        $City =  $model->detail($id);

        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $City
        ];
        return response()->json($return);
    }

    public function delete(Request $request, $id)
    {
        
        $model = new City();

        $City = $model->deletev2($id);
        
        $return = [
            'status' => '1',
            'code' => '200',
            'message' => 'deleted',
            'data' => $City
        ];
        return response()->json($return);
    }

    public function update(Request $request, $id)
    {

        $arrayInput = $request->all();

        $model = City::where('ID',$id)->first();

        $City = $model->updatev2($arrayInput, $id);
       
        $return = [
            'code' => '200',
            'data' => $City
        ];
        
        return response()->json($return);
    }
}
