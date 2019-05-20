<?php

namespace App\Http\Controllers;

use App\contacts;
use App\details;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    protected $contacts;
    protected $details;

    public function __construct( contacts $contacts, details $details )
    {
        $this->contacts = $contacts;
        $this->details = $details;
    }

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
        $request->validate(['first' => 'required', 'last' => 'required', 'email' => 'email', 'phone' => '', ] );

        $contact = $this->contacts->create(['first'=>$request->first,'last'=>$request->last ] );

        if(!empty($request->email ) ) $this->details->create(['type'=>'email', 'data'=>$request->email, 'contacts_id' => $contact->id ] );
        if(!empty($request->phone ) ) $this->details->create(['type'=>'phone', 'data'=>$request->phone, 'contacts_id' => $contact->id ] );

        return redirect('/' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('contact',['contact'=>$this->contacts->findOrFail($id) ] );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate(['first' => 'required', 'last' => 'required' ] );

        $data = $this->contacts->findOrFail($id);
        $data->first = $request->first;
        $data->last = $request->last;
        $data->save();

        return view('contact',['contact'=>$data ]  );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->contacts->find($id);
        $data->delete();

        return redirect('/');
    }
}
