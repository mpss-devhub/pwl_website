<?php

namespace App\Http\Controllers;

use App\Models\Merchants;
use App\Models\Permissions;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MerchantRequest;


class UserController extends Controller
{
    //
    protected UserService $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }


    public function update(UserRequest $request, $id)
    {
         $per = Permissions::all();
        $this->user_service->updateOrCreate($request->validated(), $id);
        return redirect()->route('user.show')->with('success', 'User updated successfully!');
    }

    public function store(UserRequest $request)
    {
       // dd($request->validated());
        $this->user_service->create($request->validated());
        return redirect()->route('user.show')
            ->with('success', 'User created successfully!')
            ->with('user_id', $request->user_id)
            ->with('email', $request->email)
            ->with('password', $request->password);
    }

    public function delete($id)
    {
        $this->user_service->delete($id);
        return redirect()->route('user.show')
            ->with('Error', 'User Deleted Successfully!');
    }

    public function storeMerchant(MerchantRequest $request)
    {
        //dd($request->validated());
        $this->user_service->merchantacc($request->validated());
        $this->user_service->RegisterMerchant($request->validated());
        $this->user_service->createMerchant($request->validated());
        //dd($request->user_id,$request->merchant_Cemail,$request->password);
        return redirect()->route('merchant.show')
            ->with('success', 'Merchant created successfully!')
            ->with('user_id', $request->user_id)
            ->with('email', $request->merchant_Cemail)
            ->with('password', $request->password);
    }

    public function backendcallback(Request $request)
    {
        if ($request->has('data.merchantInfo')){
            $data_key = config('services.b2b.data_key');
            $merchantInfo = $request->input('data.merchantInfo');
            $encrypted = base64_decode($merchantInfo, true);
            if (!$encrypted) {
                return response()->json(['error' => 'Invalid base64'], 400);
            }
            $decrypted = openssl_decrypt($encrypted,'AES-128-ECB',$data_key,OPENSSL_RAW_DATA);
            if (!$decrypted) {
                return response()->json(['error' => 'Decryption failed'], 400);
            }
            $data = json_decode($decrypted, true);

            if (!$data) {
                return response()->json(['error' => 'Invalid JSON in decrypted string'], 400);
            }
           // $backendURL = 'http://127.0.0.1:8000/api/merchant/payment/backendcallback/'+ $data['merchantID'];
            Merchants::updateOrCreate(
                ['user_id' => $data['merchantExternalId'] ],
                [
                    'merchant_id' => $data['merchantID'] ?? '',
                    'merchant_Cemail' => $data['contactEmail'] ?? '',
                    'merchant_Cname' => $data['contactName'] ?? '',
                    'merchant_remark' => $data['remark'] ?? '',
                    'merchant_Cphone' => $data['contactTel'] ?? '',
                    'merchant_backendURL' => $data['backendUrl'] ?? '',
                    'merchant_frontendURL' => $data['frontendUrl'] ?? '',
                    'merchant_notifyemail' => $data['notifyEmail'] ?? '',
                    'merchant_name' => $data['merchantName'] ?? '',
                    'merchant_secretkey' => $data['secretKey'] ?? '',
                    'merchant_datakey' => $data['dataKey'] ?? '',
                    'merchant_logo' => $data["merchantLogo"] ?? '',
                    'merchant_registration' => $data['companyRegistrationFileUrl'] ?? '',
                    'merchant_shareholder' => $data['shareholderListFileUrl'] ?? '',
                    'merchant_dica' => $data['companyDICAFileUrl'] ?? ''

                ]
            );
            return response()->json(['status' => 'saved', 'data' => $data]);
        }

        return response()->json(['error' => 'Missing merchantInfo field'], 400);
    }
}
