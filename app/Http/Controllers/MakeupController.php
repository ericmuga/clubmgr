<?php

namespace App\Http\Controllers;

use App\Models\Makeup;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class MakeupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Makeups/Index2', [
                        'filters' =>$request->all('search','trashed'),
                                'makeups' => Makeup::orderByDesc('makeup_date')
                                                     ->filter($request->only('search', 'trashed'))
                                                     ->paginate(10)
                                                     ->withQueryString()
                                                     ->through(fn($makeup)=>([
                                                         'id'=>$makeup->id,
                                                        'name'=>$makeup->name,
                                                        'email'=>$makeup->email,
                                                        'status'=>$makeup->wstatus(),
                                                        'description'=>$makeup->description,
                                                        'makeup_date'=>Carbon::parse($makeup->makeup_date)->diffForHumans(),
                                                        'approved_by'=>$makeup->approved_by,
                                                        'approval_date'=>$makeup->approval_date
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
        //show the create form
        return Inertia::render('Makeups/Create',[]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated=$request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50'],
            'makeup_date' => ['required', 'date'],
            'description' => ['required', 'max:50'],
            'status' => ['required', Rule::in([1,2,3])]
            //'email' => ['required', 'max:50', 'email', Rule::unique('members')]

            ]);

        Makeup::create([
            'name' => $request->name,
            'email' => $request->email,
            'makeup_date'=>$request->makeup_date,
            'description'=>$request->description,
            'status' => $request->status
            
        ]);

        return Redirect::route('makeups')->with('success', 'Makeup created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Makeup  $makeup
     * @return \Illuminate\Http\Response
     */
    public function show(Makeup $makeup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Makeup  $makeup
     * @return \Illuminate\Http\Response
     */
    public function edit(Makeup $makeup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Makeup  $makeup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Makeup $makeup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Makeup  $makeup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Makeup $makeup)
    {
        //
    }
}
