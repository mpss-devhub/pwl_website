<?php

namespace App\Dao;

use App\Models\User;
use App\Models\Merchants;
use Illuminate\Support\Facades\Hash;

class UserDao
{
    public function create(array $data): User
    {

        $user = User::create([
            'name' => $data['name'],
            'user_id' => $data['user_id'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'],
            'permission_id' => $data['permission_id'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
        return $user;
    }

    public function updateOrCreate(array $data, $id): User
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'] ?? $user->status,
            'permission_id' => $data['permission_id'] ?? $user->permission_id,
            'role' => $data['role'],
        ]);

        return $user;
    }


    public function delete($id): bool
    {
        $user = User::find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }


    public function createMerchant(array $data): Merchants
    {
        // dd($data);
        $backendURL = rtrim(config('app.url'), '/') . '/api/merchant/payment/backendcallback/' . $data['user_id'];
        $merchantNameClean = preg_replace('/[^A-Za-z0-9_\-]/', '_', $data['merchant_name']);
        $merchantRegistrationPath = null;
        if (!empty($data['merchant_registration'])) {
            $merchantRegistrationName = $merchantNameClean . '_' . $data['merchant_registration']->getClientOriginalName();
            $merchantRegistrationPath = $data['merchant_registration']->storeAs('merchants', $merchantRegistrationName);
        }

        $merchantDicaPath = null;
        if (!empty($data['merchant_dica'])) {
            $merchantDicaName = $merchantNameClean . '_' . $data['merchant_dica']->getClientOriginalName();
            $merchantDicaPath = $data['merchant_dica']->storeAs('merchants', $merchantDicaName);
        }

        $merchantShareholderPath = null;
        if (!empty($data['merchant_shareholder'])) {
            $merchantShareholderName = $merchantNameClean . '_' . $data['merchant_shareholder']->getClientOriginalName();
            $merchantShareholderPath = $data['merchant_shareholder']->storeAs('merchants', $merchantShareholderName);
        }

        $merchant = Merchants::create([
            'status' => $data['status'],
            'user_id' => $data['user_id'],
            'merchant_name' => $data['merchant_name'],
            'merchant_Cname' => $data['merchant_Cname'],
            'merchant_Cphone' => $data['merchant_Cphone'],
            'merchant_Cemail' => $data['merchant_Cemail'],
            'merchant_frontendURL' => $data['merchant_frontendURL'],
            'merchant_backendURL' =>  $backendURL,
            'merchant_address' => $data['merchant_address'],
            'merchant_notifyemail' => $data['merchant_notifyemail'],
            'merchant_remark' => $data['merchant_remark'],
            'merchant_registration' => $merchantRegistrationPath,
            'merchant_dica' => $merchantDicaPath,
            'merchant_shareholder' => $merchantShareholderPath,

        ]);
        //dd('Success');
        return $merchant;
    }

    public function merchantacc(array $data): User
    {
        $merchantacc = User::create([
            'name' => $data['merchant_name'],
            'user_id' => $data['user_id'],
            'email' => $data['merchant_Cemail'],
            'phone' => $data['merchant_Cphone'],
            'status' => $data['status'],
            'permission_id' => null,
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
        return $merchantacc;
    }

    public function updateMerchant(array $data, $merchantId): array
    {
        $merchant = Merchants::where('merchant_id', $merchantId)->first();
        //dd($merchant);
        $merchantNameClean = preg_replace('/[^A-Za-z0-9_\-]/', '_', $data['merchant_name']);
        $merchantRegistrationPath = null;
        if (!empty($data['merchant_registration'])) {
            $merchantRegistrationName = $merchantNameClean . '_' . $data['merchant_registration']->getClientOriginalName();
            $merchantRegistrationPath = $data['merchant_registration']->storeAs('merchants', $merchantRegistrationName);
        }

        $merchantDicaPath = null;
        if (!empty($data['merchant_dica'])) {
            $merchantDicaName = $merchantNameClean . '_' . $data['merchant_dica']->getClientOriginalName();
            $merchantDicaPath = $data['merchant_dica']->storeAs('merchants', $merchantDicaName);
        }

        $merchantShareholderPath = null;
        if (!empty($data['merchant_shareholder'])) {
            $merchantShareholderName = $merchantNameClean . '_' . $data['merchant_shareholder']->getClientOriginalName();
            $merchantShareholderPath = $data['merchant_shareholder']->storeAs('merchants', $merchantShareholderName);
        }

        if (!$merchant) {
            throw new \Exception("Merchant not found with ID: $merchantId");
        }

        $merchant->update([
            'merchant_Cname' => $data['merchant_Cname'],
            'merchant_Cphone' => $data['merchant_Cphone'],
            'merchant_Cemail' => $data['merchant_Cemail'],
            'merchant_frontendURL' => $data['merchant_frontendURL'],
            'merchant_name' => $data['merchant_name'],
            'merchant_backendURL' => $data['merchant_backendURL'] ?? '',
            'merchant_address' => $data['merchant_address'],
            'merchant_notifyemail' => $data['merchant_notifyemail'],
            'merchant_remark' => $data['merchant_remark'],
            'status' => $data['status'],
            'user_id' => $data['user_id'],
            'merchant_registration' => $merchantRegistrationPath,
            'merchant_dica' => $merchantDicaPath,
            'merchant_shareholder' => $merchantShareholderPath,
        ]);

        User::where('user_id', $data['user_id'])
            ->update([
                'name' => $data['merchant_name'],
                'email' => $data['merchant_Cemail'],
                'phone' => $data['merchant_Cphone'],
                'status' => $data['status'],
            ]);

        return $merchant->toArray();
    }
}
