<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Http\Resources\UsersResource;

Interface UserRepositoryInterface{

    public function registerUser($data);

    public function loginUser($data);

    public function getUserById($id);
}

?>