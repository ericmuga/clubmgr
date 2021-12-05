<?php

namespace App\Http\Controllers;

use App\Models\MakeUpEvent;
use Illuminate\Http\Request;

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
        //
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
