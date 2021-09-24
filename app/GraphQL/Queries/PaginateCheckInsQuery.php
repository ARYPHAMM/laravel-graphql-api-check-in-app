<?php 
namespace App\graphql\Queries;

use App\CheckIn;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;


class PaginateCheckInsQuery extends Query
{
    protected $attributes = [
        'name' => 'paginateCheckIns',
    ];
    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
      if(auth('sanctum')->user() && (auth('sanctum')->user()->level == 'admin' || auth('sanctum')->user()->level == 'master'))
       {
        return true;
       }
      
    }
    public function args(): array
    {
      return [
          'page' => [
              'name' => 'page',
              'type' => Type::int(),
          ],
          'limit' => [
              'name' => 'limit',
              'type' => Type::int(),
          ],
          'date' => [
              'name' => 'date',
              'type' => Type::string(),
          ],
      ];
    }
    public function type(): Type
    {
      return GraphQL::paginate('CheckIn');
    }

    public function resolve($root, $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
      $fields = $getSelectFields();
      return CheckIn::whereDate('created_at', $args['date'])->with($fields->getRelations())
          ->select($fields->getSelect())
          ->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}