<?php

namespace App\Dao;

use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Support\Str;


class LinkDao
{
    public function create(array $data) {

        $merchants = Merchants::where("user_id", $data["user_id"])->first();

        $token = Str::random(40);

         $linkUrl = url('/pay/' . $token);
        //dd($linkUrl);
       // dd($data['expired_at']);
        $link = Links::create([
            "user_id"=> $data["user_id"],
            "merchant_id"=> $merchants->merchant_id,
            "link_invoiceNo"=> $data["invoiceNo"],
            "link_amount"=> $data["amount"],
            "link_name"=> $data["name"],
            "link_phone"=> $data["phone"],
            "link_currency"=> $data["currency"],
            "link_email"=> $data["email"],
            "link_description"=> $data["description"],
            "link_type"=> $data["notification"],
            'link_url' => $linkUrl,
            'link_expired_at'=>$data["expired_at"]
        ]);

        return $linkUrl;
    }

    public function getByToken($token) {

        $url = url("/pay/". $token);
        $merchant_id = Links::where("link_url", $url)->select('merchant_id')->first();
        $link = Links::where("link_url", $url)->get();
        $details = Merchants::where("merchant_id", $merchant_id['merchant_id'])->get();

        //dd($link,$details);
        return [$details , $link ];
    }
}
