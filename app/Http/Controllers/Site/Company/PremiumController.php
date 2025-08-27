<?php
/*namespace App\Http\Controllers\Site\Company;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentLog;
use App\Services\Site\Company\FizzaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;*/
/*class PremiumController extends Controller {
    protected $company;
    public function __construct() {
        $this->currentLang = 'az';
        $this->company = auth('company')->user();
    }

    public function redirectToBank(Request $request) {
        $companyId = $this->company->id;
        $limit = (int) $request->input('limit');
        $amount = config("premium.limits.$limit") * 100;
        if (!$amount) {
            return back()->with('error', 'Yanlış seçim.');
        }

        session(['premium_days' => $limit, 'order_id' => Str::uuid(), 'amount' => $amount]);

        $fizza = new FizzaPayService();
        $payment = $fizza->createPayment($amount, session('order_id'),$companyId);
        if (!empty($payment['redirectUrl'])) {
            return redirect()->away($payment['redirectUrl']);
        }

        return back()->with('error', 'Ödəniş linki yaradıla bilmədi');
    }

    public function paymentCallback(Request $request) {
        $paymentKey = $request->input('payment_key');
        $paymentLog = PaymentLog::where('payment_key', $paymentKey)->orderBy('id','DESC')->first();
        if (empty($paymentLog)) {
            $amount = (double)session('amount');
        } else {
            $amount = (double)$paymentLog->amount;
        }
        $fizza = new FizzaPayService();
        $data = $fizza->checkStatus($paymentKey, $amount,$this->company->id);
        if (!empty($data['status']) && $data['status']['statusCode'] === 1) {
            $company = $this->company;
            $days = session('premium_days');
            $this->makeUserPremium($company, $days);
            Payment::create([
                'company_id' => $company->id,
                'payment_type' => 'other',
                'payment_status' => 'completed',
                'payment_amount' => $amount,
                'payment_date' => $data['paymentDate'],
                'payment_method' => 'card',
                'payment_reference' => $data['cardNumber'],
                'payment_description' => "{$days} günlük premium üçün {$amount} AZN ödənişi həyata keçirildi."
            ]);
            return redirect()->route('site.company.index')->with('success', 'Premium aktiv edildi');
        }
        return redirect()->route('site.company.index')->with('error', 'Ödəniş uğursuz oldu.');
    }

    protected function makeUserPremium($company, $days) {
        $company->is_premium = true;
        $company->is_paid = true;

        if ($company->premium_expires_at && $company->premium_expires_at > now()) {
            // Premium hələ aktivdirsə → mövcud tarixə gün əlavə et
            $company->premium_expires_at = $company->premium_expires_at->addDays($days);
        } else {
            // Premium bitibsə → bugündən başlayır
            $company->premium_expires_at = now()->addDays($days);
        }

        $company->save();
    }
}*/


namespace App\Http\Controllers\Site\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\PaymentLog;
use Carbon\Carbon;
use App\Services\Site\Company\FizzaPayService;

class PremiumController extends Controller
{
    protected $company;

    public function __construct()
    {
        $this->currentLang = 'az';
        $this->company = auth('company')->user();
    }

    public function redirectToBank(Request $request)
    {
        $companyId = $this->company->id;
        $planKey = $request->input('plan');
        $plan = config("premium.limits.$planKey");

        if (!$plan) {
            return back()->with('error', 'Yanlış seçim.');
        }

        $amount = $plan['amount'] * 100; // ⚠️ Əgər Fizza qəpik istəyirsə → *100 elə
        $orderId = Str::uuid();
        $fizza = new FizzaPayService();
        $payment = $fizza->createPayment($amount, $orderId, $companyId);

        session(['premium_days' => $plan, 'order_id' => $orderId, 'amount' => $amount]);

        if (!empty($payment['redirectUrl'])) {
            return redirect()->away($payment['redirectUrl']);
        }

        return back()->with('error', 'Ödəniş linki yaradıla bilmədi');
    }

    public function paymentCallback(Request $request)
    {
        $paymentKey = $request->input('payment_key');
        $paymentLog = PaymentLog::where('payment_key', $paymentKey)->orderBy('id','DESC')->first();
        if (empty($paymentLog)) {
            $amount = (double)session('amount');
        } else {
            $amount = (double)$paymentLog->amount;
        }

        $fizza = new FizzaPayService();
        $data = $fizza->checkStatus($paymentKey, $amount, $this->company->id);

        if (!empty($data['status']) && $data['status']['statusCode'] === 1) {
            $company = $this->company;

            // Planı ödəniş logundan tapırıq
            $plan = collect(config('premium.limits'))
                ->firstWhere('amount', $amount);

            if (!$plan) {
                return redirect()->route('site.company.index')->with('error', 'Plan tapılmadı.');
            }
            $this->makeUserPremium($company, $plan);
            Payment::create([
                'company_id' => $company->id,
                'payment_type' => 'other',
                'payment_status' => 'completed',
                'payment_amount' => $amount,
                'payment_date' => $data['paymentDate'] ?? now(),
                'payment_method' => 'card',
                'payment_reference' => $data['cardNumber'] ?? null,
                'payment_description' => "{$plan['label']} premium üçün {$amount} AZN ödənişi həyata keçirildi."
            ]);

            return redirect()->route('site.company.index')->with('success', 'Premium aktiv edildi');
        }

        return redirect()->route('site.company.index')->with('error', 'Ödəniş uğursuz oldu.');
    }

    protected function makeUserPremium($company, $plan)
    {
        $company->is_premium = true;
        $company->is_paid = true;
        $expires = $company->premium_expires_at && Carbon::parse($company->premium_expires_at)->isFuture()
            ? Carbon::parse($company->premium_expires_at)
            : now();
        if (!empty($plan['days'])) {
            $expires = $expires->addDays($plan['days']);
        } elseif (!empty($plan['months'])) {
            $expires = $expires->addMonthsNoOverflow($plan['months']);
        }

        $company->premium_expires_at = $expires;
        $company->save();
    }
}

