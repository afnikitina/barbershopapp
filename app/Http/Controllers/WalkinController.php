<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddCustomerRequest;
use Carbon\Carbon;

use App\Walkin;

use Illuminate\Http\Request;

class WalkinController extends Controller
{
	public function create() {
		return view('walkins.create');
	}

	public function store(AddCustomerRequest $request) {
		$walkin = new Walkin($request->all());
		$walkin->save();

		return redirect('walkins');
	}
}
