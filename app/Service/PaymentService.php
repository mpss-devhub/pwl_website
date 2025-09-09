<?php

namespace App\Service;

use App\Models\Links;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Dao\PaymentDao;
use App\Models\Merchants;
use App\Models\Tnx;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaymentService
{

    protected PaymentDao $paymentDao;


    public function __construct(PaymentDao $paymentDao)
    {
        $this->paymentDao = $paymentDao;
    }


    public function show(array $data)
    {

        $merchant_id = Links::where('id', $data['link_id'])->select('merchant_id')->first();
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl = config('services.b2b.external_url');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' =>  $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl, [
            "pageNo" => "1",
            "pageSize" => "10",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => $merchant_id['merchant_id'],
                "merchantName" => "",
                "merchantIntegrationType" => "",
                "status" => ""
            ]

        ]);
        if ($response->failed()) {
            abort(404, 'Page Expired');
        }
        $data = $response['data']['dataList'][0]['paymentMdrInfoList'];
        return $data;
    }

    public function link(array $data)
    {
        $link = $this->paymentDao->getLinkById($data['link_id']);
        $merchant = $this->paymentDao->getMerchantByMerchantId($link->merchant_id);
        return [
            'link' => $link,
            'merchant' => $merchant,
        ];
    }

    public function Auth(array $data)
    {
        $paymentCode = $data['paymentCode'] ?? '';
        $links = Links::where('id', $data['link_id'])->get()->toArray();
        $paymentInfo = $links[0];

        $merchants = Merchants::where('merchant_id', $paymentInfo['merchant_id'])->get()->toArray();
        $merchantInfo = $merchants[0];

        $secret_key = $merchantInfo['merchant_secretkey'];
        $data_Key   = $merchantInfo['merchant_datakey'];

        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);

        // build array first
        $payloadData = [
            'merchantID'   => $paymentInfo['merchant_id'],
            'invoiceNo'    => $paymentInfo['link_invoiceNo'],
            'amount'       => $paymentInfo['link_amount'],
            'currencyCode' => $paymentInfo['link_currency'],
            'frontendUrl'  => $merchantInfo['merchant_frontendURL'],
            'backendUrl'   => $merchantInfo['merchant_backendURL'],
        ];

        if (!empty($paymentInfo['link_description'])) {
            $payloadData['userDefination1'] = trim($paymentInfo['link_description']);
        }

        $payload = json_encode($payloadData);
        $authTokenUrl = config('services.payment_gateway.auth_token_url');
        $jwt = $this->jwt($header, $payload, $secret_key);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($authTokenUrl, [
            'payData' => $jwt,
        ]);


        //Redirect as payment Failed when its reload the page
        if ($response['data'] === null) {

            $link = Links::where('id', $links[0]['id'])->firstOrFail();
            $tnx = Tnx::where('link_id', $links[0]['id'])->latest()->firstOrFail();
            $merchant = Merchants::where('user_id', $links[0]['user_id'])->firstOrFail();
            $tnx->update(['payment_status' => 'FAIL']);
            $link->update(['link_status' => 'expired']);
            abort(404, 'This link has expired.');
        }

        $token = $response['data'];
        $decode = $this->get($token, $secret_key);
        if ($decode) {
            $data = $this->dopay($decode, $paymentCode, $data_Key, $data);
        }
        return $data;
    }

    public function store(array $data)
    {
        $tnx_data = $this->paymentDao->store($data);
    }

    public function get($token, $secret_key,)
    {
        return JWT::decode($token, new Key($secret_key, 'HS256'));
    }

    private function jwt($header, $payload, $secret)
    {
        $base64UrlHeader = rtrim(strtr(base64_encode($header), '+/', '-_'), '=');
        $base64UrlPayload = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }


    private function dopay($decode, $paymentCode, $data_Key, $data)
    {
        $dopayUrl = config('services.payment_gateway.dopay_url');
        $paydata = $this->AES($data_Key, $data);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $decode->accessToken,
        ])->post($dopayUrl, [
            "paymentCode" => $paymentCode,
            'paymentToken' => $decode->paymentToken,
            "payData" => $paydata
        ]);
        $data = $response['data'];
        return $data;
    }

    private function AES($data_Key, $data)
    {
        $type = $data['type'];
        $payload = [];
        if ($type === 'Ewallet' || $type === 'QR' || $type === 'Web') {
            $payload['phoneNo'] = $data['tnx_phonenumber'];
        }
        if ($type === 'L_C') {
            $payload['phoneNo'] = $data['tnx_phonenumber'];
            $payload['cardNumber'] = $data['cardNumber'];
            $payload['expiryMonth'] = $data['expiryMonth'];
            $payload['expiryYear'] = $data['expiryYear'];
        }
        if ($type === 'G_C') {
            $payload['cardNumber'] = $data['cardNumber'];
            $payload['expiryMonth'] = $data['expiryMonth'];
            $payload['expiryYear'] = $data['expiryYear'];
            $payload['cvv'] = $data['securityCode'];
        }
        $plaintext = json_encode($payload, JSON_UNESCAPED_UNICODE);
        $encrypted = openssl_encrypt($plaintext, 'AES-128-ECB', $data_Key, OPENSSL_RAW_DATA);
        return base64_encode($encrypted);
    }


    public function backendCallback(array $data, $user_id)
    {
        $merchant_id = Merchants::where('user_id', $user_id)->value('merchant_id');
        $data_key = Merchants::where('merchant_id', $merchant_id)->value('merchant_datakey');

        $paymentInfo = $data['data'];
        $decryptedData = openssl_decrypt(base64_decode($paymentInfo), 'AES-128-ECB', $data_key, OPENSSL_RAW_DATA);
        $data = json_decode($decryptedData, true);

        $ino = Links::where('link_invoiceNo', $data['invoiceNo'])->select('created_at', 'id')->get();

        Tnx::updateOrCreate(
            ['link_id' => $ino[0]['id']],
            [
                'payment_status' => $data['status'] ?? '',
                'trans_date_time' => $data['transDateTime'] ?? '',
                'payment_created_at' => $ino[0]['created_at'] ?? '',
                'tranref_no' => $data['invoiceNo'] ?? '',
                'tnx_tranref_no' => $data['tranrefNo'] ?? '',
                'bank_tranref_no' => $data['bankTranrefNo'] ?? '',
                'txn_amount' => $data['txnAmount'] ?? '',
                'req_amount' => $data['reqAmount'] ?? '',
                'net_amount' => $data['netAmount'] ?? '',
                'created_by' => $merchant_id,
                'updated_at' => now(),
                'updated_by' => "PaymentGateway",
            ]
        );

        return $data;
    }
}
