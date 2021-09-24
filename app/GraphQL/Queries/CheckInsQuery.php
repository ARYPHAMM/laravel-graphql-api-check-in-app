<?php 
namespace App\graphql\Queries;

use App\CheckIn;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;

class CheckInsQuery extends Query
{
    protected $attributes = [
        'name' => 'CheckIns',
    ];
    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
      if(auth('sanctum')->user() && (auth('sanctum')->user()->level == 'admin' || auth('sanctum')->user()->level == 'master'))
       {
        return true;
       }
      
    }
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('CheckIn'));
    }

    public function resolve($root, $args)
    {
        return CheckIn::all();
    }
}