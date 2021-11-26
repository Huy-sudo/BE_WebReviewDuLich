<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class rateController extends Controller
{
    public function index(Request $request){
        $arrayInput = $request->all();
        $model = new Rate;
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
            'ID_user'=>'required|integer',
            'ID_review'=>'required|integer',
            'value'=>'required|integer'
        ]);

        $arrayInput = $request->all();

        $model = new Rate;
            
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
        $model = new Rate;

        $Rate =  $model->detail($id);

        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $Rate
        ];
        return response()->json($return);
    }

    public function delete(Request $request, $id)
    {
        
        $model = new Rate;

        $Rate =  $model->deletev2( $id);
        
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

        $model = Rate::where('ID',$id)->first();

        $Rate = $model->updatev2($arrayInput, $id);
       
        $return = [
            'code' => '200',
            'data' => $Rate
        ];
        
        return response()->json($return);
    }
}
