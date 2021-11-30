<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class userController extends Controller
{
    public function index(Request $request){
        $arrayInput = $request->all();
        $model = new User;
        $results = $model->Search($arrayInput);
        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $results
        ];
        return response()->json($return);

    }

    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'name'=>'required|string',
    //         'population'=>'required|integer',
    //         'area'=>'required|integer',
    //     ]);

    //     $arrayInput = $request->all();

    //     $model = new User;
            
    //     $results = $model->createv2($arrayInput);

    //     $return = [
    //         'status' => '1',
    //         'code' => '200',
    //     ];

    //     $return['data'] = $results;

    //     return response()->json($return);
    // }

    public function detail(Request $request, $id)
    {
        $model = new User;

        $User =  $model->detail($id);

        $return = [
            'status' => '1',
            'code' => '200',
            'data' => $User
        ];
        return response()->json($return);
    }

    public function delete(Request $request, $id)
    {
        
        $model = new User();

        $User = $model->deletev2($id);
        
        $return = [
            'status' => '1',
            'code' => '200',
            'message' => 'deleted',
            'data' => $User
        ];
        return response()->json($return);
    }

    public function update(Request $request, $id)
    {

        $arrayInput = $request->all();

        $model = User::where('ID',$id)->first();

        $User = $model->updatev2($arrayInput, $id);
       
        $return = [
            'code' => '200',
            'data' => $User
        ];
        
        return response()->json($return);
    }
}
