<?php 
namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;


class TokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Token',
        'description' => 'token',
    ];


    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'token',
            ],
            'access_token' => [
                'type' => Type::string(),
                'description' => 'token',
            ],
            'token_type' => [
                'type' => Type::string(),
                'description' => 'token',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'user',
                // 'always' => ['id'],

            ],

        ];
    }
}