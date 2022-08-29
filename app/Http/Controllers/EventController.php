<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Event::whereDate('start_class', '>=', $request->start)
                ->whereDate('end_class',   '<=', $request->end)
                ->get(['id', 'class_title', 'start_class', 'end_class']);
            return response()->json($data);
        }
        return view('event');
    }

    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = Event::create([
                  'class_title' => $request->class_title,
                  'start_class' => $request->start_class,
                  'end_class' => $request->end_class,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = Event::find($request->id)->update([
                  'class_title' => $request->class_title,
                  'start_class' => $request->start_class,
                  'end_class' => $request->end_class,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Event::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }
}
