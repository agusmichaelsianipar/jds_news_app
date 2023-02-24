<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsersResource;

class UserRepository implements UserRepositoryInterface{

    private $model;

    public function __construct(User $model){
        $this->model = $model;
    }

    public function getUserById($id)
    {
        return new UsersResource($this->model->findOrFail($id));
    }

    public function registerUser($data)
    {
        $comment = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'isAdmin' => $data->isAdmin,
            'password' => Hash::make($data->password),
        ]);

        return new UsersResource($comment);
    }

    
    public function loginUser($data)
    {
        
    }

}
