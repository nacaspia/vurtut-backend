<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function redirect($provider, $type)
    {
        if (!in_array($type, ['user', 'company'])) {
            abort(404);
        }

        $redirectUrl = url("social/{$provider}/callback/{$type}");
        return Socialite::driver($provider)->with(['redirect_uri' => $redirectUrl])->redirect();
    }

    public function callback($provider, $type)
    {
//        try {
            $socialUser = Socialite::driver($provider)->stateless()
                ->with(['redirect_uri' => url("social/{$provider}/callback/{$type}")])->user();
            if ($type == 'user') {
                $model = User::class;
            } else if ($type == 'company') {
                $model = Company::class;
            } else {
                abort(404);
            }

            // Eyni email varsa, daxil et, yoxsa yarad
            $account = $model::where('email', $socialUser->getEmail())->first();
            if (!$account) {
                $account = new $model();
                $account->full_name = $socialUser->getName() ?? $socialUser->getNickname();
                $account->email = $socialUser->getEmail();
                $account->phone = '+994';
                $account->password = Hash::make(Str::random(12));
                $account->status = 1; // sosial giriş olduğu üçün aktiv
                if ($type == 'company') {
                    $account->slug = Str::slug($account->full_name);
                }
                $account->save();
            }

            // login
            auth()->guard($type == 'user' ? 'user' : 'company')->login($account);
            return redirect('/' . $type . '/account');
       /* } catch (\Exception $e) {
            return redirect('/')->with('error', 'Sosial giriş zamanı xəta baş verdi.');
        }*/
    }
}
