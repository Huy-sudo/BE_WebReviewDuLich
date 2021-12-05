<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Review;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $fillable = [
        'ID',
        'name',
        'ID_city',
        'address',
        'totalReview',
        'isReal',
        'picture',
        'created_at',
        'updated_at'
    ];

    protected function city()
    {
        return $this->hasOne(City::class, 'ID', 'ID_city');
    }

    protected function review()
    {
        return $this->hasMany(Review::class,'ID_place','ID');
    }

    public function Search(array $request){

        $model = $this;

        if(isset($request['isReal']) && $request['isReal']){
            $model = $model->where('isReal',$request['isReal']);
        }

        if(isset($request['ID']) && $request['ID']){
            $model = $model->where('ID',$request['ID']);
        }

        if(isset($request['name']) && $request['name']){
            $model = $model->where('name','LIKE','%'.$request['name'].'%');
        }

        if(isset($request['ID_city']) && $request['ID_city']){
            $model = $model->where('ID_city',$request['ID_city']);
        }

        if(isset($request['address']) && $request['address']){
            $model = $model->where('address','LIKE','%'.$request['address'].'%');
        }

        return $model->orderBy('totalReview','desc')->get();
    }

    public function createv2(Array $request)
    {

        $arrayInput = $request;

        $arrayInput['isReal'] = 0;
                
        $arrayInput = array_merge($arrayInput,$request);
        
        $results = Place::create($arrayInput);

        return $results;

    }

    public function detail($id)
    {
        
        $Place = Place::where('ID', $id)->first();

        return $Place;
    }

    public function deletev2($id)
    {
        
        $Place = Place::where('ID', $id)->first();

        $Place->update(['isReal'=>'2']);

        return $Place;
    }

    public function updatev2(Array $request)
    {

        $arrayInput = [];
        if(isset($request['isReal']) && $request['isReal']){
            $arrayInput['isReal'] =$request['isReal'];
        }

        if(isset($request['name']) && $request['name']){
            $arrayInput['name'] =$request['name'];
        }

        if(isset($request['ID_city']) && $request['ID_city']){
            $arrayInput['ID_city'] =$request['ID_city'];
        }

        if(isset($request['address']) && $request['address']){
            $arrayInput['address'] =$request['address'];
        }

        $this->update($arrayInput);
        
        return $this;
    }
}
