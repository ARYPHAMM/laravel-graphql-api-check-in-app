<?php

namespace App\graphql\Mutations;

use App\User;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateUserMutation extends Mutation
{
	protected $attributes = [
		'name' => 'createUser'
	];

	public function type(): Type
	{
		return GraphQL::type('User');
	}

	public function args(): array
	{
		return [
			'username' => [
				'name' => 'username',
				'type' =>  Type::nonNull(Type::string()),
			],
			'email' => [
				'name' => 'email',
				'type' =>  Type::nonNull(Type::string()),
			],
			'password' => [
				'name' => 'password',
				'type' =>  Type::nonNull(Type::string()),
			],
			'level' => [
				'name' => 'level',
				'type' =>  Type::nonNull(Type::string()),
			]
		];
	}

	public function resolve($root, $args)
	{
		$user = new User();
		$user->fill($args);
		$user->save();

		return $user;
	}
}
