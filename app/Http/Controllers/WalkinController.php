<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Barber;
use App\Walkin;
use App\Worklog;

use Illuminate\Http\Request;

public function findMinAndReplace(&$arr, $num) {
	$min = min($arr);
	$index = array_search($min, $arr);
	$arr[$index] += $num;
	return $min;
}

public function parseTime($tm) {
	$h = floor($tm / 60);
	$min = $tm % 60;

	$msg1 = ($h > 0) ? $h .' hour' : '';
	$msg2 = ($h>1) ? 's' : '';
	$msg3 = ($min > 0) ? ' ' .$min .' minute' : '';
	$msg4 = ($min > 1) ? 's' : '';

	return $msg1 .$msg2 .$msg3 .$msg4;
}

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
	}

	protected $sobTime = Carbon::createFromTime(7, 0, 0, 'America/Denver');
	protected $eobTime = Carbon::createFromTime(19, 0, 0, 'America/Denver');

	public function calculateWaitingTime() {
		// current time
		$currTime = Carbon::now();

		// get all records from worklog
		$workstations = Worklog::all();

		// if none barbers are working, return -1 and exit from the function, waiting time is infinity
		if (!$workstations->count()) {
			return -1;
		}

		$timeArr = [];
		foreach ($workstations as $workstation)
			array_push($timeArr, $workstation->updated_at);

		// transform the timestamps into the number of minutes between service start time and now
		foreach ($timeArr as &$currTms) $currTms = $currTime->diffInMinutes($currTms);

		// get the array of 'walkins' service times
		$queue = Walkin::all()->orderBy('created_at', 'DESC')->get();
		$st = [];
		for ($i = 0; $i < count($queue); $i++ ) {
			$st[$i] = $queue[$i]['service_time'];
		}

		// calculate the current waiting time
		$waitingTime = 0;
		for ($i = 0; $i < count($queue); $i++ ) {
			$waitingTime = findMinAndReplace($st, $waitingTime);
		}

		$flash_message = 'Your estimated waiting time is ' .$parsedTime;
		return redirect('walkins')->with([
			'flash_message' => $flash_message ]);
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
