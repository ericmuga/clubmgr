<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use App\Models\Setup;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


use Inertia\Inertia;
class ZoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         //show the zoom options
        /*
            - Setup
            - meeting prefix
        */
        
        return Inertia::render('Zoom/Index',[
                                             'filters' => Request::all('search', 'trashed'),
                                              'setups'=>Setup::paginate(10)
                                                      ->withQueryString()
                                                      ->through(fn($setup) =>[  'id' => $setup->id,
                                                                                'client_id' => $setup->client_id,
                                                                                'client_secret' => $setup->client_secret,
                                                                                'callback_url' => $setup->callback_url,
                                                                                'current' => $setup->current?'Yes':'No',
                                                                                'environment' => $setup->environment,
                                                                                'meeting_prefix' => $setup->meeting_prefix,
                                                                                'last_meeting_no' => $setup->last_meeting_no,
                                                                                    ])
                                          ]);


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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setup $setup)
    {
        // dd($setup);
        return Inertia::render('Zoom/Edit',
                ['setup'=>[  'id'=>$setup->id,
                             'client_id'=>$setup->client_id,
                             'client_secret'=>$setup->client_secret,
                             'environment'=>$setup->environment,
                             'callback_url'=>$setup->callback_url,
                             'current'=>$setup->current,
                             'meeting_prefix' => $setup->meeting_prefix,
                             'last_meeting_no' => $setup->last_meeting_no
                         ]
         
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Setup $setup)
    {
          Request::validate([
                              'client_id'=>['required', 'max:250'],
                             'client_secret'=>['required', 'max:250'],
                             'environment'=>['required', 'max:250',Rule::in(['local', 'production'])],
                             'callback_url'=>['required ','url'],
                             'current'=>['required','boolean']
           ]);
           
           $setup->update(Request::except('_method'));
                

           return Redirect::back()->with('success', 'Setup updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
