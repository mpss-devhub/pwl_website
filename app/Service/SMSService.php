<?php

namespace App\Service;

use App\Mail\CheckoutMail;
use App\Models\sms;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;


class SMSService
{

    public function sendSMS(string $phoneNumber, string $message, string $id): bool
    {
        $data = sms::where('merchant_id', $id)->select('sms_token','sms_url','sms_from')->first();
        //dd($data);
        $token = $data['sms_token'];
        $url = $data['sms_url'];
        $from = $data['sms_from'];
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post( $url, [
                'to' => $phoneNumber,
                'message' => $message,
                "from" => $from,
                "clientReference" => "abcde12345",
            ]);
            return $response->successful();
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            dd($e->getMessage());
            return false;
        }
    }

    public function sendEmail(string $email, string $subject, string $message): bool
    {
        //dd($email, $subject, $message);
        try {
            $details = [
                'subject' => $subject,
                'body' => $message,
            ];
            Mail::to($email)->send(new CheckoutMail($details));
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
}
