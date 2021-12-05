<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Rate;
use App\Models\Review;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = 'users';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone_number',
        'email_verified_at',
        'Date_of_birth',
        'avatar',
        'status',
        'isAdmin',
        'created_at',
        'updated_at'
    ];

    public function review()
    {
        return $this->hasMany(Review::class, 'ID_user', 'id');
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'ID_user', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Search(array $request){

        $model = $this;

        if(isset($request['ID']) && $request['ID']){
            $model = $model->where('ID',$request['ID']);
        }

        if(isset($request['name']) && $request['name']){
            $model = $model->where('name','LIKE','%'.$request['name'].'%');
        }

        if(isset($request['email']) && $request['email']){
            $model = $model->where('email',$request['email']);
        }

        if(isset($request['phone_number']) && $request['phone_number']){
            $model = $model->where('phone_number',$request['phone_number']);
        }

        if(isset($request['avatar']) && $request['avatar']){
            $model = $model->where('avatar',$request['avatar']);
        }

        if(isset($request['status']) && $request['status']){
            $model = $model->where('status',$request['status']);
        }

        if(isset($request['isAdmin']) && $request['isAdmin']){
            $model = $model->where('isAdmin',$request['isAdmin']);
        }

        $sorted = $model->orderBy('created_at', 'desc');

        $results = $sorted->get();

        return $results;
    }

    public function createv2(Array $request)
    {

        $arrayInput = $request;
                
        $arrayInput = array_merge($arrayInput,$request);
        
        $results = User::create($arrayInput);

        return $results;

    }

    public function detail($id)
    {
        
        $User = User::where('ID', $id)->first();

        return $User;
    }

    public function deletev2($id)
    {
        
        $User = User::where('ID', $id)->first();

        return $User;
    }

    public function updatev2(Array $request)
    {

        $arrayInput = [];
       
        if(isset($request['name']) && $request['name']){
            $arrayInput['name'] =$request['name'];
        }

        if(isset($request['phone_number']) && $request['phone_number']){
            $arrayInput['phone_number'] =$request['phone_number'];
        }

        if(isset($request['email']) && $request['email']){
            $arrayInput['email'] =$request['email'];
        }

        if(isset($request['avatar']) && $request['avatar']){
            $arrayInput['avatar'] =$request['avatar'];
        }

        if(isset($request['status']) && $request['status']){
            $arrayInput['status'] =$request['status'];
        }

          if(isset($request['isAdmin']) && $request['isAdmin']){
            $arrayInput['isAdmin'] =$request['isAdmin'];
        }

        $this->update($arrayInput);
        
        return $this;
    }
}
