<?php 
namespace App\GraphQL\Types;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'users list',
        'model' => User::class
    ];


    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of a particular user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'email_verified_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'password' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'birthday' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'username' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'address' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'fullname' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'level' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '',
            ],
            'gender' => [
                'type' => Type::string(),
                'description' => '',
            ],
            'lock' => [
                'type' => Type::int(),
                'description' => '',
            ]

        ];
    }
}