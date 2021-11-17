<?php

namespace App\Http\Controllers;

use App\Models\MemberContacts;
use App\Models\Member;

use Illuminate\Http\Request;

class MemberContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function membercontacts(Request $request,Member $member)
     {
         return inertia('Members/Contacts',[

                            'member'=>[ 'id'=>$member->id,
                                         'name'=>$member->name,
                                         'contacts'=>MemberContacts::where('member_id',$member->id)->paginate()

                                        ],
         ]);
             
     }

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
        $attributes=$request->validate([
                    'member_id'=>'required',
                    'contact'=>$request->contact_type=='email'?'required|email|unique:member_contacts':'required|unique:member_contacts',
                    'contact_type'=>'required'

        ]);
        MemberContacts::create($attributes);
        return redirect()->back()->with('success','Contact created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberContacts  $memberContacts
     * @return \Illuminate\Http\Response
     */
    public function show(MemberContacts $memberContacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberContacts  $memberContacts
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberContacts $memberContacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberContacts  $memberContacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberContacts $memberContacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberContacts  $memberContacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberContacts $memberContact)
    {
        // dd($memberContact);
        $memberContact->delete();
        return redirect()->back()->with('success','Contact deleted successfully!');
    }
}
