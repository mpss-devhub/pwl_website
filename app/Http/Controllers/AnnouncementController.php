<?php

namespace App\Http\Controllers;

use App\Models\Merchants;
use App\Models\announcement;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends Controller
{
    //

    public function store(AnnouncementRequest $request )
    {
        $data = $request->validated();
        $announcement = new announcement();
        $announcement->title = $data['title'];
        $announcement->letter = $data['letter'];
        $announcement->content = $data['content'];
        $announcement->merchant_id = json_encode($data['merchant_id']);
        $announcement->created_by = $data['created_by'] ?? auth()->user()->id;
        $announcement->save();
        return redirect()->route('support.list')->with('Success', 'Announcement created successfully.');
    }

    public function details($id)
    {
        $data = announcement::where('id', $id)->get();
       //dd($data[0]);
        return view('Admin.support.details', compact('data'));
    }

    public function delete($id)
    {
        $announcement = announcement::findOrFail($id);
        $announcement->delete();
        return redirect()->route('support.list')->with('Error', 'Announcement deleted successfully.');
    }

    public function edit($id)
    {
        $announcement = announcement::findOrFail($id);
        $merchants = Merchants::where('status', 'on')->get();
        return view('Admin.support.edit', compact('announcement','merchants'));
    }

    public function update(AnnouncementRequest $request, $id)
    {
        $data = $request->validated();
        //dd($data);
        $announcement = announcement::findOrFail($id);
        $announcement->title = $data['title'];
        $announcement->letter = $data['letter'];
        $announcement->content = $data['content'];
        $announcement->merchant_id = json_encode($data['merchant_id']);
        $announcement->updated_by = $data['created_by'] ?? auth()->user()->id;
        $announcement->save();
        return redirect()->route('support.list')->with('Success', 'Announcement Updated successfully.');
    }
}
