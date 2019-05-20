<?php

namespace App\Http\Controllers;

use App\contacts;
use App\details;
use Illuminate\Http\Request;

class InterfaceController extends Controller
{
    protected $contacts;
    protected $details;

    public function __construct( contacts $contacts, details $details )
    {
        $this->contacts = $contacts;
        $this->details = $details;
    }

	public function search(Request $request)
	{
		$res = $this->contacts ->where('first','LIKE','%'.$request->term.'%') ->orWhere('last','LIKE','%'.$request->term.'%');
		return view('search',['request'=>$request, 'contacts'=>$res->get() ] );
	}


	public function home()
	{
		return view('home',['contacts'=>$this->contacts->limit(100)->pluck('first','id')]); 
	}
}
