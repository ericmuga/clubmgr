<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\GradingRule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class GradingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return Inertia::render('GradingRules/Index',['gradingrules'=> GradingRule::paginate(10)
                                                                                  ->through(fn($gradingrule)=>([
                                                                                      "id"=>$gradingrule->id,
                                                                                      "rule_name"=>$gradingrule->rule_name,
                                                                                      "meeting_type"=>($gradingrule->meeting_type==1)?'Zoom':'Physical',
                                                                                      "description"=>$gradingrule->description,
                                                                                      "threshhold"=>$gradingrule->threshhold
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
       return inertia('GradingRules/Create',[]);

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
        $request->validate([

                 'rule_name'=>['required','max:50','unique:grading_rules'],
                 'threshhold'=>['required','integer','max:60'],
                 'meeting_type'=>['required',Rule::in([1,2])],
        ]);

        GradingRule::create([
                     'rule_name'=>strtoupper($request->rule_name),
                     'description'=>$request->description,
                     'threshhold'=>$request->threshhold,
                     'meeting_type'=>$request->meeting_type,
        ]);

        return redirect()->route('gradingrules')->with('success','Rule created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function show(GradingRule $gradingRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function edit(GradingRule $gradingrule)
    {
        return inertia('GradingRules/Edit',['gradingrule'=>$gradingrule]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradingRule $gradingrule)
    {
        //

        
        $request->validate([

                 'rule_name'=>['required','max:50'],
                 'threshhold'=>['required','integer','max:60'],
                 'meeting_type'=>['required',Rule::in([1,2])],
        ]);
   // dd($request->threshhold);
        $gradingrule->update([
                               
                       'rule_name'=>strtoupper($request->rule_name),
                     'description'=>$request->description,
                     'threshhold'=>$request->threshhold,
                     'meeting_type'=>$request->meeting_type,
        ]);

        return redirect()->route('gradingrules')->with('success','Grading Rule updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingRule $gradingRule)
    {
        $gradingRule->delete();
         return redirect()->route('gradingrules')->with('success','Grading deleted');

    }
}
