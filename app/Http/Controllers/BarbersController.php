<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barber;

class BarbersController extends Controller
{
    public function index() {
    	$barbers = Barber::all();

    	return view('barbers.index')->with('barbers', $barbers);
	 }
}
