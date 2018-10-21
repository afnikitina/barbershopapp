<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Barber;


class BarbersController extends Controller
{
    public function index() {
		$barbers = Barber::latest('updated_at')->get();

    	return view('barbers.index')->with('barbers', $barbers);
	 }

	 public function show($id) {
    	$barber = Barber::findOrFail($id);

		 return view('barbers.show')->with('barber', $barber);
	 }

	 public function create() {
    	return view('barbers.create');
	 }

	 public function store(BarberRequest $request) {
		 if (Auth::check()) {
			 $barber= new Barber($request->all());
			 /*$barber->user_id = Auth::user()->getAuthIdentifier();*/
			 $barber->user_id = Auth::user()->id;

			 $barber->save();

			 session()->flash('message', 'Your profile has been created.');
		 }
		 
		 return redirect('barbers');
	 }

	 public function edit($id) {
    	//$barber = DB::table('barbers')->where('id', $id)->get();
		 $barber = Barber::findOrFail($id);

    	return view('barbers.edit')->with('barber', $barber);
	 }

	public function update($id, BarberRequest $request) {
		$barber = Barber::findOrFail($id);

		if ( $barber ) {
			$barber->name = $request->input('name');
			$barber->address = $request->input('address');
			$barber->email = $request->input('email');
			$barber->phone = $request->input('phone');

			$barber->save();

			$flash_message = 'Your profile has been updated.';

			//session()->flash('flash_message', 'Your profile has been updated.');
		} else {
			$flash_message = 'Something went wrong! Your profile has not been updated.';

			//session()->flash('flash_message', 'Something went wrong! Your profile has not been updated.');
		}

    	return redirect('barbers')->with([
			'flash_message' => $flash_message ]);
	 }
}
