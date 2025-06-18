<?php

namespace App\Service;

use App\Dao\UserDao;
use App\Models\User;
use App\Models\Merchants;
use Illuminate\Support\Facades\Http;

class UserService
{

    protected UserDao $user_dao;

    public function __construct(UserDao $user_dao)
    {
        $this->user_dao =  $user_dao;
    }

    public function create(array $data): User
    {
        return $this->user_dao->create($data);
    }

    public function updateOrCreate(array $data, $id): User
    {
        //dd($data,$id);
        return $this->user_dao->updateOrCreate($data, $id);
    }

    public function delete($id): bool
    {
        return $this->user_dao->delete($id);
    }

    public function createMerchant(array $data): Merchants
    {
        return $this->user_dao->createMerchant($data);
    }

    public function merchantacc(array $data): User
    {
        return $this->user_dao->merchantacc($data);
    }

    public function RegisterMerchant(array $data): array
    {
        $secret_key = '9IC3Bve4533uFMuBrsXd7bYndV0bNrH9m13V7Jfq14s';
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
         $backendURL = 'http://127.0.0.1:8000/api/merchant/backendcallback/'.$data['user_id'];
        $payload = json_encode([
            'appId' => '000021',
            'merchantExternalId' => $data['user_id'],
            'merchantName' => $data['merchant_name'],
            'merchantIntegrationType' => '1',
            'contactName' => $data['merchant_Cname'],
            'contactTel' => $data['merchant_Cphone'],
            'contactEmail' => $data['merchant_Cemail'],
            'notifyEmail' => $data['merchant_notifyemail'],
            'frontendUrl' => $data['merchant_frontendURL'],
            'backendUrl' =>   $backendURL,
            'remark' => $data['merchant_remark'],
        ]);

        $jwt = $this->jwt($header, $payload, $secret_key);

        $logoFileValue = isset($data['merchant_logo']) ? base64_encode(file_get_contents($data['merchant_logo'])) : '';
        $logoFileType = isset($data['merchant_logo']) ? $data['merchant_logo']->getClientMimeType() : '';

        $registrationFileValue = isset($data['merchant_registration']) ? base64_encode(file_get_contents($data['merchant_registration'])) : '';
        $registrationFileType = isset($data['merchant_registration']) ? $data['merchant_registration']->getClientMimeType() : '';
        $registrationFileName = isset($data['merchant_registration']) ? $data['merchant_registration']->getClientOriginalName() : '';

        $dicaFileValue = isset($data['merchant_dica']) ? base64_encode(file_get_contents($data['merchant_dica'])) : '';
        $dicaFileType = isset($data['merchant_dica']) ? $data['merchant_dica']->getClientMimeType() : '';
        $dicaFileName = isset($data['merchant_dica']) ? $data['merchant_dica']->getClientOriginalName() : '';

        $shareholderFileValue = isset($data['merchant_shareholder']) ? base64_encode(file_get_contents($data['merchant_shareholder'])) : '';
        $shareholderFileType = isset($data['merchant_shareholder']) ? $data['merchant_shareholder']->getClientMimeType() : '';
        $shareholderFileName = isset($data['merchant_shareholder']) ? $data['merchant_shareholder']->getClientOriginalName() : '';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://test.octoverse.com.mm/api/b2b/registerMerchant', [
            'registerData' => $jwt,
            'logoFileValue' => $logoFileValue,
            'logoFileType' => $logoFileType,
            'registrationFileName' => $registrationFileName,
            'registrationFileValue' => $registrationFileValue,
            'registerFileType' => $registrationFileType,
            'dicaFileName' => $dicaFileName,
            'dicaFileType' => $dicaFileType,
            'dicaFileValue' => $dicaFileValue,
            'shareholderFileName' => $shareholderFileName,
            'shareholderFileValue' => $shareholderFileValue,
            'shareholderFileType' => $shareholderFileType,
        ]);
        if ($response->failed()) {
            return [
                'status' => 'error',
                'message' => 'Failed to register merchant',
            ];
        }
        return $response->json();
    }

    private function jwt($header, $payload, $secret)
    {
        $base64UrlHeader = rtrim(strtr(base64_encode($header), '+/', '-_'), '=');
        $base64UrlPayload = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    public function updateMerchant(array $data): array
    {
         $secret_key = '9IC3Bve4533uFMuBrsXd7bYndV0bNrH9m13V7Jfq14s';
       // $m_id = Merchants::where('user_id', $data['user_id'])->get('merchant_id');
        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode([
            'appId' => '000021',
            'merchantExternalId' => $data['user_id'],
            "merchantID"=> $data['merchant_id'],
            'merchantName' => $data['merchant_name'],
            'merchantIntegrationType' => '1',
            'contactName' => $data['merchant_Cname'],
            'contactTel' => $data['merchant_Cphone'],
            'contactEmail' => $data['merchant_Cemail'],
            'notifyEmail' => $data['merchant_notifyemail'],
            'frontendUrl' => $data['merchant_frontendURL'],
            'backendUrl' => $data['merchant_backendURL'],
            'remark' => $data['merchant_remark'],
        ]);
         $jwt = $this->jwt($header, $payload, $secret_key);
        $logoFileValue = isset($data['merchant_logo']) ? base64_encode(file_get_contents($data['merchant_logo'])) : '';
        $logoFileType = isset($data['merchant_logo']) ? $data['merchant_logo']->getClientMimeType() : '';

        $registrationFileValue = isset($data['merchant_registration']) ? base64_encode(file_get_contents($data['merchant_registration'])) : '';
        $registrationFileType = isset($data['merchant_registration']) ? $data['merchant_registration']->getClientMimeType() : '';
        $registrationFileName = isset($data['merchant_registration']) ? $data['merchant_registration']->getClientOriginalName() : '';

        $dicaFileValue = isset($data['merchant_dica']) ? base64_encode(file_get_contents($data['merchant_dica'])) : '';
        $dicaFileType = isset($data['merchant_dica']) ? $data['merchant_dica']->getClientMimeType() : '';
        $dicaFileName = isset($data['merchant_dica']) ? $data['merchant_dica']->getClientOriginalName() : '';

        $shareholderFileValue = isset($data['merchant_shareholder']) ? base64_encode(file_get_contents($data['merchant_shareholder'])) : '';
        $shareholderFileType = isset($data['merchant_shareholder']) ? $data['merchant_shareholder']->getClientMimeType() : '';
        $shareholderFileName = isset($data['merchant_shareholder']) ? $data['merchant_shareholder']->getClientOriginalName() : '';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->put('https://test.octoverse.com.mm/api/b2b/updateMerchant',[
            'updateData' => $jwt,
            'logoFileValue' => $logoFileValue,
            'logoFileType' => $logoFileType,
            'registrationFileName' => $registrationFileName,
            'registrationFileValue' => $registrationFileValue,
            'registerFileType' => $registrationFileType,
            'dicaFileName' => $dicaFileName,
            'dicaFileType' => $dicaFileType,
            'dicaFileValue' => $dicaFileValue,
            'shareholderFileName' => $shareholderFileName,
            'shareholderFileValue' => $shareholderFileValue,
            'shareholderFileType' => $shareholderFileType,
        ]);
        if ($response->failed()) {
            return [
                'status' => 'error',
                'message' => 'Failed to update merchant',
                'data' => $response->json(),
            ];
        }

        return $this->user_dao->updateMerchant($data);
    }


}
