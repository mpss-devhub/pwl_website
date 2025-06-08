<?php

namespace App\Http\Controllers;

use App\Dao\LinkDao;
use App\Http\Requests\Merchant\LinkRequest;
use App\Models\Links;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    //
    protected LinkDao $linkDao;
    public function __construct(LinkDao $linkDao)
    {
        $this->linkDao = $linkDao;
    }

    public function store(LinkRequest $request)
    {
        //dd($request->all());
        $this->linkDao->create($request->validated());
        $linkUrl = Links::where("link_invoiceNo", $request->invoiceNo)->select('link_url')->first();
        //dd($linkUrl['link_url']);
        return back()
            ->with('success', 'This is your link:')
            ->with('link_url', $linkUrl['link_url']);
    }


    public function show($token)
    {
        $data = $this->linkDao->getByToken($token);
        $details = $data[0][0]->toArray();
        $links = $data[1][0]->toArray();
        //dd($links['link_name']);

        return view('checkout.checkout', compact('details', 'links'));
    }
}
