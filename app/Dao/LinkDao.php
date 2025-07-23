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
        //use random merchant id
        $originalCode = $merchants->merchant_id;
        $merchantCode = $this->transformMerchantCode($originalCode);
        //auto increment id
        $latest = Links::latest('id')->first();
        $increment = $latest ? $latest->id + 1 : 1;
        //random part for token
        $randomPart = Str::random(40);

        $token = $randomPart . $increment . $merchantCode;
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

    public function transformMerchantCode(string $originalCode): string
    {
        // Extract numeric part from original code
        preg_match('/\d+/', $originalCode, $matches);
        $numberPart = $matches[0] ?? '0000000000';

        // Take last 6 digits, pad with zeros if shorter
        $extracted = substr($numberPart, -6);
        $leftPad = str_pad($extracted, 6, '0', STR_PAD_LEFT);

        // Generate 4-digit random number padded with zeros
        $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Take first 5 letters from original code
        $prefixLetters = strtoupper(substr($originalCode, 0, 5));

        // Shuffle letters using PHP's str_shuffle
        $shuffled = str_shuffle($prefixLetters);

        // Combine all parts
        $newMerchantCode = $leftPad . $randomDigits . $shuffled;

        return $newMerchantCode;
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
            ->select('merchant_name', 'merchant_Cemail', 'merchant_notifyemail', 'merchant_frontendURL', 'merchant_logo', 'merchant_id', 'merchant_address')
            ->first();

        return [$details, $link];
    }
}
