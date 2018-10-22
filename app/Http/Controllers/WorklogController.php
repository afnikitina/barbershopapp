<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Barber;
use App\Walkin;
use App\Worklog;


class WorklogController extends Controller
{
	public function index() {
		return view('worklog.index');
	}

	public function create() {
		return view('worklog.create');
	}

    public function startService() {
		// check if the unauthorized user is trying to initiate this service (taking the next-in-line customer for a service)
		 if (! Auth::check()) {
			 flash( 'Please login to your account.')->warning()->important();
			 return view('login');
		 }

		 // check if the current user has a record as a barber, if not, force him/her to create his/her account
		 $user = Auth::user();
		 $barber = Barber::where('user_id', '=', $user->id)->first();
		 if (!$barber) {
			 flash('Hello ' .$user->name .'! Please create your account.')->warning()->important();
			 return view('barbers.create');
		 }

		 // check if there is any customers on the waitlist
		 if (Walkin::all()->isEmpty()) {
			 flash('Hello ' .$user->name .'! There is no customers on the waiting list at the moment.'
			 	.' Please check back later.')->warning()->important();
			 return view('barbers');
		 }

		 // get the next-in-line customer from the 'walkins' table
		 $nextCustomer = Walkin::oldest('updated_at')->first();

		 // remove all yesterday records from the worklog table if any
		 $yesterday = Carbon::yesterday()->format('Y-m-d');
		 Worklog::whereDate('updated_at', $yesterday)->delete();

		 // check if the current barber already has a record in the today's worklog
		 if (Worklog::find($barber->id)) {
			 $record = Worklog::find($barber->id)->first();
		 } else {
			 $record = new Worklog();
		 }

		 // get all the required data from the walkins table
		 $record->barber_id = $barber->id;
		 $record->ticket_id = $nextCustomer->id;
		 $record->service_time = $nextCustomer->service_time;

		 $record->save();

		 // create a flash message
		 $flash_message = 'Hi ' .$barber->name .'!'
			 .' Your next customer, ' .$nextCustomer->customer_name .', needs ' .$nextCustomer->service
			 .' The approximate service time is ' .$record->service_time .' minutes.';


		 // delete the first-in-line customer from the queue (walkins table)
		 $nextCustomer->delete();

		 flash($flash_message)->success()->important();;

		 return view('worklog.index');
	 }
}
