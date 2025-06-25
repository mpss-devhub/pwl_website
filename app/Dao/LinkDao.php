<?php

namespace App\Dao;

use App\Models\Links;
use App\Models\Merchants;
use Carbon\Carbon;
use Illuminate\Support\Str;


class LinkDao
{
    public function create(array $data)
    {
        $merchants = Merchants::where("user_id", $data["user_id"])->first();
        $token = Str::random(40);
        $noti = $data['notification'][0];
        $linkUrl = url('/pay/' . $token);
        $link = Links::create([
            "user_id" => $data["user_id"],
            "merchant_id" => $merchants->merchant_id,
            "link_invoiceNo" => $data["invoiceNo"],
            "link_amount" => $data["amount"],
            "link_name" => $data["name"],
            "link_phone" => $data["phone"],
            "link_currency" => $data["currency"],
            "link_email" => $data["email"],
            "link_description" => $data["description"],
            "link_type" =>  $noti,
            'link_url' => $linkUrl,
            "created_by" => $merchants->merchant_id,
            "created_at" => Carbon::now(),
            'link_expired_at' => Carbon::parse($data["expired_at"])
        ]);
        return  $linkUrl;
    }

    public function getByToken($token)
    {
        $url = url("/pay/" . $token);
        $link = Links::where("link_url", $url)->get();
        //dd($link[0]['link_expired_at']);
        if (!$link) {
            return null;
        }

        if ($link[0]['link_expired_at'] && now()->greaterThan($link[0]['link_expired_at'])) {

            return null;
        }

        $details = Merchants::where('merchant_id', $link[0]['merchant_id'])
                ->select('merchant_name','merchant_Cemail','merchant_notifyemail','merchant_frontendURL','merchant_logo','merchant_id','merchant_address')
                ->first();

        return [$details, $link];
    }
}
