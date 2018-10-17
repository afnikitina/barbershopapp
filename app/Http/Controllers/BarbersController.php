<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Barber;

class BarbersController extends Controller
{
    public function index() {
    	$barbers = DB::table('barbers')->get();

    	return view('barbers.index')->with('barbers', $barbers);
	 }

	 public function show($id) {
    	$barber = DB::table('barbers')->find($id);
    	return view('barbers.show')->with('barber', $barber);
	 }

	 public function create() {
    	return view('barbers.create');
	 }
}
