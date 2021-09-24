<?php

namespace App\GraphQL\Queries;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class UserQuery extends Query
{
  protected $attributes = [
    'name' => 'user',
  ];
  protected $user = [];
  public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
  {
    if(auth('sanctum')->user())
     {
      $user = auth('sanctum')->user();
      return true;
     }    
  }
  public function type(): Type
  {
    return GraphQL::type('User');
  }

  public function resolve($root, $args)
  {
      return auth('sanctum')->user();
  }
}