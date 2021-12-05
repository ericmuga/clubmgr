<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Type;
use App\Models\Affiliation;
use App\Models\Instance;
use App\Models\Participant;


use App\Http\Resources\MemberCollection;
class MemberController extends Controller
{
    public function index(Request $request)
    {

     return Inertia::render('Members/Index', [
        'filters' =>$request->all('search','trashed'),
        'rotarians'=>Member::where('affiliation_id',1)->get()->count(),
        'activemembers'=>Member::where('active',1)->get()->count(),
        'rotaractors'=>Member::where('affiliation_id',2)->get()->count(),
        'inductees'=>Member::where('affiliation_id',3)->get()->count(),
        'members' => Member::with('types','affiliations')
        ->orderBy('name')
        ->filter($request->only('search', 'trashed'))
        ->paginate(10)
        ->withQueryString()
        ->through(fn($member)=>([
           'member_id'=>$member->member_id,
           'id'=>$member->id,
           'name'=>$member->name,
           'email'=>$member->email,
           'affiliation'=>Affiliation::where('id',$member->affiliation_id)->exists()?Affiliation::where('id',$member->affiliation_id)->first()->code:"" ,
           'type'=>Type::where('id',$member->type_id)->exists()?Type::where('id',$member->type_id)->first()->code:"" ,
           'phone'=>$member->phone,
           'sector'=>$member->sector,
           'active'=>$member->active==1?'Yes':'No'
       ]))


    ]);

 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

    public function api(Request $request)
    {
        $member = Member::where('id',1)->get();
        return  new MemberCollection($member);


    }


    public function create()
    {
     return Inertia::render('Members/Create',[]);
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->all());

        $validated=$request->validate([
            'name' => ['required', 'max:50'],
            'affiliation_id' => ['required', 'max:1'],
            'type_id' => ['required', 'max:1'],
            'active' => ['required', 'boolean'],
            'sector' => ['required'],
            'email' => ['required', 'max:50', 'email', Rule::unique('members')]

        ]);

        Member::create([
            'name' => $request->name,
            'affiliation_id' => $request->affiliation_id,
            'email' => $request->email,
            'phone'=>$request->phone,
            'sector'=>$request->sector,
            'type_id' => $request->type_id,           
            'active' => $request->active,
            'member_id' => $request->member_id
            
        ]);

        return Redirect::route('members')->with('success', 'Member created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
       $instances=Participant::whereIn('user_email',$member->memberEmails())
       ->select('instance_uuid')
       ->groupBy('instance_uuid')
       ->get();

       $marked_present=0;

       foreach($instances as $instance)
       {
        $marked_present+=$member->instanceAttended($instance->instance_uuid);
    }


    return Inertia::render('Members/MemberCard', [
        'member' => [
            'id' => $member->id,
            'name' => $member->name,
            'member_id' => $member->member_id,
            'active'=>$member->active,
            'hashemail'=>($member->emails()->count()!=0)?md5(strtolower($member->emails()->first()->contact)):'',
            'sector' => $member->sector,
            'instances_attended'=>$instances->count(),
            'marked_present'=>$marked_present,
            'type_id' => $member->type_id,
            'affiliation_id' => $member->affiliation_id,
            'affiliation'=>DB::table('affiliations')->where('id',$member->affiliation_id)->exists()?Affiliation::find($member->affiliation_id)->code:'',
            'deleted_at' => $member->deleted_at,
            'contacts'=>DB::table('member_contacts')
            ->selectRaw('member_contacts.contact_type,member_contacts.contact,member_contacts.id')
            ->where('member_contacts.member_id','=',$member->id)
            ->orderBy('member_contacts.contact_type')->get()
        ],
        'types' => Type::all()->sortBy('code')

        ->map
        ->only('id', 'code'),

        'affiliations' => Affiliation::all()->sortBy('code')

        ->map
        ->only('id', 'code'),
        'selected'=> $member->active
    ]);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validated=$request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email'],
        ]);

        $member->update($request->all());
        return Redirect::back()->with('success', 'Member Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members')->with('success','Member Deleted Successfully');
    }

    public function restore(Member $member)
    {
        $member->deleted_at=null;
        $member->save();
        return redirect()->back()->with('success','Member Restored Successfully');
    }
}
