<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (
            !$user ||
            !Hash::check(
                $request->password,
                $user->password
            )
        ) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken(
            $request->email
        )->plainTextToken;

        return response()->json([
            'token'         => $token,
            'fullname'      => $user->name,
            'email'         => $user->email,
            'role'          => $user->roles->first()->name,
            'permissions'   => $user->roles->first()->permissions
                                                        ->pluck('name'),
        ]);
    }

    public function me(Request $request) 
    {

        $user = User::find(Auth::guard('sanctum')->id());
        
        $data = [
            'fullname'      => $user->name,
            'email'         => $user->email,
            'role'          => $user->roles->first()->name,
            'permissions'   => $user->roles->first()->permissions->pluck('name')
        ];

        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
