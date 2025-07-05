<?php

namespace App\Imports;

use App\Models\Links;
use App\Models\Merchants;
use App\Service\SMSService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToCollection;

class LinksImport implements ToCollection
{
    protected $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }

    public function collection(Collection $rows)
    {
        // Skip heading row if needed
        foreach ($rows->skip(1) as $row) {
            $data = [
                'user_id' => $row[0],
                'invoiceNo' => $row[1],
                'amount' => $row[2],
                'name' => $row[3],
                'phone' => $row[4],
                'email' => $row[5],
                'expired_at' => $row[6],
                'description' => $row[7],
                'notification' => $row[8],
                'currency' => $row[9],
            ];

            // Create the link
            $linkUrl = app('App\Dao\LinkDao')->create($data); // assuming you have a DAO

            $Sendername = Merchants::where('user_id', $data['user_id'])->select('merchant_Cemail', 'merchant_address', 'merchant_name', 'merchant_id')->first();
            $id = $Sendername['merchant_id'];

            if ($data['notification'] == 'SMS') {
                $message = "\n Invoice Number: " . $data['invoiceNo'] .
                    "\n Amount: " . $data['amount'] . $data['currency'] .
                    "\n From: " . $Sendername['merchant_name'] .
                    "\n This is Your Payment Link : " . $linkUrl;

                $this->SMSService->sendSMS($data['phone'], $message, $id);
            }

            if ($data['notification'] == 'Email') {
                $message = [
                    $data['invoiceNo'],
                    $data['amount'],
                    $data['currency'],
                    $Sendername['merchant_name'],
                    $linkUrl,
                ];

                $details = [
                    'subject' => 'Octoverse Payment Link',
                    'merchant_name' => $Sendername['merchant_name'],
                    'merchant_Cemail' => $Sendername['merchant_Cemail'],
                    'merchant_address' => $Sendername['merchant_address'],
                    'expired_at' => $data['expired_at'],
                    'remark' => $data['description'] ?? 'N/A',
                ];

                $this->SMSService->sendEmail($data['email'], 'Octoverse Payment Link', $message, $details);
            }
        }
    }
}

