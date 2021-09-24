<?php 
namespace App\GraphQL\Types;

use App\CheckIn;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class CheckInType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CheckIn',
        'description' => 'check in list',
        'model' => CheckIn::class
    ];
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular check in',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => '',
            ],
            'status' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'time' => [
                'type' => Type::int(),
                'description' => '',
            ],
            'location' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'session' => [
                'type' => Type::string(),
                'description' => '',
            ],
        ];
    }
}