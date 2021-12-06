<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\City;
use App\Models\Place;
use App\Models\Rate;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'ID',
        'name',
        'ID_user',
        'ID_place',
        'ID_city',
        'content',
        'status',
        'views',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'ID_user');
    }

    public function place()
    {
        return $this->hasOne(Place::class, 'ID', 'ID_place');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'ID', 'ID_city');
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'ID_review', 'ID');
    }

    public function comment()
    {
        return $this->hasMany(Rate::class, 'ID_review', 'ID');
    }

    public function Search(array $request){

        $model = $this;

        if(isset($request['status']) && $request['status']){
            $model = $model->where('status',$request['status']);
        }

        if(isset($request['ID']) && $request['ID']){
            $model = $model->where('ID',$request['ID']);
        }

        if(isset($request['ID_user']) && $request['ID_user']){
            $model = $model->where('ID_user',$request['ID_user']);
        }

        if(isset($request['content']) && $request['content']){
            $model = $model->where('content','LIKE','%'.$request['content'].'%');
        }

        if(isset($request['ID_city']) && $request['ID_city']){
            $model = $model->where('ID_city',$request['ID_city']);
        }

        if(isset($request['ID_place']) && $request['ID_place']){
            $model = $model->where('ID_place',$request['ID_place']);
        }

        if(isset($request['name']) && $request['name']){
            $model = $model->where('name',$request['name']);
        }

        $sorted = $model->orderBy('created_at', 'desc');

        $results = $sorted->with('city')->with('user')->with('place')->get();

        return $results;
    }

    public function createv2(Array $request)
    {

        $arrayInput = $request;

        $arrayInput['status'] = 2;
                
        $arrayInput = array_merge($arrayInput,$request);
        
        $results = Review::create($arrayInput);

        return $results;

    }

    public function detail($id)
    {
        
        $Review = Review::where('ID', $id)->first();

        return $Review->with('city')->with('user')->with('place')->get();
    }

    public function deletev2($id)
    {
        
        $Review = Review::where('ID', $id)->first();

        $Review->update(['status'=>'0']);

        return $Review;
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

        if(isset($request['ID_user']) && $request['ID_user']){
            $arrayInput['ID_user'] =$request['ID_user'];
        }

        if(isset($request['date']) && $request['date']){
            $arrayInput['date'] =$request['date'];
        }

        if(isset($request['content']) && $request['content']){
            $arrayInput['content'] =$request['content'];
        }

        if(isset($request['ID_place']) && $request['ID_place']){
            $arrayInput['ID_place'] =$request['ID_place'];
        }

        if(isset($request['ID_city']) && $request['ID_city']){
            $arrayInput['ID_city'] =$request['ID_city'];
        }


        $this->update($arrayInput);
        
        return $this;
    }
}
