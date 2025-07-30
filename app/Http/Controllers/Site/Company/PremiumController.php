<?php

namespace App\Http\Controllers\Site\Company;

use App\Http\Controllers\Controller;
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

        // Məlumatı session və ya DB-də saxla
        session([
            'premium_days' => $limit,
            'order_id' => Str::uuid(),
        ]);

        // Bank API ilə yönləndirməyə hazırlıq
        $bankParams = [
            'merchant_id' => env('BANK_MERCHANT_ID'),
            'order_id' => session('order_id'),
            'amount' => number_format($amount, 2, '.', ''), // Məs: 10.00
            'currency' => '944', // AZN üçün ISO kodu
            'return_url' => route('site.company.premium.paymentCallback'),
            // başqa tələb olunan parametrlər
        ];

        $toBankUrl = '';
        // Bankın formuna yönləndirmə
        return view('site.company.premium.redirect', compact('bankParams','toBankUrl'));
    }

    public function paymentCallback(Request $request)
    {
        $status = $request->input('status'); // bu bankdan asılıdır

        if ($status === 'success') {
            $user = auth()->user();
            $days = session('premium_days', 30);
            $this->makeUserPremium($user, $days);

            return redirect()->route('dashboard')->with('success', 'Premium aktiv edildi');
        }

        return redirect()->route('dashboard')->with('error', 'Ödəniş uğursuz oldu.');
    }


}
