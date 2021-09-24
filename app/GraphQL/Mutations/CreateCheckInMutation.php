<?php
namespace App\graphql\Mutations;
use App\User;
use App\CheckIn;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CreateCheckInMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createCheckIn'
    ];
    public function type(): Type
    {
        return GraphQL::type('CheckIn');
    }
    public function args(): array
    {
        return [
            'username' => [
                'name' => 'username',
                'type' =>  Type::string(),
            ],
            'password' => [
                'name' => 'password',
                'type' =>  Type::string(),
            ]
        ];
    }
    public function resolve($root, $args)
    {
        $user = User::where('username', $args['username'])->first();
        if (!Hash::check($args['password'], $user->password, [])) {
            throw new \Exception('Error in Login');
        }
        if($user->level == 'admin' || $user->level == 'master')
          return null;
        $session = "";
        $getDate = DB::select("select * from check_ins where FROM_UNIXTIME(time, '%d/%m/%Y') like :time and user_id = :user_id ", [":time" => date('d/m/Y', time()), ":user_id" => $user->id]);
        $session = $this->setSession();
        $data = [];
        if (count($getDate) == 0 && $session['status'] != 'fail') { // new day
            $data = [
                "session" => $session['session'],
                "status" => $session['status'],
                "user_id" => $user->id,
                "time" => time(),
            ];
        }
        if (count($getDate) == 1 && $session['status'] != 'fail') { // only 1 session
            if ($getDate[0]->session == "morning" && $session['session'] != 'morning') {
                $data = [
                    "session" => $session['session'],
                    "status" => $session['status'],
                    "user_id" => $user->id,
                    "time" => time(),
                ];
            }
        }
        if (!empty($data)) {
            $checkIn = new CheckIn();
            $checkIn->fill($data);
            $checkIn->save();
            return $checkIn;
        }
        return CheckIn::find($getDate[count($getDate) - 1]->id);
    }
    public function setSession()
    {
        $time_now = strtotime(date('H:i', time()));
        $status = [
            "session" => 'fail',
            "status" => 'fail',
        ];
        if ($time_now >= strtotime("12:30") && $time_now <= strtotime("13:30")) // afternoon
        {
            $status["session"] = "afternoon";
            $status["status"] = "good";
        }
        if ($time_now >= strtotime("13:31") && $time_now <= strtotime("15:00")) {
            $status["session"] = "afternoon";
            $status["status"] = "late";
        }
        if ($time_now >= strtotime("07:30") && $time_now <= strtotime("08:10")) // morning
        {
            $status["session"] = "morning";
            $status["status"] = "good";
        }
        if ($time_now >= strtotime("08:11") && $time_now <= strtotime("09:30")) {
            $status["session"] = "morning";
            $status["status"] = "late";
        }
        return $status;
    }
}
