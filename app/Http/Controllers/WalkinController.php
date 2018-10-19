<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalkinController extends Controller
{
	public function create() {
		return view('walkins.create');
	}

	public function store() {

	}
}
