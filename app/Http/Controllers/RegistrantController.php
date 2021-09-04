<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Carbon\Carbon;
class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //fetch reigstrants

        return Inertia::render('Registrants/Index', [
                                'filters' =>$request->all('search','trashed'),
                                'total'=>Registrant::filter($request->only('search', 'trashed'))
                                                         ->count(),
                                'rotarians'=>Registrant::where('category','Rotarian')
                                                        ->filter($request->only('search', 'trashed'))
                                                         ->count(),
                                'rotaractors'=>Registrant::where('category','Rotaractor')
                                                         ->filter($request->only('search', 'trashed'))
                                                         ->count(),
                                'guests'=>Registrant::where('category','Guest') 
                                                     ->filter($request->only('search', 'trashed'))
                                                    ->count(),
                                'registrants' => Registrant::orderBy('first_name')
                                ->filter($request->only('search', 'trashed'))
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($registrant)=>([
                                                        'id'=>$registrant->id,
                                                        'name'=>$registrant->first_name.' '.substr($registrant->last_name,0,1).'.',
                                                        'email'=>$registrant->email,
                                                        'category'=>$registrant->category,
                                                        'classification'=>$registrant->classification,
                                                        'meeting_id'=>$registrant->meeting_id,
                                                        'mid'=>Meeting::where('meeting_id',$registrant->meeting_id)->first()->id,
                                                        // 'create_time'=>Carbon::parse($registrant->create_time)->toDayDateTimeString(),
                                                        'invited_by'=>$registrant->invited_by,
                                                        'club_name'=>$registrant->club_name
                                                       // 'phone'=>$registrant->phone
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
        return Redirect::route('registrants')->with('error', 'Registration has not been enabled from the this app');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Redirect::route('registrants')->with('error', 'Registration has not been enabled from the this app');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function show(Registrant $registrant)
    {
        return Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrant $registrant)
    {
                return Redirect::route('registrants')->with('error', 'Editing Registration has not been enabled from the this app');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrant $registrant)
    {
        return Redirect::route('registrants')->with('error', 'Editing Registration has not been enabled from the this app');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrant  $registrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registrant $registrant)
    {
        $registrant->delete();

        return Redirect::back()->with('success', 'Registrant deleted.');
    }


     public function restore(Registrant $registrant)
    {
        $registrant->restore();

        return Redirect::back()->with('success', 'Registrant restored.');
    }
}
