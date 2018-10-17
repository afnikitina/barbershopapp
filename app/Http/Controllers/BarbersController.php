<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Barber;

class BarbersController extends Controller
{
    public function index() {
    	$barbers = DB::table('barbers')->latest('created_at')->get();

    	return view('barbers.index')->with('barbers', $barbers);
	 }

	 public function show($id) {
    	$barber = DB::table('barbers')->find($id);
    	return view('barbers.show')->with('barber', $barber);
	 }

	 public function create() {
    	return view('barbers.create');
	 }

	 public function store(Request $request) {
 /*   	$barber = Barber::create($request->all());
		return redirect()->route('barbers');*/
		 $barber= new Barber($request->all());
		/* $barber->name= $request['name'];
		 $barber->address= $request['address'];
		 $barber->email= $request['email'];
		 $barber->phone= $request['phone'];
		 $barber->ast= $request['ast'];*/
		 $barber->save();

		 return redirect('barbers');
	 }
}
