<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tnx;
use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Exports\AllSettlementExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class SettlementController extends Controller
{
    //


    public function show(Request $request)
    {


        $data = $this->getSettlementData();
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
        //dd()
        if ($request->filled('start_date')) {
            $start = Carbon::parse($request->start_date);
            $tnxs = $tnxs->filter(function ($item) use ($start) {
                return Carbon::parse($item['transactionStart']) >= $start;
            });
        }

        if ($request->filled('end_date')) {
            $end = Carbon::parse($request->end_date);
            $tnxs = $tnxs->filter(function ($item) use ($end) {
                return Carbon::parse($item['transactionEnd']) <= $end;
            });
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



        return view('Admin.Settlement.index', [
            'tnx' => $paginated,
            'paymentCodes' => $paymentCodes
        ]);
    }



    private function getSettlementData()
    {
        $app_id = config('services.b2b.x_app_id');
        $xAppApiKey = config('services.b2b.x_app_api_key');
        $externalUrl = config('services.b2b.external_url_2');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-API-KEY' => $xAppApiKey,
            'X-APP-ID' => $app_id,
        ])->post($externalUrl, [
            "pageNo" => "",
            "pageSize" => "",
            "orderBy" => "DESC",
            "searchObj" => [
                "merchantID" => "",
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

    public function details($merchant, $id)
    {
        $settlement = $this->getSettlementDetails($merchant, $id);
        $details = $settlement['data']['dataList'][0];
        $merchant = Merchants::where('merchant_id', $merchant)->first();
        //dd($details, $merchant->merchant_logo);
        $data = Tnx::where('tranref_no', $details['merchantInvoiceNo'])->first();
        if (!$data) {
            abort(404, 'Transaction not found');
        }
        return view('Admin.Settlement.details', compact('data', 'details', 'merchant'));
    }

    public function export(Request $request)
    {
        $data = $this->getSettlementData();

        $tnxs = collect($data['data']['dataList'] ?? []);

        // Apply same filters as your table
        if ($request->filled('start_date')) {
            $start = Carbon::parse($request->start_date);
            $tnxs = $tnxs->filter(fn($item) => Carbon::parse($item['transactionStart']) >= $start);
        }

        if ($request->filled('end_date')) {
            $end = Carbon::parse($request->end_date);
            $tnxs = $tnxs->filter(fn($item) => Carbon::parse($item['transactionEnd']) <= $end);
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

        return Excel::download(
            new AllSettlementExport($tnxs->values()->toArray()),
            'settlement_data_' . now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }

    public function exportCsv(Request $request)
    {
        $data = $this->getSettlementData();

        $tnxs = collect($data['data']['dataList'] ?? []);

        // Apply same filters (copy from above)
        if ($request->filled('start_date')) {
            $start = Carbon::parse($request->start_date);
            $tnxs = $tnxs->filter(fn($item) => Carbon::parse($item['transactionStart']) >= $start);
        }

        if ($request->filled('end_date')) {
            $end = Carbon::parse($request->end_date);
            $tnxs = $tnxs->filter(fn($item) => Carbon::parse($item['transactionEnd']) <= $end);
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

        return Excel::download(
            new AllSettlementExport($tnxs->values()->toArray()),
            'settlement_data_' . now()->format('Y-m-d_H-i-s') . '.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
