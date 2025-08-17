<?php

namespace App\Http\Controllers\Site\Company;

use App\Http\Controllers\Controller;
use App\Services\Site\Company\FizzaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PremiumController extends Controller
{
    public function redirectToBank(Request $request)
    {
        $limit = (int) $request->input('limit');
        $amount = config("premium.limits.$limit");

        if (!$amount) {
            return back()->with('error', 'Yanlış seçim.');
        }

        session([
            'premium_days' => $limit,
            'order_id' => Str::uuid(),
        ]);

        $fizza = new FizzaPayService();
        $payment = $fizza->createPayment($amount, session('order_id'));

        if (!empty($payment['redirectUrl'])) {
            return redirect()->away($payment['redirectUrl']);
        }

        return back()->with('error', 'Ödəniş linki yaradıla bilmədi');
    }

    public function paymentCallback(Request $request)
    {
        $paymentKey = $request->input('paymentKey');
        $amount     = $request->input('amount'); // əgər callbackda gəlirsə, yoxsa session-dan götür

        $fizza = new FizzaPayService();
        $status = $fizza->checkStatus($paymentKey, $amount);

        if (!empty($status['status']) && $status['status']['statusCode'] === 1) {
            $user = auth()->user();
            $days = session('premium_days', 30);
            $this->makeUserPremium($user, $days);

            return redirect()->route('dashboard')->with('success', 'Premium aktiv edildi');
        }

        return redirect()->route('dashboard')->with('error', 'Ödəniş uğursuz oldu.');
    }

    protected function makeUserPremium($user, $days)
    {
        $user->is_premium = true;
        $user->premium_until = now()->addDays($days);
        $user->save();
    }
}
