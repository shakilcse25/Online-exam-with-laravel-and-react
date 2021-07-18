<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function registerCandidate( Request $request ) {
        $role = Role::where('name','=','candidate')->first();

        $create =  User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make( $request->input('password') ),
        ]);
        if( $create ) {

            UserRole::create([
               'user_id'  => $create->id,
               'role_id' => ( isset($role->id ) ) ? $role->id : 0,
            ]);

            return response()->json([
                'status' => 'success',
            ], Response::HTTP_OK );
        }else{
            return response()->json([
                'status' => 'error',
            ], Response::HTTP_UNAUTHORIZED );
        }
    }

    public function loginCandidate( Request $request ) {
        if( ! Auth::attempt( $request->only( 'email', 'password' ) ) ) {
            return response()->json([
                'status' => 'invalid',
            ], Response::HTTP_OK );
        }
        $user   = auth()->user();

        if( $user->user_role->role->name != 'candidate' ) {
            return response()->json([
                'status' => 'invalid',
            ], Response::HTTP_OK );
        }

        $token  = $user->createToken('token')->plainTextToken;
        $cookie = cookie( 'jwt', $token, 0.1 );

        return response()->json([
            'status'   => 'success',
            'token' => $token,
        ], Response::HTTP_OK )->withCookie( $cookie );
    }

    public function user() {
        $user = Auth::user();
        return response()->json([
            'data' => $user,
        ], Response::HTTP_OK );
    }
}
