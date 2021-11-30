<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Review;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = [
        'ID',
        'ID_user',
        'ID_review',
        'value',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'ID', 'ID_user');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'ID', 'ID_review');
    }

    public function Search(array $request){

        $model = $this;

        if(isset($request['ID']) && $request['ID']){
            $model = $model->where('ID',$request['ID']);
        }

        if(isset($request['ID_user']) && $request['ID_user']){
            $model = $model->where('ID_user',$request['ID_user']);
        }

        if(isset($request['value']) && $request['value']){
            $model = $model->where('value',$request['value']);
        }

        if(isset($request['ID_review']) && $request['ID_review']){
            $model = $model->where('ID_review',$request['ID_review']);
        }

        $sorted = $model->orderBy('created_at', 'desc');

        $results = $sorted->get();

        return $results;
    }

    public function createv2(Array $request)
    {

        $arrayInput = $request;
                
        $arrayInput = array_merge($arrayInput,$request);
        
        $results = Rate::create($arrayInput);

        return $results;

    }

    public function detail($id)
    {
        
        $Rate = Rate::where('ID', $id)->first();

        return $Rate;
    }

    public function deletev2($id)
    {
        
        $Rate = Rate::where('ID', $id)->first();

        return $Rate;
    }

    public function updatev2(Array $request)
    {

        $arrayInput = [];
       
        if(isset($request['ID_user']) && $request['ID_user']){
            $arrayInput['ID_user'] =$request['ID_user'];
        }

        if(isset($request['ID_review']) && $request['ID_review']){
            $arrayInput['ID_review'] =$request['ID_review'];
        }

        if(isset($request['value']) && $request['value']){
            $arrayInput['value'] =$request['value'];
        }


        $this->update($arrayInput);
        
        return $this;
    }
}
