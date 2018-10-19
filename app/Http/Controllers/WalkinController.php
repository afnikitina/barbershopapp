<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddCustomerRequest;
use Carbon\Carbon;

use App\Walkin;

use Illuminate\Http\Request;

class WalkinController extends Controller
{
	public function index() {
		return view('walkins.index');
	}

	public function create() {
		return view('walkins.create');
	}

	/**
	 * save the user input data + additional calculated field into the 'walkins' table
	 * @param AddCustomerRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(AddCustomerRequest $request) {
		$walkin = new Walkin($request->all());
		$walkin->setServiceTimeAttribute();
		$walkin->save();

		return redirect('walkins');
	}
}
