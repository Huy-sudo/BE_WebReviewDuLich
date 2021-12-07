<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class reviewController extends Controller
{
    
    public function index(Request $request){
        $arrayInput = $request->all();
        $model = new Review;
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
            'ID_place'=>'required|integer',
            'content'=>'required|string'
        ]);

        $arrayInput = $request->all();

        $model = new Review;
            
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
        $model = new Review();

        $Review =  $model->detail($id);
        
        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $Review
        ];
        return response()->json($return);
    }

    public function delete(Request $request, $id)
    {
        
        $model = new Review;

        $Review =  $model->deletev2( $id);
        
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

        $model = new Review();

        $Review = $model->updatev2($arrayInput, $id);
       
        $return = [
            'code' => '200',
            'data' => $Review
        ];
        
        return response()->json($return);
    }
}
