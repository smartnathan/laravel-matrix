<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function register(UserRequest $request)
	{
		$requestData = $request->all();
		$requestData['password'] = Hash::make($requestData['password']);
		$user = User::create($requestData);
		$token = $user->createToken('matrixapp')->plainTextToken;
		$user->token = $token;
		return new UserResource($user);
	}

	public function login(Request $request)
	{
		$credentials = $request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);

		if (Auth::attempt($credentials)) {
			$user = User::where('email', $credentials['email'])->first();
			$token = $user->createToken('matrixapp')->plainTextToken;
			$user->token = $token;
			return new UserResource($user);
		} else {
			return response()->json(['error' => 'Authentication failed.'], 401);
		}

	}

	public function logout(UserRequest $request)
	{
		$request->user()->tokens()->delete();
		return response()->json(['message' => 'Logout successfully']);
	}

	
}
