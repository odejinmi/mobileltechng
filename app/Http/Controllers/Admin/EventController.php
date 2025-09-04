<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Ticket;
use App\Models\Event;
use App\Models\Order;
use App\Models\EventType;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    


    public function index()
    {
        $pageTitle = "All Events";
        $emptyMessage = "No data found";
        $events = Event::latest()->with('location', 'city', 'info')->paginate(getPaginate());
        return view('admin.event.index', compact('pageTitle', 'emptyMessage', 'events'));
    }

    public function create()
    {
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        $pageTitle = "Create Event";
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $eventTypes = EventType::where('status', 1)->select('name', 'id')->get();
        return view('admin.event.create', compact('pageTitle', 'cities', 'eventTypes','timezones'));
    }

    public function approved()
    {
        $pageTitle = "Approved Events";
        $emptyMessage = "No data found";
        $events = Event::where('status', 1)->latest()->with('location', 'city', 'info')->paginate(getPaginate());
        return view('admin.event.index', compact('pageTitle', 'emptyMessage', 'events'));
    }

    public function pending()
    {
        $pageTitle = "Pending Events";
        $emptyMessage = "No data found";
        $events = Event::where('status', 0)->latest()->with('location', 'city', 'info')->paginate(getPaginate());
        return view('admin.event.index', compact('pageTitle', 'emptyMessage', 'events'));
    }

    public function cancel()
    {
        $pageTitle = "Canceled Events";
        $emptyMessage = "No data found";
        $events = Event::where('status', 2)->latest()->with('location', 'city', 'info')->paginate(getPaginate());
        return view('admin.event.index', compact('pageTitle', 'emptyMessage', 'events'));
    }

    public function search(Request $request)
    {
        $pageTitle = "Events Search";
        $emptyMessage = "No data found";
        $search = $request->search;
        $events = Event::where('title', 'like', "%$search%")->latest()->with('location', 'city', 'propertyInfo')->paginate(getPaginate());
        return view('admin.event.index', compact('pageTitle', 'emptyMessage', 'events', 'search'));
    }

     

    public function approvedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id'
        ]);
        $event = Event::findOrFail($request->id);
        $event->status = 1;
        $event->save();
        $notify[] = ['success', 'Event has been approved'];
        return back()->withNotify($notify);
    }

    public function bannedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id'
        ]);
        $event = Event::findOrFail($request->id);
        $event->status = 2;
        $event->save();
        $notify[] = ['success', 'Event has been banned'];
        return back()->withNotify($notify);
         
    }

    public function featuredInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id'
        ]);
        $event = Event::findOrFail($request->id);
        $event->featured = 1;
        $event->save();
        $notify[] = ['success', 'Include this event featured list'];
        return back()->withNotify($notify);
    }


    public function updatestatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id'
        ]);
        $event = Event::findOrFail($request->id);
        $event->status = $request->status;
        $event->save();
        $notify[] = ['success', 'Event updated successfuly'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:properties,id'
        ]);
        $event = Event::findOrFail($request->id);
        $event->featured = 0;
        $event->save();
        $notify[] = ['success', 'Remove this event featured list'];
        return back()->withNotify($notify);
    }

    public function store(Request $request)
    {
        $request->validate([
            'eventdescription' => 'required|max:500',
            'title' => 'required|max:255',
            'event_type' => 'required|exists:event_types,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'sdate' => 'required',
            'stime' => 'required',
            'edate' => 'required',
            'etime' => 'required',
            'video_link' => 'required|url',
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);
        $event = new event();
        $event->title = $request->title;
        $event->description = $request->eventdescription;
        $event->event_type = $request->event_type;
        $event->city_id = $request->city;
        $event->location_id = $request->location;
        $event->video_link = $request->video_link;
        $event->start_date = $request->sdate;
        $event->start_time = $request->stime;
        $event->end_date = $request->edate;
        $event->end_time = $request->etime;
        /*
        $socialMedia = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedinIn' => $request->linkedinIn,
            'instagram' => $request->instagram
        ];
        $property->social_media = $socialMedia;
        */
        $path = imagePath()['event']['path'];
        $size = imagePath()['event']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $event->image = $filename;
        }

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {

                $arr = [];
                $arr['field_name'] = strtolower(str_replace(' ', '_', $request->field_name[$a]));
                $arr['trx'] = getTrx();
                $arr['name'] = $request->field_name[$a];
                $arr['available'] = $request->available[$a];
                $arr['description'] = $request->description[$a];
                $arr['price'] = $request->price[$a];
                $arr['type'] = $request->type[$a];
                $arr['limit'] = $request->limit[$a];
                $arr['benefits'] = $request->benefits[$a];
                $input_form[$arr['field_name']] = $arr; 
               
            }
        }
        // return count($input_form);
        //$json = json_encode($input_form,true);
        $event->timezone = $request->timezone;
        $event->tickets = $input_form;
        $event->save();
        $notify[] = ['success', 'Event has been created'];
        return back()->withNotify($notify);
    }


    public function edit($id)
    {
        $pageTitle = "Update Event";
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $eventTypes = EventType::where('status', 1)->select('name', 'id')->get();
        $event = Event::findOrFail($id);
        $timezones = json_decode(file_get_contents(resource_path('views/admin/partials/timezone.json')));
        return view('admin.event.edit', compact('timezones','pageTitle', 'cities', 'pageTitle', 'cities', 'event', 'eventTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'eventdescription' => 'required|max:500',
            'event_type' => 'required|exists:event_types,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'sdate' => 'required',
            'stime' => 'required',
            'edate' => 'required',
            'etime' => 'required',
            'video_link' => 'required|url',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);
        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->description = $request->eventdescription;
        $event->event_type = $request->event_type;
        $event->city_id = $request->city;
        $event->location_id = $request->location;
        $event->video_link = $request->video_link;
        $event->start_date = $request->sdate;
        $event->start_time = $request->stime;
        $event->end_date = $request->edate;
        $event->end_time = $request->etime; 
        $path = imagePath()['event']['path'];
        $size = imagePath()['event']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $event->image = $filename;
        }

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {

                $arr = [];
                $arr['field_name'] = strtolower(str_replace(' ', '_', $request->field_name[$a]));
                $arr['name'] = $request->field_name[$a];
                $arr['description'] = $request->description[$a];
                $arr['price'] = $request->price[$a];
                $arr['available'] = $request->available[$a];
                $arr['trx'] = $request->trx[$a] ?? getTrx();
                $arr['type'] = $request->type[$a];
                $arr['limit'] = $request->limit[$a];
                $arr['benefits'] = $request->benefits[$a];
                $input_form[$arr['field_name']] = $arr; 
               
            }
        }
        // return count($input_form);
        //$json = json_encode($input_form,true);
        $event->timezone = $request->timezone;
        $event->tickets = $input_form;
        $event->status = 1;
        $event->save();
        $notify[] = ['success', 'Event has been updated'];
        return back()->withNotify($notify);
    }

     

    public function SalesInfo($id)
    {
        $event = Event::findOrFail($id);
        $pageTitle = $event->title . ' Event Sales';
        $log = Order::whereType('event')->whereProductId($id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.event.sales', compact('pageTitle', 'event', 'log'));
    }

    public function Tickets($id)
    {
        $now = Carbon::now();
        $tickets = Ticket::where('trx_id', $id)->with('event','order')->searchable(['code'])->where('status', 1)->paginate(getPaginate());
        $emptyMessage = "No data found";
        $pageTitle = "Print Ticket";
        if(count($tickets) > 0)
        {
            $ticket = Ticket::where('trx_id', $id)->with('event','order')->where('status', 1)->first();
            $event = $ticket->event;
            return view('admin.event.ticket',compact('pageTitle','tickets','emptyMessage','event','now'));
        }
         
        else
        {
            $notify[] = ['error', 'Sorry, No ticket found for this order'];
            return back()->withNotify($notify);
        }

   
    }


}
