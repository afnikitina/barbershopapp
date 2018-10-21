<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddCustomerRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Barber;
use App\Walkin;
use App\Worklog;

use Illuminate\Http\Request;


/**
 * find the array element with the smallest value
 * and add the second parameter to that array element
 *
 * @param $arr (passed by reference)
 * @param $num
 * @return mixed (the smallest value in the array)
 */
function findMinAndReplace(&$arr, $num) {
	$min = min($arr);
	$index = array_search($min, $arr);
	$arr[$index] += $num;

	return $min;
}

/**
 * the first array contains values that each of the currently working barbers
 * needs to finish serving his/her customer
 *
 * @param $arr1 (passed by reference)
 * @param $arr2 (passed by value)
 * @return int|mixed
 */
function estimate(&$arr1, $arr2) {
	$wt = 0;
	for ($i = 0; $i < count($arr2); $i++ ) {
		$wt = findMinAndReplace($arr1, $arr2[$i]);
	}
	return $wt;
}

/**
 * create the correct message for the time in hours and minutes
 *
 * @param $tm
 * @return string
 */
function parseTime($tm) {
	$h = floor($tm / 60);
	$min = $tm % 60;

	$msg1 = ($h > 0) ? $h .' hour' : '';
	$msg2 = ($h > 1) ? 's' : '';
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
	 * save the user input data + additional calculated field into the 'walkins' table
	 * @param AddCustomerRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(AddCustomerRequest $request) {
		// current time
		$currTime = Carbon::now();
		// start of business time
		$sobTime = Carbon::createFromTime(7, 0, 0, 'America/Denver');
		// end of business day
		$eobTime = Carbon::createFromTime(19, 0, 0, 'America/Denver');

		//determine if the current customer is the first today, if so, clean the waitlist from the previous day
		if ($currTime->lessThan($sobTime) && $currTime->greaterThanOrEqualTo($eobTime)) {
			$flash_message = 'You can sign up for the walk-in service only during business hours. '
				.'Our barber shop is open from 7 am to 7 pm every day. Thank you.';
		} else {
			// first add the new customer to the waitlist
			$walkin = new Walkin($request->all());
			$walkin->setServiceTimeAttribute();

			// get the latest record from the walkins table
			$results = Walkin::latest('updated_at')->first();

			// check if the current customer is the first in line today
			if ($walkin->updated_at->diffInHours($results->updated_at) > 12 ) {
				// clean up the table before saving the current customer
				Walkin::truncate();
			}
			$walkin->save();

			// get all records from the worklog
			$workstations = Worklog::all();

			if ($workstations->count()) {
				$timeArr = [];
				foreach($workstations as $workstation)
					array_push($timeArr, $workstation->updated_at);

				// transform the timestamps into the number of minutes between service start time and now
				foreach($timeArr as &$currTms) $currTms = $currTime->diffInMinutes($currTms);
			} else {
				// if none barbers are working, initialize the array that corresponds to three barbers (default value)
				$timeArr = [0,0,0];
			}

			// get the array of 'walkins' service times
			$queue = Walkin::oldest('updated_at')->get();
			//$queue = Walkin::all()->orderBy('created_at', 'DESC')->get();

			$st = [];
			$length = count($queue);
			for($i = 0; $i < $length; $i++) {
				$st[$i] = $queue[$i]['service_time'];
			}

			// calculate the current waiting time
			$waitingTime = estimate($timeArr, $st);
			// check if the estimated waiting time plus the time of the required service ends up being after the business hours
			$flash_message = ($currTime->addMinutes($waitingTime + $st[$length-1])->lessThan($eobTime)) ?
				'Your expected waiting time is ' .parseTime($waitingTime) :
				'We are sorry – there are no available timeslots left for today. '
				.'Please come by tomorrow. Our barber shop is open from 7 am to 7 pm every day.';
		}

		return redirect('walkins')->with([
			'flash_message' => $flash_message ]);
	}
}
