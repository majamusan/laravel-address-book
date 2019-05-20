<?php

namespace App\Http\Controllers;

use App\details;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    protected $details;

    public function __construct( details $details )
    {
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
       $request->validate(['contacts_id' => 'required', 'type' => 'required', 'data' => 'required'] );

        $contact = $this->details->create(['contacts_id'=>$request->contacts_id,'type'=>$request->type, 'data'=>$request->data  ] );

        return redirect()->action('ContactsController@show', ['contact' => $request->contacts_id ] );
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['data' => 'required' ] );
        $data = $this->details->findOrFail($id);
        $data->data = $request->data;
        $data->save();
        return redirect()->action('ContactsController@show', ['contact' => $data->contacts_id ] );

        return view('contact',['contact'=>$data ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->details->find($id);
        $data->delete();

        return redirect()->action('ContactsController@show', ['contact' => $data->contacts_id ] );

        return redirect('/books')->with('success', 'Book is successfully deleted');
    }
}
