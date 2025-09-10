<?php

namespace App\Dao;

use App\Models\Links;
use App\Models\Merchants;
use App\Models\Tnx;
use Carbon\Carbon;

class PaymentDao
{
    public function getLinkById($id)
    {
        return Links::where('id', $id)->first();
    }

    public function getMerchantByMerchantId($merchantId)
    {
        return Merchants::where('merchant_id', $merchantId)->first();
    }

    public function store(array $data)
    {
        $expired = Links::where('id', $data['link_id'])->select('link_currency', 'link_phone', 'link_invoiceNo', 'link_amount', 'merchant_id', 'link_name', 'link_expired_at')->first();

        if (isset($data['cardNumber'])) {
            $tnx = Tnx::create([
                'payment_user_name'   => $expired['link_name'],
                'link_id'             => $data['link_id'],
                'currencyCode'        => $expired['link_currency'],
                'paymentCode'         => $data['paymentCode'],
                'payment_logo'        => $data['payment_logo'],
                'tnx_phonenumber'     => $data['tnx_phonenumber'] ?? $expired['link_phone'],
                'cardNumber'          => $data['cardNumber'],
                'expiryMonth'         => $data['expiryMonth'] ?? null,
                'expiryYear'          => $data['expiryYear'] ?? null,
                'payment_status'      => 'PENDING',
                'tranref_no'          => $expired['link_invoiceNo'],
                'req_amount'          => $expired['link_amount'],
                'payment_expired_at'  => $expired['link_expired_at'],
                'created_by'          => $expired['merchant_id'],
                'created_at'          => Carbon::now(),
            ]);
        } else {
            $tnx = Tnx::create([
                'payment_user_name'   => $expired['link_name'],
                'link_id'             => $data['link_id'],
                'currencyCode'        => $expired['link_currency'],
                'paymentCode'         => $data['paymentCode'],
                'payment_logo'        => $data['payment_logo'],
                'tnx_phonenumber'     => $data['tnx_phonenumber'] ?? null,
                'payment_status'      => 'PENDING',
                'tranref_no'          => $expired['link_invoiceNo'],
                'req_amount'          => $expired['link_amount'],
                'payment_expired_at'  => $expired['link_expired_at'],
                'created_by'          => $expired['merchant_id'],
                'created_at'          => Carbon::now(),
            ]);
        }

        return $tnx;
    }
}
