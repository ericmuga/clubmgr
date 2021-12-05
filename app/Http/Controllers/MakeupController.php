<?php

namespace App\Http\Controllers;

use App\Models\Makeup;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MakeupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Makeups/Index', [
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
                                                        'approval_date'=>($makeup->approval_date==null)?null:Carbon::parse($makeup->approval_date)->toDayDateTimeString()
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
            'status' => $request->status,
            'approval_date'=>null
            
        ]);

        return Redirect::route('makeups')->with('success', 'Makeup created. An email has been sent to your address.');
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
        return Inertia::render('Makeups/Edit', [
                        
                                'makeup' => [
                                                         'id'=>$makeup->id,
                                                        'name'=>$makeup->name,
                                                        'email'=>$makeup->email,
                                                        'status'=>$makeup->status,
                                                        'description'=>$makeup->description,
                                                        'makeup_date'=>Carbon::parse($makeup->makeup_date)->toDayDateTimeString(),
                                                        'approved_by'=>$makeup->approved_by,
                                                        'approval_date'=>Carbon::parse($makeup->approval_date)->diffForHumans()
                                                     ]
                                    
                ]);
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
        $validated=$request->validate([
                                         'name'=>['required'],
                                         'email'=>['required','email:rfc,dns'],
                                         'status'=>['required'],
                                         'makeup_date'=>['required','date'],
                                     ]);

                    $makeup->update([
                                     'id'=>$request->id,
                                    'name'=>$request->name,
                                    'email'=>$request->email,
                                    'status'=>$request->status,
                                    'description'=>$request->description,
                                    'makeup_date'=>$request->makeup_date,
                                    'approved_by'=> ($request->status==2)?Auth::user()->email:'',
                                    'approval_date'=>($request->status==2)?Carbon::now()->diffForHumans():null
        ]);

       return redirect()->route('makeups')->with('success','makeup updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Makeup  $makeup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Makeup $makeup)
    {

         // dd($makeup);
        $makeup->delete();
       return redirect()->route('makeups')->with('success','Makeup deleted successfully!');
    }
}
