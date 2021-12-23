<?php

namespace App\Http\Controllers;

use App\Models\MakeUpEvent;
use Illuminate\Http\Request;
use App\Models\MemberContacts;
use App\Models\EventLine;

class MakeUpEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('MakeUpEvents/Index',[]);
    }


    public function makeUpEvent()
    {
        return inertia('MakeUpEvents/MakeUpEventCard',[]);
        // return inertia('../Shared/MakeUpEventForm',[]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // /dd($request->all());

        $request->validate([

                       'email'=>'required|exists:member_contacts,contact',
                       'name'=>'required'
        ]);

        
        //register the events

        //dd(MemberContacts::firstWhere('contact',$request->email)->member_id);

        //add Makeup event
         $eventId=MakeUpEvent::create([ 
                              'member_id'=>MemberContacts::firstWhere('contact',$request->email)->member_id,
                              'grader_email'=>'',

                                  
                     
         ])->id;

        // dd($request->rows);

         foreach ($request->rows as $key => $value) 
         {
            EventLine::create([
                               'makeup_event_id'=>$eventId,
                               'event_type'=>$value['type'],
                               'event_date'=>$value['date'],
                               'event_description'=>$value['description'],
                               'event_club'=>$value['club'],
                               'comment'=>''
                             ]);    
         }

        
        return redirect(route('makeups'))->with('success','Your request has been submitted successfully! Please check your email for corresondence.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MakeUpEvent  $makeUpEvent
     * @return \Illuminate\Http\Response
     */
    public function show(MakeUpEvent $makeUpEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MakeUpEvent  $makeUpEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(MakeUpEvent $makeUpEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MakeUpEvent  $makeUpEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MakeUpEvent $makeUpEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MakeUpEvent  $makeUpEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MakeUpEvent $makeUpEvent)
    {
        //
    }
}
