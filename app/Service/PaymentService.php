<?php

namespace App\Service;

use App\Models\Links;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Dao\PaymentDao;
use App\Models\Merchants;
use Illuminate\Support\Facades\Http;

class PaymentService
{

    protected PaymentDao $paymentDao;


    public function __construct(PaymentDao $paymentDao)
    {
        $this->paymentDao = $paymentDao;
    }


    public function Auth(array $data)
    {
        //dd($data['link_id']);
        $links = Links::where('id', $data['link_id'])->get()->toArray();
        $paymentInfo = $links[0];
        $merchants = Merchants::where('merchant_id', $paymentInfo['merchant_id'])->get()->toArray();
        $merchantInfo = $merchants[0];
        $secret_key = $merchantInfo['merchant_secretkey'];
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);

        //dd($merchantInfo['merchant_frontendURL'],$merchantInfo['merchant_backendURL']);

        $payload = json_encode([
            'merchantID' => $paymentInfo['merchant_id'],
            'invoiceNo' => $paymentInfo['link_invoiceNo'],
            'amount' => $paymentInfo['link_amount'],
            'currencyCode' => $paymentInfo['link_currency'],
            'frontendUrl' => $merchantInfo['merchant_frontendURL'],
            'backendUrl' => $merchantInfo['merchant_backendURL'],
            'userDefination1' => $paymentInfo['link_description'],
        ]);

        $jwt = $this->jwt($header, $payload, $secret_key);
        //dd($jwt);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://test.octoverse.com.mm/api/payment/auth/token', [
            'payData' => $jwt,
        ]);

        if ($response->failed()) {
            return [
                'status' => 'error',
                'message' => 'Failed ',
            ];
        }

        $token = $response['data'];
        $decode = $this->get($token, $secret_key);

        if ($decode) {
            $this->getList($decode);
        }
        //dd($data);
        return $data;
    }

    public function get($token, $secret_key)
    {
        // dd($token,$secret_key);
        return JWT::decode($token, new Key($secret_key, 'HS256'));
    }

    public function getList($decoded)
    {
        //dd($decoded->paymentToken , $decoded->accessToken);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $decoded->accessToken,

        ])->post('https://test.octoverse.com.mm/api/payment/getAvailablePaymentsList', [
            'paymentToken' => $decoded->paymentToken,
        ]);
        $data = $response['data'];
          dd($data);
        return $data;
    }


    private function jwt($header, $payload, $secret)
    {
        $base64UrlHeader = rtrim(strtr(base64_encode($header), '+/', '-_'), '=');
        $base64UrlPayload = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }
}
