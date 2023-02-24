<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepositoryInterface;

class UserAuthController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $UserRepositoryInterface)
    {
        $this->userRepository = $UserRepositoryInterface;

        $this->middleware('auth:api')->except('register','login');
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100',
            'isAdmin' => 'required|string|boolean',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = $this->userRepository->registerUser($request);

        return response()->json([
            'status' => true,
            "message" => "Success create user! Please log in to your account",
            'user' => $user,
        ], 200);
    }

    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:8',
        ]);

        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized!'
            ],401);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token')->accessToken;
        
        return response()->json([
            'status' => true,
            'token' => $tokenResult
        ]);

    }

    public function user($id){

        $response = $this->userRepository->getUserById($id);
        
        return response()->json([
            "status" => true,
            "message" => "Success get user!",
            "data" => $response
        ]);
    }

    public function logout(Request $request){

        $request->user()->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Logged out!'
        ]);
    }
}
