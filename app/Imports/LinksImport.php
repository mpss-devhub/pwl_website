<?php

namespace App\Imports;

use App\Models\Merchants;
use App\Service\SMSService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithValidation;

class LinksImport implements ToModel, WithValidation, WithStartRow
{

    protected $SMSService;

    protected int $successCount = 0;

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        if (DB::table('links')->where('link_invoiceNo', $row[1])->exists()) {
            throw ValidationException::withMessages([
                "Row with invoice number '{$row[1]}' already exists in the database."
            ]);
        }
        $data = [
            'user_id'     => $row[0],
            'invoiceNo'   => $row[1],
            'amount'      => $row[2],
            'name'        => $row[3],
            'phone'       => $row[4],
            'email'       => $row[5],
            'expired_at'  => $row[6],
            'description' => $row[7],
            'notification' => $row[8],
            'currency'    => $row[9],
        ];

        $linkUrl = app('App\Dao\LinkDao')->create($data);
        if (!$linkUrl) {
            throw new \Exception("Link not created for invoice: {$data['invoiceNo']}");
        }

        $merchant = Merchants::where('user_id', $data['user_id'])->first();
        if (!$merchant) {
            throw new \Exception("Merchant not found for user: {$data['user_id']}");
        }

        $merchantId = $merchant->merchant_id;

        if ($data['notification'] === 'SMS') {
            $message = "\n Invoice Number: {$data['invoiceNo']}" .
                "\n Amount: {$data['amount']} {$data['currency']}" .
                "\n From: {$merchant->merchant_name}" .
                "\n This is Your Payment Link : {$linkUrl}";

            $this->SMSService->sendSMS($data['phone'], $message, $merchantId);
        }

        if ($data['notification'] === 'Email') {
            $this->SMSService->sendEmail(
                $data['email'],
                'Octoverse Payment Link',
                [
                    $data['invoiceNo'],
                    $data['amount'],
                    $data['currency'],
                    $merchant->merchant_name,
                    $linkUrl,
                ],
                [
                    'subject'           => 'Octoverse Payment Link',
                    'merchant_name'     => $merchant->merchant_name,
                    'merchant_Cemail'   => $merchant->merchant_Cemail,
                    'merchant_address'  => $merchant->merchant_address,
                    'expired_at'        => $data['expired_at'],
                    'remark'            => $data['description'] ?? 'N/A',
                ]
            );
        }
        $this->successCount++;
        return null;
    }

    public function rules(): array
    {
        return [
            '*.1' => [
                'required',
                'string',
                'max:40',
                Rule::unique('links', 'link_invoiceNo'),
            ],
            '*.2' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999',
            ],
            '*.4' => [
                'required',
                'digits_between:4,12',
            ],
            '*.5' => [
                'nullable',
                'email',
                'max:30',
            ],
            '*.6' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            '*.7' => [
                'nullable',
                'string',
                'max:30',
            ],
            '*.8' => [
                'required',
                'string',
                'max:10',
            ],
            '*.9' => [
                'required',
                Rule::in(['MMK', 'USD']),
            ],
        ];
    }
}
