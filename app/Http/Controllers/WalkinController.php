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

	/**
	 * This is a helper function to find a minimum value in the array,
	 * replace this value with a sum of it and a value of the second argument and return the minimum
	 *
	 * @param $arr
	 * @param $num
	 * @return mixed
	 */
	function findMinandReplace(&$arr, $num) {
		$min = min($arr);
		$index = array_search($min, $arr);
		$arr[$index] += $num;
		return $min;
	}

	public function calculateWaitingTime() {
		// EOB (7 pm)
		$eobTime = Carbon::createFromTime(19, 0, 0, 'America/Denver');

		// current time
		$currTime = Carbon::now();

		// find out how many barbers are currently working
		$barbers = DB::table('worklogs')->get();

		// if none barbers are working, return -1 and exit from the function, waiting time is infinity
		if (!$barbers) {
			return -1;
		}

		$timeArr = [];
		foreach ($barbers as $barber)
			array_push($timeArr, $barber->updated_at);

		// transform the timestamps into the number of minutes between service start time and now
		foreach ($timeArr as &$currTms) $currTms = $currTime->diffInMinutes($currTms);

		// get the array of 'walkins' service times
		$queue = DB::table('workins')->oldest('created_at')->get();
		$st = [];
		for ($i = 0; $i < count($queue); $i++ ) {
			$st[$i] = $queue[$i]['service_time'];
		}

		// calculate the current waiting time





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
