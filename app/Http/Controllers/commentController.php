<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class commentController extends Controller
{
    public function index(Request $request){
        $arrayInput = $request->all();
        $model = new Comment;
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
            'content'=>'required|string',
        ]);

        $arrayInput = $request->all();

        $model = new Comment;
            
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
        $model = new Comment;

        $Comment =  $model->detail($id);

        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $Comment
        ];
        return response()->json($return);
    }

    public function delete(Request $request, $id)
    {
        
        $model = new Comment;

        $Comment =  $model->deletev2( $id);
        
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

        $model = Comment::where('ID',$id)->first();

        $Comment = $model->updatev2($arrayInput, $id);
       
        $return = [
            'code' => '200',
            'data' => $Comment
        ];
        
        return response()->json($return);
    }
}
