<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Walkin;
use App\Worklog;

use Illuminate\Http\Request;

class WalkinController extends Controller
{
	public function index() {
		return view('walkins.index');
	}

	public function create() {
		return view('walkins.create');
	}

	public function calculateWaitingTime() {
		// EOB (7 pm)
		$eobTime = Carbon::createFromTime(19, 0, 0, 'America/Denver');

		// current time
		$currTime = Carbon::now();

		// find out how many barbers are currently working
		$barbers = DB::table('worklogs')->get();

		// if none are working, return -1 and exit from the function
		if (!$barbers) {
			return -1;
		}

		$timeArr = [];
		foreach ($barbers as $barber) array_push($timeArr, $barber->updated_at);



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
