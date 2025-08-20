<?php

namespace App\Services\Site\Company;

use App\Models\PaymentLog;
use Illuminate\Support\Facades\Http;

class FizzaPayService
{
    protected $merchantName;
    protected $username;
    protected $userid;
    protected $password;
    protected $secretKey;

    public function __construct()
    {
        $this->merchantName = config('payment.fizzapay.merchant_name');
        $this->username     = config('payment.fizzapay.username');
        $this->userid    = config('payment.fizzapay.userid');
        $this->password     = config('payment.fizzapay.password');
        $this->secretKey    = config('payment.fizzapay.secret_key');
    }

    // Login və token almaq
    public function login()
    {
        $url = "https://payments.fpay.az/fizzapay/login/LoginWebUser";
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])
            ->withBasicAuth($this->username, $this->password)
            ->post($url, [
                'username' => $this->username,
                'password' => $this->password,
            ]);

        $data = $response->json(); // artıq işləyəcək

        return $data ??  null;
    }

    // Payment key yaratmaq
    public function createPayment($amount, $orderId, $companyId = null, $userId = null)
    {
        $login = $this->login();
        if (!$login || empty($login['token'])) {
            PaymentLog::create([
                'company_id' => $companyId,
                'user_id' => $userId,
                'payment_id' => null,
                'request' => ['amount' => $amount, 'orderId' => $orderId, 'companyId' => $companyId],
                'response' => $login,
                'status' => $login->status(),
                'message' => 'Ödəniş xidmətinə qoşulma mümkün olmadı'
            ]);
            return ['success' => false, 'message' => 'Ödəniş xidmətinə qoşulma mümkün olmadı'];
        }

        $webUserId = $login['webUserId'];
        $token     = $login['token'];

        $description = "Premium_$orderId";
        $cardType    = "v"; // Visa
        $hashCode    = md5("{$this->secretKey}{$this->merchantName}{$cardType}{$amount}{$description}");
        $url = "https://payments.fpay.az/fizzapay/fpay/GetPaymentKey";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withBasicAuth($this->username, $this->password)
            ->post($url, [
                "merchantName" => $this->merchantName,
                "amount"       => $amount,
                "lang"         => "az",
                "cardType"     => $cardType,
                "description"  => $description,
                "webUserId"    => $webUserId,
                "token"        => $token,
                "redirectUrl" => route('site.company.premium.paymentCallback'),
                "hashCode"     => $hashCode
            ]);
        PaymentLog::create([
            'company_id' => $companyId,
            'user_id' => $userId,
            'payment_id' => null,
            'request' => json_encode([['amount' => $amount, 'orderId' => $orderId, 'companyId' => $companyId]]),
            'response' => $response,
            'status' => $response->successful(),
            'message' => '$response->body()'
        ]);
        $data = $response->json();
        return  $data ??  null;
    }

    // Payment status yoxlamaq
    public function checkStatus($paymentKey, $amount = 0)
    {
        $hashCode = md5("{$this->secretKey}{$paymentKey}{$amount}");
        $url = "https://payments.fpay.az/fizzapay/fpay/GetPaymentResult";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->withBasicAuth($this->username, $this->password)
            ->post($url, [
                "paymentKey" => $paymentKey,
                "hashCode"   => $hashCode
            ]);
        $data = $response->json();
        return  $data ??  null;
    }
}
