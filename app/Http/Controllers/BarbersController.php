<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Barber;
use Illuminate\Support\Facades\Session;


class BarbersController extends Controller
{
    public function index() {
    	/*$barbers = DB::table('barbers')->latest('created_at')->get();*/
		$barbers = Barber::latest('created_at')->get();

    	return view('barbers.index')->with('barbers', $barbers);
	 }

	 public function show($id) {
		 $barber = DB::table('barbers')->where('id', $id)->get();

		 if (is_object($barber)) {
		 	$barber =  $barber[0];
		 }

		 return view('barbers.show')->with('barber', $barber);
	 }

	 public function create() {
    	return view('barbers.create');
	 }

	 public function store(BarberRequest $request) {
		 if (Auth::check()) {
			 $barber= new Barber($request->all());
			 $barber->user_id = Auth::user()->getAuthIdentifier();
			 $barber->save();

			 Session::flash('message', 'Your profile has been created.');
		 }
		 
		 return redirect('barbers');
	 }

	 public function edit($id) {
    	$barber = DB::table('barbers')->where('id', $id)->get();

    	if (is_object($barber)) {
			$barber =  $barber[0];
		}

    	return view('barbers.edit')->with('barber', $barber);
	 }

	public function update($id, BarberRequest $request) {
    	$barber = DB::table('barbers')->where('id', $id)->first();
/*
    	if (is_object($barber)) {
			$barber =  $barber[0];
$barber->update($request->all());
    	}*/

		$barberNew= new Barber($request->all());
		$barber->name = $barberNew->name;
		$barber->address = $barberNew->address;
		$barber->email = $barberNew->email;
		$barber->phone = $barberNew->phone;
		$barber->update();

    	Session::flash('message', 'Your profile has been updated.');

    	return redirect('barbers');
	 }
}
