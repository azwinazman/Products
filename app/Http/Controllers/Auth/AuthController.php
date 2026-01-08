<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        $request->validate(
            [ 'email' => 'required|email',
              'password' => 'required']
        );

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json('User is not authenticated');
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(
            [ 'user' => $user,
            'token' => $token ], 200
        );
    }

    public function store(Request $request) {
        $validated = $request->validate(
            [ 'name' => 'required|string|max:255',
              'email' => 'required|string|email|unique:users',
              'password' => [
                    'required',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
              ] 
            ]
        );

        

        $user = User::create(
            [ 'name' => $validated['name'],
              'email' => $validated['email'],
              'password' => Hash::make($validated['password']) ] 
        );

        if (strtolower($validated['name']) == 'admin') {
            $user->assignRole('admin');
        } else if (strtolower($validated['name']) == 'staff') {
            $user->assignRole('staff');
        } else {
            $user->assignRole('viewer');
        }


        return response()->json(
            [ 'message' => 'User registered successfully!',
              'success' => true,
              'data' => $user], 201
        );
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        // Revoke (delete) the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function me() {
        $user = Auth::user();

        return response()->json(
            [ 'success' => true,
              'data' => $user], 200 
        );
    }
}
