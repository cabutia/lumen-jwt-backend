<?php

namespace App\Http\Controllers;

use Auth;
use \App\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
      $this->jwt = $jwt;
    }

    public function login(Request $r)
    {
      // Validar los datos
      $this->validate($r, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

      // Intentar loguear
      try {
        if (! $token = $this->jwt->attempt($r->only('email', 'password'))) {
          // Usuario no encontrado
          return response()->json(['user_not_found'], 404);
        }
      // Token expirado
      } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json(['token_expired'], 500);

      // Token invalido
      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json(['token_invalid'], 500);

      // Token ausente
      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent' => $e->getMessage()], 500);
      }

      // Creando respuesta
      $response = compact('token');
      $response['user'] = Auth::user();
      return response()->json($response);
    }

    public function register(Request $r)
    {
      $newUser = [
        'username' => $r->get('name'),
        'email' => $r->get('email'),
        'password' => Hash::make($r->get('password'))
      ];
      if ($user = User::create($newUser)) {
        return response()->json($user);
      }
      return response()->json($newUser);
    }

}
