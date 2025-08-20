<?php
namespace App\Http\Controllers\Site\Company;

use App\Http\Controllers\Controller;
use App\Services\Site\Company\FizzaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PremiumController extends Controller {
    protected $company;
    public function __construct() {
        $this->currentLang = 'az';
        $this->company = auth('company')->user();
    }

    public function redirectToBank(Request $request) {
        $companyId = $this->company->id;
        $limit = (int) $request->input('limit');
        $amount = config("premium.limits.$limit");
        if (!$amount) {
            return back()->with('error', 'Yanlış seçim.');
        }
        session(['premium_days' => $limit, 'order_id' => Str::uuid(),]);

        $fizza = new FizzaPayService();
        $payment = $fizza->createPayment($amount, session('order_id'),$companyId);
        dd($payment);
        if (!empty($payment['redirectUrl'])) {
            return redirect()->away($payment['redirectUrl']);
        }

        return back()->with('error', 'Ödəniş linki yaradıla bilmədi');
    }

    public function paymentCallback(Request $request) {
        $paymentKey = $request->input('paymentKey');
        $amount     = $request->input('amount'); // əgər callbackda gəlirsə, yoxsa session-dan götür

        $fizza = new FizzaPayService();
        $status = $fizza->checkStatus($paymentKey, $amount);
        if (!empty($status['status']) && $status['status']['statusCode'] === 1) {
            $company = $this->company;
            $days = session('premium_days', 30);
            $this->makeUserPremium($company, $days);
            return redirect()->route('site.company.index')->with('success', 'Premium aktiv edildi');
        }
        return redirect()->route('site.company.index')->with('error', 'Ödəniş uğursuz oldu.');
    }

    protected function makeUserPremium($company, $days) {
        $company->is_premium = true;
        $company->premium_until = now()->addDays($days);
        $company->save();
    }
}
