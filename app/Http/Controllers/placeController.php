<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class placeController extends Controller
{
    public function index(Request $request){
        $arrayInput = $request->all();
        $model = new Place;
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
            'ID_city'=>'required|integer',
        ]);

        $arrayInput = $request->all();

        $model = new Place;
            
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
        $model = new Place;

        $Place =  $model->detail($id);

        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $Place
        ];
        return response()->json($return);
    }

    public function delete(Request $request, $id)
    {
        
        $model = new Place;

        $Place =  $model->deletev2( $id);
        
        $return = [
            'status' => '0',
            'code' => '200',
            'message' => 'deleted'
        ];
        return response()->json($return);
    }

    public function update(Request $request, $id)
    {

        $arrayInput = $request->all();

        $model = Place::where('ID',$id)->first();

        $Place = $model->updatev2($arrayInput, $id);
       
        $return = [
            'code' => '200',
            'data' => $Place
        ];
        
        return response()->json($return);
    }
}
