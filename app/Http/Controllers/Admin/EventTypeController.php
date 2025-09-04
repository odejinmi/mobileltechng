<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    
     public function index()
    {
        $pageTitle = "Manage Event Type";
        $emptyMessage = "No data found";
        $event_type = EventType::latest()->paginate(getPaginate());
        return view('admin.event.type', compact('pageTitle', 'emptyMessage', 'event_type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
        ]);
        $eventtype = new EventType();
        $eventtype->name = $request->name;
        $eventtype->status = $request->status ? 1: 0;
        $eventtype->save();
        $notify[] = ['success', 'Event Type has been created'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
        ]);
        $eventtype = EventType::findOrFail($request->id);
        $eventtype->name = $request->name;
        $eventtype->status = $request->status ? 1: 0;
        $eventtype->save();
        $notify[] = ['success', 'Event Type has been updated'];
        return back()->withNotify($notify);
    }
}
