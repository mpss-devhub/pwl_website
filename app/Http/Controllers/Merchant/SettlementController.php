<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Tnx;
use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MerchantSettlementExport;

class SettlementController extends Controller
{
    //
    public function show(Request $request)
    {
        $merchant = Merchants::where('user_id', Auth::user()->user_id)
            ->select('merchant_id')
            ->first();

        if (!$merchant) {
            return redirect()->back()->with('error', 'Merchant not found.');
        }

        $data = $this->getSettlementData($merchant->merchant_id);
        //dd($data['data']['dataList'][0]['paymentCode']);



        if (empty($data)) {
            return redirect()->back()->with('error', 'No settlement data found.');
        }
        $paymentCodes = collect($data['data']['dataList'])
            ->pluck('paymentCode')
            ->filter(fn($code) => !empty($code))  // remove null/empty
            ->unique();


        $tnxs = collect($data['data']['dataList']);

        // Server-side filtering
        if ($request->filled('start_date')) {
            $tnxs = $tnxs->filter(fn($item) => $item['created_at'] >= $request->start_date);
        }
        if ($request->filled('end_date')) {
            $tnxs = $tnxs->filter(fn($item) => $item['created_at'] <= $request->end_date);
        }
        if ($request->filled('payment_method')) {
            $tnxs = $tnxs->filter(fn($item) => $item['paymentCode'] === $request->payment_method);
        }
        if ($request->filled('status')) {
            $tnxs = $tnxs->filter(fn($item) => $item['status'] === $request->status);
        }
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $tnxs = $tnxs->filter(
                fn($item, $key) =>
                str_contains(strtolower($item['merchantInvoiceNo'] ?? ''), $search) ||
                    str_contains(strtolower($item['customerName'] ?? ''), $search) ||
                    str_contains((string)($key + 1), $search)
            );
        }

        $page = $request->get('page', 1);
        $perPage = 10; //per-page limit
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $tnxs->forPage($page, $perPage),
            $tnxs->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );



        return view('Merchant.Settlement.index', [
            'tnx' => $paginated,
            'paymentCodes' => $paymentCodes
        ]);
    }


    private function getSettlementData($merchant)
    {
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl2 = config('services.b2b.external_url_2');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl2, [
            "pageNo" => "",
            "pageSize" => "",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "$merchant",
                "status" => "",
                "settlementStatus" => "",
                "invoiceNo" => "",
                "paymentCode" => "",
                "fromDate" => "",
                "toDate" => ""
            ]
        ]);
        $merchant = $response->json();
        return $merchant ?? [];
    }

    private function getSettlementDetails($merchant, $id)
    {
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl2 = config('services.b2b.external_url_2');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl2, [
            "pageNo" => "1",
            "pageSize" => "1",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "$merchant",
                "status" => "",
                "settlementStatus" => "",
                "invoiceNo" => "$id",
                "paymentCode" => "",
                "fromDate" => "",
                "toDate" => ""
            ]
        ]);
        $merchant = $response->json();
        return $merchant ?? [];
    }

    public function details($id)
    {
        $merchant = Merchants::where('user_id', Auth::user()->user_id)->select('merchant_id')->first();
        $settlement = $this->getSettlementDetails($merchant['merchant_id'], $id);
        $details = $settlement['data']['dataList'][0];
        $data = Tnx::where('tranref_no', $id)->first();
        return view('Merchant.Settlement.details', compact('data', 'details'));
    }

    public function export()
    {
        return Excel::download(new MerchantSettlementExport, 'Settlement_data_' . now()->format('Y-m-d_H-i-s') . '.csv');
    }

    public function csvExport()
    {
        return Excel::download(new MerchantSettlementExport, 'Settlement_data_' . now()->format('Y-m-d_H-i-s') . '.xlsx');
    }
}
