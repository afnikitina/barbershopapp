<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Barber;


class BarbersController extends Controller
{
    public function index() {
    	/*$barbers = DB::table('barbers')->latest('created_at')->get();*/
		 $barbers = Barber::latest('created_at')->get();

    	return view('barbers.index')->with('barbers', $barbers);
	 }

	 public function show($id) {
		 $barber = Barber::find($id);
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
		 }
		 return redirect('barbers');
	 }

	 public function edit($id) {
    	$barber = Barber::findOrFail($id);

    	return view('barbers.edit')->with('barber', $barber);
	 }

	public function update($id, BarberRequest $request) {
    	$barber = Barber::findOrFail($id);
    	$barber->update($request->all());

    	return redirect('barbers');
	 }
}
