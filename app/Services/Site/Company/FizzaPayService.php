<?php

namespace App\Services\Site\Company;

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
        $this->merchantName = env('FPAY_MERCHANT_NAME');
        $this->username     = env('FPAY_USERNAME');
        $this->userid    = env('FPAY_USERID');
        $this->password     = env('FPAY_PASSWORD');
        $this->secretKey    = env('FPAY_SECRET_KEY');
    }

    // Login və token almaq
    public function login()
    {
        $url = "https://payments.fpay.az/fizzapay/login/LoginWebUser";

        $response = Http::withBasicAuth($this->username, $this->password)
            ->asJson()
            ->post($url, [
                'username' => $this->username,
                'password' => $this->password
            ]);

        return $response->successful() ? $response->json() : null;
    }

    // Payment key yaratmaq
    public function createPayment($amount, $orderId)
    {
        $login = $this->login();

        if (!$login || empty($login['token'])) {
            return null;
        }

        $webUserId = $login['webUserId'];
        $token     = $login['token'];

        $description = "Premium_$orderId";
        $cardType    = "v"; // Visa
        $hashCode    = md5("{$this->secretKey}{$this->merchantName}{$cardType}{$amount}{$description}");

        $url = "https://payments.fpay.az/fizzapay/fpay/GetPaymentKey";

        $response = Http::withBasicAuth($this->username, $this->password)
            ->asJson()
            ->post($url, [
                "merchantName" => $this->merchantName,
                "amount"       => $amount,
                "lang"         => "az",
                "cardType"     => $cardType,
                "description"  => $description,
                "webUserId"    => $webUserId,
                "token"        => $token,
                "hashCode"     => $hashCode
            ]);

        return $response->successful() ? $response->json() : null;
    }

    // Payment status yoxlamaq
    public function checkStatus($paymentKey, $amount = 0)
    {
        $hashCode = md5("{$this->secretKey}{$paymentKey}{$amount}");
        $url = "https://payments.fpay.az/fizzapay/fpay/GetPaymentResult";

        $response = Http::withBasicAuth($this->username, $this->password)
            ->asJson()
            ->post($url, [
                "paymentKey" => $paymentKey,
                "hashCode"   => $hashCode
            ]);

        return $response->successful() ? $response->json() : null;
    }
}
