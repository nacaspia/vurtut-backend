<?php
namespace App\Helpers\User;
use App\Models\UserToken;
use Carbon\Carbon;
class Tokenizer
{
    private $token=NULL;

    public  function run(int $user_id, $client){
        $currentDateTime = Carbon::now()->subHours(24);
        $user_token = UserToken::where(['user_id' => $user_id])->
        where('created_at', '<=', $currentDateTime)->first();

        if ($user_token)
        {
            $user_token->update([
                'created_at'=>$currentDateTime,
                'client'=>$client,
            ]);
            return $user_token->token;
        }

        UserToken::where(['user_id' => $user_id])->
        where('created_at', '>', $currentDateTime)->delete();

        $this->setToken();
        $token = $this->getToken();
        $userToken = new UserToken();
        $userToken->token = $token;
        $userToken->created_at = $currentDateTime;
        $userToken->client = $client;
        $userToken->user_id = $user_id;
        $userToken->save();

        return $token;
    }

    private function setToken(){
        $this->token = $this->quickRandom(60);
    }

    private function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    private function getToken(){
        return $this->token;
    }

    /*public static function getUserData(){
        $getTokenData = UserToken::where([
            'client' => $request->header('client'),
            'token'  => $request->header('token')
        ])->first();

        if($getTokenData){
            $userData = User::wehere('id',$getTokenData->user->id)->first();
            if($userData)
                return $userData;
        }
        return false;
    }*/
}
