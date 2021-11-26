<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Place;
use App\Models\Review;

class City extends Model
{
    use HasFactory;

    protected $table = 'citys';

    protected $fillable = [
        'ID',
        'name',
        'population',
        'area',
        'picture',
        'content',
        'status',
        'created_at',
        'updated_at'
    ];

    public function place()
    {
        return $this->hasMany(Place::class, 'ID_city', 'ID');

    }

    public function review()
    {
        return $this->hasMany(Review::class, 'ID_city', 'ID');
    }

    public function Search(array $request){

        $model = $this;

        if(isset($request['status']) && $request['status']){
            $model = $model->where('status',$request['status']);
        }

        if(isset($request['ID']) && $request['ID']){
            $model = $model->where('ID',$request['ID']);
        }

        if(isset($request['name']) && $request['name']){
            $model = $model->where('name','LIKE','%'.$request['name'].'%');
        }

        if(isset($request['population']) && $request['population']){
            $model = $model->where('population',$request['population']);
        }

        if(isset($request['area']) && $request['area']){
            $model = $model->where('area',$request['area']);
        }

        if(isset($request['content']) && $request['content']){
            $model = $model->where('content','LIKE','%'.$request['content'].'%');
        }

        $sorted = $model->orderBy('created_at', 'desc');

        $results = $sorted->get();

        return $results;
    }

    public function createv2(Array $request)
    {

        $arrayInput = $request;

        $arrayInput['status'] = 1;
                
        $arrayInput = array_merge($arrayInput,$request);
        
        $results = City::create($arrayInput);

        return $results;

    }

    public function detail($id)
    {
        
        $City = City::where('ID', $id)->first();

        return $City;
    }

    public function deletev2($id)
    {
        
        $City = City::where('ID', $id)->first();

        $City->update(['status'=>'0']);

        return $City;
    }

    public function updatev2(Array $request)
    {

        $arrayInput = [];
        if(isset($request['status']) && $request['status']){
            $arrayInput['status'] =$request['status'];
        }

        if(isset($request['name']) && $request['name']){
            $arrayInput['name'] =$request['name'];
        }

        if(isset($request['population']) && $request['population']){
            $arrayInput['population'] =$request['population'];
        }

        if(isset($request['area']) && $request['area']){
            $arrayInput['area'] =$request['area'];
        }

        if(isset($request['content']) && $request['content']){
            $arrayInput['content'] =$request['content'];
        }

        $this->update($arrayInput);
        
        return $this;
    }

}
