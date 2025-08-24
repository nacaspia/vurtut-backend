<?php
namespace App\Helpers\Company;

use App\Models\CompanyToken;
use Carbon\Carbon;
class Tokenizer
{
    private $token=NULL;

    public  function run(int $company_id, $client){
        $currentDateTime = Carbon::now()->subHours(24);
        $user_token = CompanyToken::where(['company_id' => $company_id])->
                                where('created_at', '<=', $currentDateTime)->first();

        if ($user_token)
        {
            $user_token->update([
                'created_at'=>$currentDateTime,
                'client'=>$client,
            ]);
            return $user_token->token;
        }

        CompanyToken::where(['company_id' => $company_id])->
        where('created_at', '>', $currentDateTime)->delete();

        $this->setToken();
        $token = $this->getToken();
        $companyToken = new CompanyToken();
        $companyToken->token = $token;
        $companyToken->created_at = $currentDateTime;
        $companyToken->client = $client;
        $companyToken->company_id = $company_id;
        $companyToken->save();

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
