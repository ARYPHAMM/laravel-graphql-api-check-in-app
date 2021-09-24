<?php
 namespace App\graphql\Mutations;

 use App\User;
 use Rebing\GraphQL\Support\Facades\GraphQL;
 use GraphQL\Type\Definition\Type;
 use Rebing\GraphQL\Support\Mutation;
 use Illuminate\Support\Facades\Hash;
 use Closure;
 use GraphQL\Type\Definition\ResolveInfo;

 class UpdateUserCurrentMutation extends Mutation
 {
     protected $attributes = [
         'name' => 'updateUserCurrent'
     ];
 
     public function type(): Type
     {
         return GraphQL::type('User');
     }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
      if(auth('sanctum')->user()  && $args['id'] == auth('sanctum')->user()->id)
        {
          return true;
        }
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