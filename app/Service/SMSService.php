<?php

namespace App\Service;

use App\Mail\CheckoutMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;


class SMSService
{

    public function sendSMS(string $phoneNumber, string $message): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . 'eQWZQ_u2wbz6hSs-NpNKE3ysBIFvotCe_ABuLb3dNTl-IlKpIwzGiN36Id7aV4uw',
            ])->post('https://smspoh.com/api/v2/send', [
                'to' => $phoneNumber,
                'message' => $message,
                "from" => "SMSPoh",
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
