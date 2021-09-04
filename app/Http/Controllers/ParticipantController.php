<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // return ("Here");

        // /dd(Meeting::find(Participant::first()->load('meeting')->meeting_id));
        return Inertia::render('Participants/Index',[
                                'filters' =>$request->all('search','trashed'),
                                'participants' => Participant::orderBy('name')
                                ->filter($request->only('search', 'trashed'))
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($participant)=>([
                                                        'id'=>$participant->id,
                                                        'name'=>$participant->name,
                                                        'email'=>$participant->user_email,
                                                        'join_time'=>Carbon::parse($participant->join_time)->toDateTimeString(),
                                                        'leave_time'=>Carbon::parse($participant->leave_time)->toDateTimeString(),
                                                        'duration'=>$participant->duration,
                                                        'meeting_id'=>$participant->meeting_id,
                                                        'mid'=>Meeting::where('meeting_id',$participant->meeting_id)->first()->id,
                                                        'start_time'=>Carbon::parse(Meeting::where('meeting_id',$participant->meeting_id)->first()->start_time)->toDateTimeString(),
                                                       
                                                     ]))


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Redirect::back()->with('error','this function is under construction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
