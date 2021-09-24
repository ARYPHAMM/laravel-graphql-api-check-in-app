<?php
 namespace App\graphql\Mutations;

 use App\User;
 use Rebing\GraphQL\Support\Facades\GraphQL;
 use GraphQL\Type\Definition\Type;
 use Rebing\GraphQL\Support\Mutation;
 use Illuminate\Support\Facades\Hash;

 class UpdateUserMutation extends Mutation
 {
     protected $attributes = [
         'name' => 'updateUser'
     ];
 
     public function type(): Type
     {
         return GraphQL::type('User');
     }
 
     public function args(): array
     {
         return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'fullname' => [
                'name' => 'fullname',
                'type' =>  Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' =>  Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' =>  Type::string(),
            ],
            'gender' => [
                'name' => 'gender',
                'type' =>  Type::string(),
            ],
            'address' => [
                'name' => 'address',
                'type' =>  Type::string(),
            ],
         ];
     }
     public function resolve($root, $args)
     {
         $user = User::findOrFail($args['id']);
         if(@$args['password'] != '')
           $args['password'] = Hash::make($args['password']);
         else
          unset($args['password']);
         $user->fill($args);
         $user->save();
 
         return $user;
     }
}