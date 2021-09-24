<?php

namespace App\GraphQL\Queries;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Facades\Hash;
use Auth;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class LoginQuery extends Query
{
  protected $attributes = [
    'name' => 'login',
  ];


  public function type(): Type
  {
    return GraphQL::type('Token');
  }

  public function args(): array
  {
    return [
        'username' => [
            'name' => 'username',
            'type' => Type::string(),
            'rules' => ['required']
        ],
        'password' => [
            'name' => 'password',
            'type' => Type::string(),
            'rules' => ['required']
        ],
    ];
  }

  public function resolve($root, $args)
  {
    try {
      $credentials = [
          'username' => $args['username'],
          'password' => $args['password'],
      ];
      if (!Auth::attempt($credentials)) {
        return response()->json([
          'status_code' => 500,
          'message' => 'Unauthorized'
        ]);
      }
      $user = User::where('username', $args['username'])->first();
      if ( ! Hash::check($args['password'], $user->password, [])) {
         throw new \Exception('Error in Login');
      }
      $tokenResult = $user->createToken('authToken')->plainTextToken;
      return [
        'status_code' => 200,
        'access_token' => $tokenResult,
        'token_type' => 'Bearer',
        'user' => User::find($user->id),
      ];
    } catch (Exception $error) {
      return response()->json([
        'status_code' => 500,
        'message' => 'Error in Login',
        'error' => $error,
      ]);
    }
  }
}
?>