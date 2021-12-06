<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Review;
use App\Models\Rate;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'ID',
        'ID_user',
        'ID_review',
        'content',
        'status',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'ID_user');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'ID', 'ID_review');
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

        if(isset($request['ID_review']) && $request['ID_review']){
            $model = $model->where('ID_review',$request['ID_review']);
        }

        if(isset($request['content']) && $request['content']){
            $model = $model->where('content','LIKE','%'.$request['content'].'%');
        }

        $sorted = $model->orderBy('created_at', 'desc');

        $results = $sorted->with('user')->get();

        return $results;
    }

    public function createv2(Array $request)
    {

        $arrayInput = $request;

        $arrayInput['status'] = 1;
                
        $arrayInput = array_merge($arrayInput,$request);
        
        $results = Comment::create($arrayInput);

        return $results;

    }

    public function detail($id)
    {
        
        $Comment = Comment::where('ID', $id)->first();

        return $Comment;
    }

    public function deletev2($id)
    {
        
        $Comment = Comment::where('ID', $id)->first();

        $Comment->update(['status'=>'0']);

        return $Comment;
    }

    public function updatev2(Array $request)
    {

        $arrayInput = [];
        if(isset($request['status']) && $request['status']){
            $arrayInput['status'] =$request['status'];
        }

        if(isset($request['ID_user']) && $request['ID_user']){
            $arrayInput['ID_user'] =$request['ID_user'];
        }

        if(isset($request['ID_review']) && $request['ID_review']){
            $arrayInput['ID_review'] =$request['ID_review'];
        }

        if(isset($request['content']) && $request['content']){
            $arrayInput['content'] =$request['content'];
        }

        $this->update($arrayInput);
        
        return $this;
    }
}
